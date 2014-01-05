 <?php get_header(); ?> 
  
    <!--WELCOME AREA-->
    <div class="container">
        <div class="row">
            <div class="span12">
            <div class="welcome">
           <?php
				$page_name = trim( wp_title( '', false ) );
				$page = get_page_by_title( $page_name );
			?>
            <h1><span class="colored"><?php echo trim( wp_title( '', false ) ); ?></span><span class="grey_colored"> / <?php echo get_post_meta( $page->ID, 'page_subtitle', true ); ?></span></h1>
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
                        	
                            <div class="span8">
                            	<div class="row">
                                    <div class="span8 block">
                                        <div class="view view-first">
                                        <?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-list' ); 
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
if ($image) : ?>
    <img src="<?php echo $image[0]; ?>" alt="" />
<?php endif; ?> 
                                            
                                            <div class="mask">
                                          <a href="<?php echo $url; ?>" rel="prettyPhoto" class="info"></a>
                                                <a href="<?php the_permalink() ?>" class="link"></a>
                                                
                                            </div>
                                        </div>
                                    </div>

                            		<br class="clearfix">         

<div class="span2">
                                <h3 style="font-weight:300;text-align:right"><?php the_time('F j, Y') ?> </h3><hr>
                                <div class="meta hidden-phone">
                                    <span><?php the_category(' '); ?> <i class="icon-list-alt"></i></span>
                                    <span><?php _e('', 'themeText'); ?> <?php the_author(); ?> <i class="icon-user"></i></span>
                                    <span><?php comments_popup_link(__('No Comments', 'themeText'), __('1 Comment', 'themeText'), __( '% Comments', 'themeText') ); ?> <i class="icon-comment"></i></span>
                                    <hr>
                                    
            
                                </div>
                            </div>
                            		<div class="span6">
                                        <div>
                                            <div class="welcome"><h3 class="sep_bg"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3></div>
                                            <p><?php wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore'); ?>
</p>
                                            <div class="read-more"><a href="<?php the_permalink() ?>">Read more &rarr;</a></div>
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