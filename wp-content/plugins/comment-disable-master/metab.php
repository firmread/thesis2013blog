<?php

add_action('add_meta_boxes', 'adding_metaboxCM');

function adding_metaboxCM() {
// add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
// priority: high, default, low
// context: normal, side, advanced
// page: post, page
add_meta_box('xcom', "Wordpress Comment Options", 'metabox_contentoCM', 'post', 'normal', 'high');
add_meta_box('xcom', "Wordpress Comment Options", 'metabox_contentoCM', 'page', 'normal', 'high');

}

function metabox_contentoCM($post){ // content to show in meta box
	// get_post_meta($postid, $key, $single);
	// if single true returns single string, if false returns array

    $get_dis_vals = get_post_meta($post->ID, 'com_disabled_sh');
	//print_r($dis_values);
	$dis_values = $get_dis_vals[0];
    //echo "<pre>".print_r($get_dis_vals)."</pre>";

?>  
    <input type="checkbox" id="comment_disabled" name="comment_disabled" <?php checked($dis_values['comment_disabled'], 'yes'); ?> />
    <label for='comment_disabled'>Disable wordpress comment for this post/page</label><br/>
    <input type='checkbox' id='hide_prevs' name='hide_prevs' <?php checked($dis_values['hide_prevs'], 'yes'); ?> />
    <label for='hide_prevs'> Also hide previous comments (if there's any) </label><br/>
    <input type='checkbox' id='showmsg' name='showmsg' <?php checked($dis_values['showmsg'], 'yes'); ?> />
    <label for='showmsg'> Also show a 'comment disabled' message</label>
    
<?php
}

add_action('save_post', 'saving_meta_action');

function saving_meta_action($post_id){
    // auto saving, so we don't need to do anything
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
 
    // can you do this?
    //if( !current_user_can( 'edit_post' ) ) return;
    
    //$value_to_save = isset($_POST['comment_disabled'])? 'yes' : 'no';
    $val_save = array( 'comment_disabled'=>isset($_POST['comment_disabled'])? 'yes' : 'no',
                                'hide_prevs'=>isset($_POST['hide_prevs'])? 'yes' : 'no', 
                                'showmsg'=>isset($_POST['showmsg'])? 'yes' : 'no',
                                );
    
    update_post_meta($post_id, 'com_disabled_sh', $val_save);

}
?>