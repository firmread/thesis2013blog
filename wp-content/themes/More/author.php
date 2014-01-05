 <?php get_header(); ?> 
  
    <!--WELCOME AREA-->
    <div class="container">
        <div class="row">
            <div class="span12">
            <div class="welcome">

            <h1><span class="colored"><?php echo __( 'Author Archive For', 'themeText' ); ?></span><span class="grey_colored"> / '<?php echo trim( wp_title( '', false ) ); ?>'</span></h1>
            <div class="divider"></div>
            </div></div>
        </div>
    </div>
    <!--/WELCOME AREA-->
    
    <!--PAGE CONTENT-->
    <div class="container" style="margin-bottom:50px;">
    	<div class="row">
			<div class="span8">
               	  <div class="row">
                   <?php
      if (have_posts()) : while (have_posts()) : the_post();
   ?>
        	  <div class="span8 blog_post">
               	  <div class="row">
                        	<div class="span2">
                                <h3 class="sep_bg"><?php the_time('F j, Y') ?></h3>
                                <div class="meta">
                                    <span><strong><i class="icon-list-alt"></i> <?php the_category(' '); ?></strong></span>
                                    <span><strong><i class="icon-user"></i> <?php _e('', 'themeText'); ?> <?php the_author(); ?></strong></span>
                                    <span><strong><i class="icon-comment"></i>  <?php comments_popup_link(__('No Comments', 'themeText'), __('1 Comment', 'themeText'), __( '% Comments', 'themeText') ); ?></strong></span>
                                    <hr>
                                    
            
                                </div>
                            </div>
                            <div class="span6">
                            	<div class="row">
                                    <div class="span6 block">
                                        <div class="view view-first">
                                          <?php the_post_thumbnail(); ?>  
                                            <div class="mask">
                                            <?php if (has_post_thumbnail( $post->ID ) ): 
											$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
											
											?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ); ?>

                                                <a href="<?php echo $url; ?>" rel="prettyPhoto" class="info"></a>
                                                <a href="<?php the_permalink() ?>" class="link"></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                            		<br class="clearfix">         


                            		<div class="span6">
                                        <div>
                                            <h3 class="sep_bg"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                                            <p><?php the_excerpt(); ?></p>
                                            <a href="<?php the_permalink() ?>" class="btn btn-small btn-info"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/more.png" alt="" /> Read more</a>
                                        </div>
                                    </div>
                                    
                                </div>    
                            </div>
                            
                	</div>
              	</div>
           <?php 
    endwhile; 
		include (get_template_directory() . '/inc/nav.php' );
	endif;
	?>     
</div></div>
  <div class="span4 sidebar hidden-phone">
            
<?php get_sidebar(); ?>        
</div></div>
      
    </div>
    <?php get_footer(); ?>