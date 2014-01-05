	<?php get_header(); ?>
   
    <!--WELCOME AREA-->
    <div class="container">
        <div class="row">
            <div class="span12">
            <div class="welcome">
<h1 class="colored"><?php the_title(); ?></h1></div>
<div class="divider"></div>
            </div>
        </div>
    </div>
    <!--/WELCOME AREA-->
    
    <!--PAGE CONTENT-->
    <div class="container" style="margin-bottom:50px;">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<div class="row">
        	<div class="span8">
            	<div class="row">
                 <?php
      if (have_posts()) : while (have_posts()) : the_post();
   ?>
                    <div class="span8 blog_post">
                    	<div class="row">
                        	<div class="span8">
                            <div class="view view-first">
                                                                                  <?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
if ($image) : ?>
    <img src="<?php echo $image[0]; ?>" alt="" />
<?php endif; ?> 
                                	</div>
                                </div>
                   
                        	</div>
                        </div>
                        <div class="span8">
                    	<div class="row">
                            <div class="span2">
                                <h3 style="font-weight:300;text-align:right"><?php the_time('F j, Y') ?> </h3><hr>
                               <div class="meta  hidden-phone">
                                    <span><?php the_category(' '); ?> <i class="icon-list-alt"></i></span>
                                    <span><?php _e('', 'themeText'); ?> <?php the_author(); ?> <i class="icon-user"></i></span>
                                    <span> <?php comments_popup_link(__('No Comments', 'themeText'), __('1 Comment', 'themeText'), __( '% Comments', 'themeText') ); ?> <i class="icon-comment"></i></span>
                                    <hr>

                                </div>
                            </div>
                            <div class="span6">
                                 
                                <?php the_content(); ?>
                              <p style="color:#65686A;font-style:italic;">Tagged with: <?php the_tags(' ',' • ','<br />'); ?></p>

                            </div>
                        </div>
                 
                    
   <?php comments_template(); ?>
   
  <?php endwhile; endif;?>
                    
                </div>
            </div></div>
            
            <div class="span4 sidebar hidden-phone">
            
<?php get_sidebar(); ?>        
                
            </div>
            
        </div></div>
    </div>
    <!--PAGE CONTENT-->
    <?php get_footer(); ?>