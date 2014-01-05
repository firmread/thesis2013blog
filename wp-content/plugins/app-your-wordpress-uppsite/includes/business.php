<?php
define('UPPSITE_GET_MAX_ITEMS', 100);
define('IMAGES_PER_PAGE', 30);
define('UPPSITE_PAGELIST_QUERY', 'sort_order=ASC&post_status=publish&post_type=page&sort_column=menu_order&number=' . UPPSITE_GET_MAX_ITEMS);
require_once(dirname(__FILE__) . '/vcard.php');
class UppSiteBusinessDataMiner {
    var $current_info = null;
    var $front_page = null;
    var $regexes = null;
    public function __construct() {
        $this->current_info = array(
            'phone' => null,
            'phone_weak' => null,
            'address' => null,
            'email' => null
        );
                require_once(dirname(__FILE__) . '/regexes.inc.php');
        $this->regexes = isset($regexes) ? $regexes : array();
    }
    public function build_site_info($force = false) {
        $this->_search_contact_info();
        $bizInfo = get_option(MYSITEAPP_OPTIONS_BUSINESS, array());
        $bizInfo['title'] = get_bloginfo('name');
        $bizInfo['description'] = get_bloginfo('description');
        $bizInfo['contact_phone'] = empty($this->current_info['phone']) && !empty($this->current_info['phone_weak']) ?
                                    $this->current_info['phone_weak'] : $this->current_info['phone'];
        $bizInfo['contact_address'] = $this->current_info['address'];
        $bizInfo['contact_address_vcf'] = isset($this->current_info['address_vcf']) ? $this->current_info['address_vcf'] : '';
        $bizInfo['email'] = $this->current_info['email'] ? $this->current_info['email'] : get_bloginfo('admin_email');
        $this->scan_site_images($bizInfo);
        $share_arr = $this->_get_share_links();
        $bizInfo['facebook'] = $share_arr['facebook'];
        $bizInfo['twitter'] = $share_arr['twitter'];
        if (!isset($bizInfo['navbar_display']) || $force) {
            $bizInfo['navbar_display'] = true;
        }
        if (!isset($bizInfo['selected_images']) || $force) {
                        $bizInfo['selected_images'] = $bizInfo['all_images'];
        }
        if (!isset($bizInfo['menu_pages']) || $force) {
            $pages = get_pages(UPPSITE_PAGELIST_QUERY);
            $bizInfo['menu_pages'] = array_map(create_function('$page', 'return $page->ID;'), $pages);
        }
        update_option(MYSITEAPP_OPTIONS_BUSINESS, $bizInfo);
    }
    public function scan_site_images(&$bizInfo) {
        $bizInfo['featured'] = $this->get_images_from_homepage();
        $bizInfo['all_images'] = $this->get_site_images();
    }
    private function _get_from_content($part, $content) {
        if (!array_key_exists($part, $this->regexes)) { return null; }
        return preg_match($this->regexes[$part], $content, $matched) > 0 ? $matched[0] : null;
    }
    private function get_front_page() {
        if (!is_null($this->front_page)) {
            return $this->front_page;
        }
        $response = wp_remote_get( add_query_arg( 'uppsite_is_miner', '1', home_url() ) );
        if ( is_wp_error( $response ) ) {
            return null;
        }
        $this->front_page = $response['body'];
        return $this->front_page;
    }
    private function _fetch_google_address($address) {
        $response = wp_remote_get( 'http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=' . urlencode($address) );
        if ( is_wp_error( $response ) ) {
            return null;
        }
        $results = json_decode($response['body'], true);
        $results = $results['results'];
        $parts = array(
            'street_number' => 'street_number',
            'address' => 'route',
            'city' => 'locality',
            'state' => 'administrative_area_level_1',
            'zip' => 'postal_code',
        );
        if (count($results) == 0 || count($results[0]['address_components']) == 0) { return null; }
        $components = $results[0]['address_components'];
        $ret = array();
        foreach ($parts as $need => $type) {
            foreach ($components as &$component) {
                if (in_array($type, $component['types'])) {
                    $ret[$need] = $component['short_name'];
                }
            }
            if (!array_key_exists($need, $ret)) {
                                $ret[$need] = '';
            }
        }
        return $ret;
    }
    private function format_address($arr, $vcfFormat = false) {
        return sprintf($vcfFormat ? "%s %s;%s;%s;%s" : "%s %s\n%s, %s %s",
            $arr['street_number'], $arr['address'], $arr['city'], $arr['state'], $arr['zip']);
    }
    private function parse_page_for_info($content) {
        if (is_null($this->current_info['phone'])) {
            $this->current_info['phone'] = $this->_get_from_content('phone', $content);
            if (is_null($this->current_info['phone_weak'])) {
                $this->current_info['phone_weak'] = $this->_get_from_content('phone_weak', $content);
            }
        }
        if (is_null($this->current_info['address'])) {
            $address = $this->_get_from_content('address', $content);
            if (!is_null($address)) {
                                $parsed = $this->_fetch_google_address($this->current_info['address']);
                $vcfAddress = '';
                if (!is_null($parsed)) {
                    $address = $this->format_address($parsed);
                    $vcfAddress = $this->format_address($parsed, true);
                }
                $this->current_info['address'] = $address;
                $this->current_info['address_vcf'] = $vcfAddress;
            }
        }
        if (is_null($this->current_info['email'])) {
            $this->current_info['email'] = $this->_get_from_content('email', $content);
        }
    }
    private function _get_share_links() {
        $sites = array(
            'facebook' => null,
            'twitter' => null
        );
        foreach ($sites as $key => $_v) {
            $link = preg_match('/<a[^>]*href=["\']([^"\']*(' . $key . ')[^"\']*)["\']/i', $this->get_front_page(), $matches) > 0 ?
                $matches[1] : null;
            if (!is_null($link) && preg_match("/" . $key . "\.[^\/]+\/(?:([^\/]+)\/)*([^\/]+)/i", $link, $parts) > 0) {
                $link = $parts[2];
            }
            $sites[$key] = $link;
        }
        return $sites;
    }
    private function _search_contact_info() {
                if ($front_page_id = get_option('page_on_front', false)) {
            $home = get_post($front_page_id);
            $this->parse_page_for_info($home->post_content);
        }
                $likelyContactPages = '/.*(Contact|About|Info|Home).*/i';
        $all_pages = get_pages();
        foreach ($all_pages as $page) {
            if (preg_match($likelyContactPages, $page->post_title) > 0) {
                $this->parse_page_for_info($page->post_content);
            }
        }
                        if ($home_page = $this->get_front_page()) {
            $this->parse_page_for_info($home_page);
        }
    }
    private function _find_images($content) {
        return preg_match_all('/<img[^>]*src=["\'](((?!gravatar\.com).)+?)["\']/i', $content, $matches) > 0 ?
            $matches[1] : array();
    }
    function get_site_images() {
        $all_images = array();
                if ($frontPage = $this->get_front_page()) {
            $all_images = array_merge($all_images, $this->_find_images( $frontPage ));
        }
                $all_pages = get_pages( array( 'sort_column' => 'post_date', 'sort_order' => 'DESC' ) );
        foreach ($all_pages as $page) {
            $all_images = array_merge($all_images, $this->_find_images( $page->post_content ));
        }
        return array_unique($all_images, SORT_STRING);
    }
    private function get_images_from_homepage() {
        if (!($frontPage = $this->get_front_page())) {
            return array();
        }
                $wp_dir = wp_upload_dir();
        preg_match_all('/<img[^>]*src=["\'](' . preg_quote($wp_dir['baseurl'], '/') . '.+?)["\']/i', $frontPage, $matches);
        if (!is_array($matches[1]) || count($matches[1]) == 0) {
                        preg_match_all('/<img[^>]*src=["\'](' . preg_quote(content_url('themes'), '/') . '.+?)["\']/i', $frontPage, $matches);
            if (!is_array($matches[1]) || count($matches[1]) == 0) {
                return array();             }
        }
        return array_slice($matches[1], 0, 3);     }
}
function uppsite_miner_run($arg = null) {
    static $uppsiteMiner = null;
    if (!is_null($uppsiteMiner)) { return; } 
    $force = !is_null($arg) && is_float($arg) && $arg < 5;
    $force |= isset($_REQUEST['uppsite_miner']);
    $bizOptions = get_option(MYSITEAPP_OPTIONS_BUSINESS, array());
    $shouldRun = empty($bizOptions) || count($bizOptions) == 0; 
    $shouldntRun = isset($_REQUEST['uppsite_is_miner']);
    if (!$shouldntRun && ($force || $shouldRun)) {
        $uppsiteMiner = new UppSiteBusinessDataMiner();
        $uppsiteMiner->build_site_info($force);
    }
    else if(isset($_REQUEST['uppsite_images_rescan'])){
        $uppsiteMiner = new UppSiteBusinessDataMiner();
        $uppsiteMiner->scan_site_images($bizOptions);
        update_option(MYSITEAPP_OPTIONS_BUSINESS, $bizOptions);
    }
}
add_action( 'after_setup_theme', 'uppsite_miner_run' ); add_action( 'uppsite_is_activated', 'uppsite_miner_run' ); add_action( 'uppsite_has_upgraded', 'uppsite_miner_run', 1, 1 ); 
function uppsite_get_all_media_images($page) {
    $args = array(
        'post_type' => 'attachment',
        'posts_per_page' => IMAGES_PER_PAGE / 2,
        'post_mime_type' => 'image',
        'post_parent' => null,
        'offset' => $page * ( IMAGES_PER_PAGE / 2 )
    );
    $attachments = get_posts( $args );
    $images = array();
    foreach ( $attachments as $attachment ) {
        $images[] = $attachment->guid;
    }
    return $images;
}
function uppsite_get_bizimages() {
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 0;
    $image_ar = array_unique(mysiteapp_get_options_value(MYSITEAPP_OPTIONS_BUSINESS, 'all_images', array()), SORT_STRING);
    $selectedImages = mysiteapp_get_options_value(MYSITEAPP_OPTIONS_BUSINESS, 'selected_images', array());
    $featuredImages = mysiteapp_get_options_value(MYSITEAPP_OPTIONS_BUSINESS, 'featured', array());
    $current_page_ar = array_slice($image_ar, $page * (IMAGES_PER_PAGE / 2), IMAGES_PER_PAGE / 2);
    $current_page_ar = array_merge(uppsite_get_all_media_images($page), $current_page_ar);
    $images_list = array();
    foreach ($current_page_ar as $image) {
        $found_in = array();
        if (in_array($image, $selectedImages)) { $found_in[] = 'photos'; }
        if (in_array($image, $featuredImages)) { $found_in[] = 'homepage'; }
        $images_list[] = array(
            'img_url' => $image,
            'found' => $found_in
        );
    }
    return $images_list;
}
function uppsite_get_biz_pages() {
    $filter = array(
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC',
    );
    $include = mysiteapp_get_options_value(MYSITEAPP_OPTIONS_BUSINESS, 'menu_pages', null);
    if (!is_null($include)) {
        $filter['include'] = $include;
    }
    $pages = get_pages($filter);
    if (!is_null($include)) {
                array_walk(
            $pages,
            create_function('&$page, $key, $include', '$page->menu_order = array_search($page->ID, $include)+1;'),
            $include
        );
    }
    return $pages;
}
function uppsite_get_categorieslist() {
    $allCats = array_map(
        create_function('$cat', 'return array($cat->term_id, $cat->name);'),
        get_categories('order=desc&orderby=count&number=' . UPPSITE_GET_MAX_ITEMS)
    );
    $selectedCats = uppsite_homepage_get_categories();
    return array(
        'all' => $allCats,
        'selected' => $selectedCats
    );
}
function uppsite_get_pagelist() {
    $filterValues = create_function('$page', 'return array($page->ID, $page->post_title);');
    $allPages = array_map(
        $filterValues,
        get_pages(UPPSITE_PAGELIST_QUERY)
    );
    $selectedPages = uppsite_get_biz_pages();
        usort($selectedPages, create_function('$a, $b', 'if ($a->menu_order == $b->menu_order) { return 0; }; return ($a->menu_order < $b->menu_order) ? -1 : 1;'));
    $selectedPages = array_map(
        $filterValues,
        $selectedPages
    );
    return array(
        'all' => $allPages,
        'selected' => $selectedPages
    );
}
function uppsite_get_bizinfo() {
    $businessData = get_option(MYSITEAPP_OPTIONS_BUSINESS, array());
    if (is_array($businessData)) {
        unset($businessData['all_images']);         unset($businessData['selected_images']);         unset($businessData['featured']);     }
    return $businessData;
}
function uppsite_get_bloginfo() {
    return array(
        'name' => get_bloginfo('name'),
        'url' => site_url(),
        'version' => get_bloginfo('version'),
        'tagline' => get_bloginfo('description')
    );
}
function uppsite_ajax_get_info() {
    $req = sanitize_text_field($_REQUEST['uppsite_req']);
    $allowedRequests = array(
        'bloginfo',
        'bizinfo',
        'categorieslist',
        'pagelist',
        'bizimages'
    );
    if (in_array($req, $allowedRequests) && function_exists('uppsite_get_' . $req)) {
        print json_encode(call_user_func('uppsite_get_' . $req));
    }
    exit;
}
add_action('wp_ajax_uppsite_get_info', 'uppsite_ajax_get_info');
add_action('wp_ajax_nopriv_uppsite_get_info', 'uppsite_ajax_get_info');
