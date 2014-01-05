<?php 
/* Template name: Archives */ 
?>

<?php get_header(); ?>
  <div class="container">
        <div class="row">
        	<div class="span12">
             <div class="welcome">
            <?php
				$page_name = trim( wp_title( '', false ) );
				$page = get_page_by_title( $page_name );
			?>
            <h1><span class="colored"><?php echo trim( wp_title( '', false ) ); ?></span><span class="grey_colored"> / <?php echo get_post_meta( $page->ID, 'page_subtitle', true ); ?></span></h1><div class="divider"></div>
			</div>
                           
            <div class="row">
				<div class="span3">
                        	<div class="price price-active">
                                <div class="well">
                                    <h6 class="sep_bg"><span class="label label-inverse"><?php _e('Latest 10 Project', 'themeText'); ?></h6>
                                    <ul class="unstyled">
                                     <?php
          query_posts('post_type=portfolio&showposts=10');
          while (have_posts()) : the_post();
         ?>
                                        <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                                     <?php endwhile; ?>
    
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                                    <div class="span3">
                        	<div class="price price-active">
                                <div class="well">
                                <h6 class="sep_bg"><span class="label label-inverse"><?php _e('Latest 20 Posts', 'themeText'); ?></span></h6>
                                    <ul class="unstyled">
                                     <?php
          query_posts('showposts=20');
          while (have_posts()) : the_post(); 
         ?>
                       <li>
                      <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>                  		</li>
                                     <?php endwhile; ?>
    
                                    </ul>
                                </div>
                            </div>
                        </div>
                         <div class="span2">
                        	<div class="price price-active">
                                <div class="well">
                                    <h6 class="sep_bg"><span class="label label-inverse"><?php _e('Archives by Cat.', 'themeText'); ?></h6>
                                    <ul class="unstyled">
                                     <?php wp_list_categories('title_li='); ?>
    
                                    </ul>
                                </div>
                            </div>
                            <div class="price price-active">
                                <div class="well">
                                    <h6 class="sep_bg"><span class="label label-inverse"><?php _e('Archives by Month', 'themeText'); ?></h6>
                                    <ul class="unstyled">
                                     <?php wp_get_archives('type=monthly'); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        
                        <!-- end row -->
                         <div class="span4 sidebar hidden-phone">
                        <?php get_sidebar(); ?>
						</div>
									</div>
								</div>
							
                            </div>
    <!-- end CONTAINER --></div>
<?php get_footer(); ?>                        