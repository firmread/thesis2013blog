<?php
/*-----------------------------------------------------------------------------------

	Comments template 

-----------------------------------------------------------------------------------*/

function theme_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<article <?php comment_class('group'); ?> id="comment-<?php comment_ID(); ?>">
 <header class="comment-author vcard">
		<?php echo get_avatar($comment,$size='38',$default='<path_to_url>' ); ?>
    <?php printf(__('<span class="fn">%s</span>'), get_comment_author_link()) ?>
    <span class="time"><?php printf(__('%1$s'), get_comment_date(' M d, Y')) ?></span>
  </header>
  <div class="comment-text">      
	<?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.') ?></em>
          <br /><br />
    <?php endif; ?>

    <?php comment_text() ?>
    
    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    <?php edit_comment_link(__('(Edit)'),'  ','') ?>
 </div>
</article>
<?php
}
?>