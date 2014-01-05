<?php
define('UPPSITE_REMOTE_SECURE_FRAME', UPPSITE_REMOTE_URL . '/remote/secure');
define('UPPSITE_REMOTE_SECURE_DASHBOARD', UPPSITE_REMOTE_URL . '/remote/dashboard');
define('UPPSITE_REMOTE_CREATE', UPPSITE_REMOTE_URL . '/remote/create');
define('UPPSITE_ADMIN_REQUIRED_LEVEL', 'manage_options');
require_once( dirname(__FILE__) . '/menu.php' );
function uppsite_guess_website_type() {
    $isBusiness = get_option('show_on_front') == 'page' && get_option('page_on_front') > 0;
    $isCombined = $isBusiness && get_option('page_for_posts') > 0;
    return $isCombined ? UPPSITE_TYPE_BOTH :
        ( $isBusiness ? UPPSITE_TYPE_BUSINESS : UPPSITE_TYPE_CONTENT );
}
function uppsite_get_iframe_url() {
    if (!uppsite_api_values_set()) {
                $encoded_url = urlencode(base64_encode(site_url()));
        $encoded_pingback = urlencode(base64_encode(get_bloginfo('pingback_url')));
        $url = sprintf("%s/%s/%s/%s", UPPSITE_REMOTE_CREATE, $encoded_url, $encoded_pingback, uppsite_remote_get_platform());
    } else {
                $page = 'setup';
        $extra = '';
        $prefix = UPPSITE_REMOTE_SECURE_FRAME;
        if (uppsite_admin_did_setup()) {
                        $adminPage = $_GET['page'];
            $prefix = UPPSITE_REMOTE_SECURE_DASHBOARD;
            $page = str_replace(UPPSITE_ADMIN_SETTINGS . "-", "", $adminPage);
            if (isset($_GET['sub'])) {
                                $page .= "-" . $_GET['sub'];
            }
        } else {
            $extra = '/' . uppsite_guess_website_type();
        }
        $nonce = wp_create_nonce( UPPSITE_NONCE_PREFIX . $page );
        $apiKey = mysiteapp_get_options_value(MYSITEAPP_OPTIONS_DATA, 'uppsite_key');
        $user = wp_get_current_user();
        $uid = (int) ( ((int) $user->ID) === 0 ? $user->id : $user->ID );         $requestUrl = sprintf('/%s/%s/%s/%d/%s%s', $apiKey, $nonce, mysiteapp_sign_message($nonce), $uid, $page, $extra);
        $url = $prefix . $requestUrl;
    }
    return $url;
}
function uppsite_admin_navbar() {
    $tab = UppSiteAdmin::getCurrentTab();
    echo '<div id="uppsite-wrapper"><div id="icon-uppsite" class="icon32"><br></div><h2>'.$tab['name'].'</h2>';
    echo '<ul class="subsubsub">';
    $currentMenus = UppSiteAdmin::$admin_options;
    for ($i = 0; $i < count($currentMenus) && $menu = $currentMenus[$i]; $i++) {
        $menuPage = UPPSITE_ADMIN_SETTINGS . ( array_key_exists('isMain', $menu) ? "" : "-" . $menu['slug'] );
        $isActive = $_GET['page'] == $menuPage;
        echo '<li><a href="' . admin_url( 'admin.php?page=' . $menuPage ) . '"'. ($isActive ? ' class="current"' : '' ).'>' . esc_html($menu['name']) . '</a>';
        if ($i+1 < count($currentMenus)) {
            echo " |";
        }
        echo '</li>';
    }
    echo '</ul></div>';
}
function uppsite_admin_general() {
    ?>
    <div class="wrap uppsite-wrap">
        <?php uppsite_admin_navbar() ?>
        <iframe id="uppsiteFrame" style="width:100%;height:900px;min-height:780px"  scrolling="no" frameborder="0" src="<?php echo uppsite_get_iframe_url()?>"></iframe>
    </div>
    <?php
}
function uppsite_admin_did_setup() {
    $options = get_option(MYSITEAPP_OPTIONS_OPTS, array());
    if (!is_array($options) || !array_key_exists('site_type', $options)) {
        return false;
    }
    $site_type = $options['site_type'];
    return in_array($site_type, array(UPPSITE_TYPE_BUSINESS, UPPSITE_TYPE_CONTENT, UPPSITE_TYPE_BOTH));
}
function uppsite_admin_setup() {
    if (!current_user_can(UPPSITE_ADMIN_REQUIRED_LEVEL))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    ?>
<script type="text/javascript">
    function uppsite_callback(data) {
        function uppsite_admin_refresh() {
            window.location.reload();
        }
        function uppsite_admin_go_to_settings(data) {
            // Response can be 'ok-general', thus going to "uppsite-settings-general"
            var okLength = 'ok'.length;
            var pageSuffix = (data.length > okLength) ? data.substring(okLength) : '';
            window.location = '<?php echo esc_js( admin_url( 'admin.php?page=' . UPPSITE_ADMIN_SETTINGS ) ) ?>' + pageSuffix;
        }
    <?php if (!uppsite_api_values_set()):  ?>
        jQuery.get(ajaxurl, { action: 'uppsite_has_api_creds' }, function( response ) {
            var resp = JSON.parse(response);
            if (resp == 1) {
                // We got the API key & secret
                uppsite_admin_refresh();
            } else if (resp == 2) {
                // We already installed, move to dashboard
                uppsite_admin_go_to_settings('ok');
            }
        });
    <?php else: ?>
        function uppsite_admin_reset() {
            jQuery.get(ajaxurl, { action: 'uppsite_reset', nonce: '<?php echo wp_create_nonce('uppsite_admin_reset') ?>' }, function( response ) {
                uppsite_admin_refresh();
            });
        }
        if (data.indexOf('ok') != -1) {
            uppsite_admin_go_to_settings(data);
        }
        if (data == 'reset') {
            uppsite_admin_reset();
        }
        if (data == 'refresh') {
            uppsite_admin_refresh();
        }
    <?php endif; ?>
    }
    pm.bind("uppsite_remote", uppsite_callback);
    pm.bind("uppsite_iframe_height", function (data) {
        jQuery('#uppsiteFrame').css('height', data[0]);
        if (typeof data[1] != "undefined") {
            jQuery("body").animate({scrollTop:0}, 400);
        }
    });
</script>
<iframe id="uppsiteFrame" style="width:910px;height:945px;margin-top:20px;"  scrolling="no" frameborder="0" src="<?php echo uppsite_get_iframe_url()?>"></iframe>
    <?php
}  
function mysiteapp_activation_notice(){
    $page = (isset($_GET['page']) ? $_GET['page'] : null);
    if ($page == "uppsite-setup" || !current_user_can( UPPSITE_ADMIN_REQUIRED_LEVEL )) {
        return;
    }
    if (!uppsite_admin_did_setup()) {
        $txt = 'You must <a href="' . admin_url( 'admin.php?page=' . UPPSITE_ADMIN_SETUP_SLUG ) . '">complete activation</a> for it to work.';
        echo '<div class="updated fade"><p><strong>Mobile for WordPress by UppSite is almost ready.</strong> ' . $txt . '</p></div>';
    }
}
function uppsite_admin_has_api_creds() {
    print json_encode(uppsite_api_values_set() ? ( uppsite_admin_did_setup() ? 2 : 1 ) : 0);
    exit;
}
function uppsite_admin_reset() {
    if (!current_user_can( UPPSITE_ADMIN_REQUIRED_LEVEL ) ||
        !array_key_exists( 'nonce', $_GET ) ||
        !wp_verify_nonce( esc_html($_GET['nonce']), 'uppsite_admin_reset' ))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    $dataOpts = get_option(MYSITEAPP_OPTIONS_DATA);
    unset($dataOpts['uppsite_key'], $dataOpts['uppsite_secret']);
    update_option(MYSITEAPP_OPTIONS_DATA, $dataOpts);
    print 1;
    exit;
}
function uppsite_needs_prefs_update() {
    $dataOptions = get_option(MYSITEAPP_OPTIONS_DATA);
    $lastCheck = isset($dataOptions['prefs_update']) ? intval($dataOptions['prefs_update']) : 0;
        return time() > $lastCheck + (MYSITEAPP_ONE_DAY / 2);
}
function mysiteapp_admin_init() {
    if (!uppsite_admin_did_setup()) {
                return;
    }
    $forcePrefsUpdate = uppsite_needs_prefs_update();
    $options = get_option(MYSITEAPP_OPTIONS_OPTS);
    $options['uppsite_plugin_version'] = isset($options['uppsite_plugin_version']) ? $options['uppsite_plugin_version'] : 0;
    if ($options['uppsite_plugin_version'] != MYSITEAPP_PLUGIN_VERSION) {
                $old_version = $options['uppsite_plugin_version'];
        $options['uppsite_plugin_version'] = MYSITEAPP_PLUGIN_VERSION;
        update_option(MYSITEAPP_OPTIONS_OPTS, $options);
        $forcePrefsUpdate = true;
        do_action('uppsite_has_upgraded', floatval($old_version));
    }
    uppsite_prefs_init($forcePrefsUpdate);
}
function uppsite_add_pushcontrol_button() {
    global $post;
    if (uppsite_push_control_enabled() && get_post_type($post) == 'post' && get_post_status($post) != 'publish') {
        ?>
        <div class="misc-pub-section">
            <label for="send_push" style="background-repeat: no-repeat; background-position: left center; background-image: url(<?php echo plugins_url( 'images/push-icon.png', __FILE__ ) ?>); padding: 2px 0 1px 20px; font-weight: bold">
                Send Push?
                <input name="send_push" type="checkbox" id="send_push" value="1" checked="checked"/>
            </label>
        </div>
        <?php
    }
}
add_action('admin_init','mysiteapp_admin_init');
add_action( 'admin_notices', 'mysiteapp_activation_notice');
add_action('wp_ajax_uppsite_has_api_creds', 'uppsite_admin_has_api_creds');
add_action('wp_ajax_uppsite_reset', 'uppsite_admin_reset');
add_action('post_submitbox_misc_actions', 'uppsite_add_pushcontrol_button');
