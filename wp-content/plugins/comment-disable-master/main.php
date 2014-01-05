<?php
/*
Plugin Name: Comment Disable Master
Plugin URI: http://hasnath.net/comment-disable-master-plugin-for-wordpress.php
Description: This is a very powerful comment plugin for wordpress. You have it intalled, you have the power over your posts/pages.
 you can decide individually for each post whether to disable comment for that or not. you have also a lot more options. Enjoy!
Version: 1.0
Author: Shamim Hasnath
Author URI: http://hasnath.net
*/
function isOnOptionCm($option) {
        return get_option($option)=='on'? 1: 0;
}

function isOnMetaCm($meta){
    global $post;
    $metaval = get_post_meta($post->ID, 'com_disabled_sh');
    
    return $metaval[0][$meta]=='yes' ? 1: 0;
}

include('metab.php');

include('admin_settings.php');


add_action('wp_head', 'addToHeadCM');
add_action('comments_array', 'process_commentsCM');
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'settings_link' );




function addToHeadCM(){
    global $post;
    $wcmop = get_option('wcm_options');
    
    // if comment is disabled for that post type or individually disabled
    //if( isOnOptionCm('disable_all_'.$post->post_type.'commentCM') || isOnMetaCM('comment_disabled' ) ){
    if( $wcmop['disall'.$post->post_type.'com'] == 'on' || isOnMetaCM('comment_disabled') ) {
          ?>
<style type='text/css'>#respond, #commentform, #addcomment, .entry-comments { display: none;}</style>

<?php

    }
    
    // adding css for div  disabled message style
    // do it without checking if  really necessary
    ?>
    <style type='text/css'> #disabled_msgCM {<?=$wcmop['css'] ?> }</style>
 <?php
 
    
} // end addToHeadCM

function process_commentsCM($comments) {
    global $post;
    $wcmop = get_option('wcm_options');
    
    // if comment disabled
    if( $wcmop['disall'.$post->post_type.'com'] == 'on' || isOnMetaCM('comment_disabled' ) ){
    
    
               // if disabled message is globally on or individuall on, show it
                if($wcmop['msg'.$post->post_type] == 'on' || isOnMetaCm('showmsg')  ){
                    echo  "<div id='disabled_msgCM'>".$wcmop['dismsg']."</div>";
                }

      }
      
      // if hide previous comments
      if($wcmop['hideall'.$post->post_type.'com'] == 'on' || isOnMetaCm('hide_prevs')) {
      
            return array();  // return empty array to replace comments
      }
return $comments;

}

function settings_link($x) {
  $settings_link = '<a href="options-general.php?page=wp-comment-management">Settings</a>';
  array_unshift($x, $settings_link);
  return $x;
}



?>