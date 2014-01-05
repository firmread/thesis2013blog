<?php

add_action('admin_menu', 'adding_option_pageCM');


//creating link in admin panel
//register settings

function adding_option_pageCM(){
    add_options_page('Wordpress Comment Settings', 'Comment Settings', 'manage_options', 'wp-comment-management', 'option_pageCM');
    add_plugins_page('Wordpress Comment Settings', 'Comment Settings', 'manage_options', 'wp-comment-management', 'option_pageCM');
    add_action('admin_init', 'register_settingsCM');
}

function register_settingsCM() {
    
    register_setting('wp-cm-settingrp', 'wcm_options');
    

}

function option_pageCM() {

    ?>
<style type='text/css'>
h3 { padding: 10px;  }
.fbds {padding: 5px 0 15px 15px; }
.in1{ width: 300px; }
.in2{width: 150px; }
label { font-weight: bold; margin: 15px 0 0 0; }
input { margin-top: 15px; }
.copr { font-weight: bold; line-height: 15px }
.note { color: #B93217; }
</style>
    <div class='wrap'>
    <?php
    /* =======================================
    //      Comment Settings
    //======================================== */ ?>
        <div class='postbox'>
            <h3>Wordpress Comment Settings</h3>
            <div class='fbds'>
           <span class='note copr'> Note:<br/> You can also set individual setting (whether to disable comment for that post or not) for each post and pages,<br/> while creating/editing  posts/pages, find a options box titled 'Wordpress Comment Settings', under the main editor.</span>
            
        <form method="post" action="options.php"> 
                    <?php settings_fields( 'wp-cm-settingrp' ); ?> 
                    <?php $wcm_options = get_option('wcm_options'); ?>
                    
         <input type='checkbox' id='wcm_options[disallpostcom]'  name='wcm_options[disallpostcom]' <?php checked($wcm_options['disallpostcom'], 'on'); ?> />
         <label for='wcm_options[disallpostcom]'>Disable commenting in all Posts</label> (this will hide the comment form in all posts, overwriting individual settings)<br/>
         <input type='checkbox' id='wcm_options[disallpagecom]' name='wcm_options[disallpagecom]' <?php checked($wcm_options['disallpagecom'], 'on'); ?> />
         <label for='wcm_options[disallpagecom]'>Disable commenting in all Pages</label></br/>
        <input type='checkbox' id='wcm_options[hideallpostcom]' name='wcm_options[hideallpostcom]' <?php checked($wcm_options['hideallpostcom'], 'on'); ?> />
        <label for='wcm_options[hideallpostcom]'> Hide comment in all posts</label> (this will hide the comments in all posts, if there's any, overwrites individual settings)<br/>
        <input type='checkbox' id='wcm_options[hideallpagecom]' name='wcm_options[hideallpagecom]' <?php checked($wcm_options['hideallpagecom'], 'on'); ?> />
        <label for='wcm_options[hideallpagecom]'> Hide comment in all pages</label> <br/>
        <input type='checkbox' id='wcm_options[msgpost]' name='wcm_options[msgpost]' <?php checked($wcm_options['msgpost'], 'on'); ?> />
        <label for='wcm_options[msgpost]'> Show disabled message in all posts</label> (if comment is disabled, you can decide to show a message saying that. write the message in following input box)<br/>
        <input type='checkbox' id='wcm_options[msgpage]' name='wcm_options[msgpage]' <?php checked($wcm_options['msgpage'], 'on'); ?> />
        <label for='wcm_options[msgpage]'> Show disabled message in all pages</label><br/><br/>
        <table>
            <tr>
                <td>Disabled message:</td>
                <?php $vlss = $wcm_options['dismsg'] ; if(strlen($vlss) == 0) $vlss = 'Comments Disabled!'; ?>
                <td><input type='text' style="width: 300px;" id='wcm_options[dismsg]' name='wcm_options[dismsg]' value='<?=$vlss ?>' /></td>
            </tr>
            <tr>
                <td>Disabled Message css style</td>
                <?php $vlss = $wcm_options['css']; if(strlen($vlss) == 0) $vlss = 'width: 300px; border: 1px solid red;'; ?>
                <td><input type='text' style="width: 300px;" id='wcm_options[css]' name='wcm_options[css]' value='<?=$vlss ?>'/> (if you don't know what it is, leave it)</td>
             </tr>
          </table>
         
        <br/><br/><br/>
        <input type="submit" class="button-primary" value="<?php _e('Update Options'); ?>" />
    
            </form>
            <br/><br/>
            </div>
         </div> <!-- postbox -->
         <div class='postbox'>
            <div class='copr fbds'>
                Developer: Shamim Hasnath<br/>
                Email: shamim@hasnath.net<br/>
                Web: www.hasnath.net<br/>
                <br/>
                visit <a href='http://hasnath.net/comment-disable-master-plugin-for-wordpress.php'>Official Plugins page</a> if you have any question regarding this plugin<br/>
                finally, cordial thanks to you for using this plugin<br/>
             </div>
	<?php 
//========================
//= Donation Link
//========================= ?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="sha404@ymail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Hasnath.net">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
          </div>
                
    
    </div>
<?php     
        


}

?>