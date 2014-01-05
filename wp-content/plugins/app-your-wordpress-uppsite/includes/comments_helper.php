<?php
require_once( dirname(__FILE__) . '/fbcomments_page.inc.php' );
define('UPPSITE_COMMENTS_FACEBOOK_URL', 'http://graph.facebook.com/comments/?limit=%d&ids=%s');
define('UPPSITE_COMMENTS_LIMIT', 25);
class UppSiteCommentSystem {
    const ORIGINAL = 0;
    const DISQUS = 1;
    const FACEBOOK = 2;
}
function uppsite_comments_transient_name($post_id) {
    return "uppsite_comments_" . $post_id;
}
function uppsite_comments_disqus_get($post_id, $limit) {
    global $dsq_api;
    $identifier = dsq_identifier_for_post( get_post( $post_id ) );
    $response = $dsq_api->api->get_thread_posts(null, array(
        'thread_identifier'	=> $identifier,
        'filter' => DISQUS_STATE_APPROVED,
        'limit' => $limit
    ));
    $comments = array();
    if (is_array($response)) {
        foreach ($response as $comment) {
            $commentData = new stdClass();
            $commentData->comment_ID = $comment->id;
            $commentData->comment_post_ID = $post_id;
            $commentData->comment_date = $comment->created_at;
            $commentData->comment_date_gmt = $comment->created_at;
            $commentData->comment_content = apply_filters('pre_comment_content', $comment->message);
            $commentData->comment_approved = 1;
            $commentData->comment_author = $comment->is_anonymous ? $comment->anonymous_author->name : $comment->author->display_name;
            $commentData->comment_author_email = $comment->is_anonymous ? $comment->anonymous_author->email : $comment->author->email;
            $commentData->comment_author_url = $comment->is_anonymous ? $comment->anonymous_author->url : $comment->author->url;
            $comments[] = $commentData;
        }
        $comments = array_reverse($comments);
    }
    return $comments;
}
function uppsite_comments_facebook_parse_array($post_id, $commentArr) {
    $commentData = new stdClass();
    $commentData->comment_ID = $commentArr['id'];
    $commentData->comment_post_ID = $post_id;
    $commentData->comment_date = $commentArr['created_time'];
    $commentData->comment_date_gmt = $commentArr['created_time'];
    $commentData->comment_content = apply_filters('pre_comment_content', $commentArr['message']);
    $commentData->comment_approved = 1;
    $commentData->comment_author = $commentArr['from']['name'];
    $commentData->comment_author_email = '';
    $commentData->comment_author_url = "http://facebook.com/" . $commentArr['from']['id'];
    return $commentData;
}
function uppsite_comments_facebook_get($comments, $post_id, $limit) {
    $permalink = get_permalink( $post_id );
    $comments_link = sprintf( UPPSITE_COMMENTS_FACEBOOK_URL, $limit, $permalink );
    $comment_json = wp_remote_get( $comments_link );
    $comments_arr = null;
    if (!is_wp_error($comment_json)) {
        $comments_arr = json_decode($comment_json['body'], true);
    }
    if (!is_array($comments)) {
        $comments = array();
    }
    if (is_array($comments_arr) &&
        array_key_exists($permalink, $comments_arr) &&
        array_key_exists('comments', $comments_arr[$permalink]) &&
        array_key_exists('data', $comments_arr[$permalink]['comments'])) {
        $comments_list = $comments_arr[$permalink]['comments']['data'];
        foreach ($comments_list as $comment) {
            $comments[] = uppsite_comments_facebook_parse_array($post_id, $comment);
            if (array_key_exists('comments', $comment)) {
                foreach ($comment['comments']['data'] as $innerComment) {
                    $comments[] = uppsite_comments_facebook_parse_array($post_id, $innerComment);
                }
            }
        }
    }
    return $comments;
}
function uppsite_comments_disqus_insert($commentData) {
    global $dsq_api;
    $post = get_post( $commentData['comment_post_ID'] );
    $identifier = dsq_identifier_for_post( $post );
    $thread = $dsq_api->api->thread_by_identifier($identifier, $post->post_title);
    if (!is_object($thread) || !isset($thread->thread) || !isset($thread->thread->id)) {
        return false;
    }
    $threadId = $thread->thread->id;
    $ret = $dsq_api->api->create_post(
        $threadId,
        $commentData['comment_content'],
        $commentData['comment_author'],
        $commentData['comment_author_email'],
        array(
            'author_url' => $commentData['comment_author_url'],
            'state' => 'approved'
        )
    );
    return is_object($ret) && is_null($dsq_api->api->last_error);
}
function uppsite_comments_get_system() {
    global $dsq_api;
    if (function_exists('dsq_is_installed') && dsq_is_installed() &&         class_exists('DisqusWordPressAPI') && $dsq_api instanceof DisqusWordPressAPI &&         isset($dsq_api->api) && method_exists($dsq_api->api, 'create_post') && method_exists($dsq_api->api, 'get_thread_posts')) {         return UppSiteCommentSystem::DISQUS;
    }
    if (class_exists( 'Facebook_Comments' ) && get_option( 'facebook_comments_enabled' )) {
        return UppSiteCommentSystem::FACEBOOK;
    }
    return UppSiteCommentSystem::ORIGINAL;
}
function uppsite_comments_get($comments, $post_id, $limit = UPPSITE_COMMENTS_LIMIT) {
    $system = uppsite_comments_get_system();
    if ($system != UppSiteCommentSystem::ORIGINAL) {
        $transientName = uppsite_comments_transient_name( $post_id );
        if ( false === ( $comments = get_transient( $transientName ) ) ) {
            switch ($system) {
                case UppSiteCommentSystem::DISQUS:
                    $comments = uppsite_comments_disqus_get( $post_id, $limit );
                    break;
                case UppSiteCommentSystem::FACEBOOK:
                    $comments = uppsite_comments_facebook_get( $comments, $post_id, $limit );
                    break;
            }
            set_transient( $transientName, $comments, 10 * MINUTE_IN_SECONDS );
        }
    }
    return $comments; }
function uppsite_comments_pre($comment_post_ID) {
    global $msap;
    if (!$msap->has_custom_theme()) { return $comment_post_ID; }
    if ( ( $system = uppsite_comments_get_system() ) == UppSiteCommentSystem::ORIGINAL ) {
                return $comment_post_ID;
    }
        $commentData = array(
        'comment_author' => ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null,
        'comment_content' => ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null,
        'comment_author_url' => ( isset($_POST['url']) )     ? trim($_POST['url']) : null,
        'comment_author_email' => ( isset($_POST['email']) )   ? trim($_POST['email']) : null,
        'comment_post_ID' => $comment_post_ID
    );
    $comment = null;
    switch ($system) {
        case UppSiteCommentSystem::DISQUS:
            $comment = uppsite_comments_disqus_insert($commentData);
            break;
        case UppSiteCommentSystem::FACEBOOK:
            return $comment_post_ID;                         break;
    }
    if ($comment) {
                delete_transient( uppsite_comments_transient_name( $comment_post_ID ) );
                apply_filters('comment_post_redirect', null, $comment);
    }
    wp_die(); }
function uppsite_comments_open($post_id) {
    $system = uppsite_comments_get_system();
    $user = wp_get_current_user();
    switch ($system) {
        case UppSiteCommentSystem::ORIGINAL:
                        $userExists = $user !== false && !empty( $user->ID );
            return comments_open( $post_id ) && ( $userExists || ! get_option( 'comment_registration' ) );
            break;
        case UppSiteCommentSystem::DISQUS:
            return true;
            break;
        case UppSiteCommentSystem::FACEBOOK:
            $_post = get_post( $post_id );
            return (!$_post || !Facebook_Comments::comments_enabled_for_post_type( $_post ));
            break;
    }
}
add_action('pre_comment_on_post', 'uppsite_comments_pre', 1); 
