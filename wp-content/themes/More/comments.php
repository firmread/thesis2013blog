<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	<a name="comments"></a>
	<h6 class="sep_bg colored comments-title"><?php comments_number(__(' No Comments', 'themeText'), __(' 1 Comment', 'themeText'), __( ' % Comments', 'themeText') )?></h6>

	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'theme_comments' ) ); ?>
	</ol>

    <div class="navigation group">
        <div class="prev-posts align"><?php previous_comments_link('&larr;'); ?></div>
        <div class="next-posts oppalign"><?php next_comments_link('&rarr;'); ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>

	<?php endif; ?>
	
<?php endif; ?>                     
                        
 <?php if ('open' == $post->comment_status) : ?>                       
                   <div id="respond" class="respond row">

	<div class="span8">     
                  <h3 class="sep_bg"><?php echo __( 'Leave a Comment', 'themeText' ); ?></h3>
		<p><?php echo __( 'Please keep in mind that comments are moderated and <code>rel="nofollow"</code> is in use. So, please do not use a spammy keyword or a domain as your name, or it will be deleted. Let us have a personal and meaningful conversation instead.', 'themeText' ); ?></p>
	</div>
    	<div class="span8">
 
		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>
        		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p><?php echo __( 'You must be', 'themeText' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php echo __( 'logged in', 'responsy' ); ?></a> <?php echo __( 'to post a comment.', 'themeText' ); ?></p>
		<?php else : ?>
                                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="form">
                                	<?php if ( $user_ID ) : ?>
		 
			<p><?php echo __( 'Logged in as', 'themeText' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php echo __( 'Log out &raquo;', 'themeText' ); ?></a></p>
		 
			<?php else : ?>														
       <!--[if IE]><label for="name"><?php _e('Name:', 'themeText'); ?></label><![endif]--><input style="margin-right:25px;" name="author" class="span2" type="text" placeholder="<?php _e('Name:', 'themeText'); ?>" value="<?php echo $comment_author; ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
       
       <!--[if IE]><label for="name"><?php _e('Email:', 'themeText'); ?></label><![endif]--><input name="email" type="text" class="span2" style="margin-right:25px;" placeholder="<?php _e( 'Email', 'themeText' ); ?>" value="<?php echo $comment_author_email; ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
        
        <!--[if IE]><label for="name"><?php _e('your website (optional):', 'themeText'); ?></label><![endif]--><input name="url" type="text" class="span2"  placeholder="<?php _e( 'your website (optional)', 'themeText' ); ?>" value="<?php echo $comment_author_url; ?>" tabindex="3" />
        <?php endif; ?>
       
       <!--[if IE]><label for="name"><?php _e('Your Comment:', 'themeText'); ?></label><![endif]--><textarea name="comment" type="text" placeholder="<?php _e( 'Your Comment...', 'themeText' ); ?>" rows="5" class="span8" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?>></textarea>
       
       <input name="submit" type="submit" value="<?php _e( 'Send Comment', 'themeText' ); ?>"  class="btn btn-small btn-info"><?php comment_id_fields(); ?>
                               
                               <?php do_action('comment_form', $post->ID); ?>
                                </form>
<?php endif; // If registration required and not logged in ?>
</div>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>