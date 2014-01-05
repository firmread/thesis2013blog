<?php 
/* Template name: Homepage */ 
?>

<?php get_header(); ?>
    
     <!--PAGE CONTENT-->
  <?php if (get_option('of_hp_titles') == 'is_on'){ ?>  <div class="container" style="margin-top:40px;">
    	<div class="row">
        	<div class="span12">

                        <div class="presentation">

                            	<div class="">
                                <div class="taglinedesc"><?php echo get_option('of_hp_main_small_title'); ?></div>
                            		<h1><span class="colored"><?php echo get_option('of_hp_main_title'); ?></span><br><?php echo get_option('of_hp_main_title_description'); ?></h1>
                                    <hr class="dashed">
                                    <div class="row">
    <div class="span6 offset6 taglinequite"><?php echo get_option('of_hp_main_small_blockquite'); ?></div>
  </div>
                            	</div>
                                
         					</div>
        				 </div>
         			</div>
         		</div><hr class="black"><?php } ?>
             <div class="container" style="margin-bottom:50px;">
    	<?php if (get_option('of_hp_thumbs') == 'is_on'){ ?> <div class="row">
               
		    
              
           
               <div class="span12">
<?php if (get_option('of_portfolio_title_off') == 'true'){  // Hide/show Content Title ?>
                       <h3 class="titlemore"><span class="slash-colored">//</span> <?php echo get_option('of_hp_portfolio_title');?></h3><?php } else{ ?><?php } ?>
                       
                 <ul class="unstyled" id="themeFilterableNav">
				 <li class="filter-tab">FILTER</li>
				 <?php $pf_terms = get_categories( 'type=portfolio&taxonomy=department' ); ?>
                 <li class="active-tag"><a data-filter="*" href="#"><?php echo __( 'all', 'themeText' ); ?></a></li>
                  
                    <?php foreach( $pf_terms as $pf_term ) : ?>
                    <li><a href="#" data-filter=".<?php echo $pf_term->slug; ?>"><?php echo $pf_term->name; ?></a>
</li>
                    <?php endforeach; ?>
                   
                </ul><hr class="dashed">
					<div id="portfolio" class="row">
                     <?php
				if ( have_posts() ) :
				
					$args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1 );
					$loop = new WP_Query( $args );
					
					while ( $loop->have_posts() ) : $loop->the_post();
						
						$terms = get_the_terms( $post->ID, 'department' );
						$on_draught = '';
						
					if ( $terms && ! is_wp_error( $terms ) ) :
						
						$draught_links = array();

						foreach ( $terms as $term )
						{
							$draught_links[] = $term->slug;
						}
				
						$on_draught = join( ", ", $draught_links );
						
					endif;
				?>
                            <div class="span2 <?php echo $on_draught; ?> block">
                                <div class="view view-first">
                                    
                                                <?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home_latest_portfolio_img' ); 
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
if ($image) : ?>
    <img src="<?php echo $image[0]; ?>" alt="" />
<?php endif; ?> 
                                    <div class="mask">
                                        <a href="<?php echo $url; ?>" rel="prettyPhoto" class="info"></a>
                                                    <a href="<?php the_permalink(); ?>" class="link"></a>
                                       <br /><div class="descr2">
                                    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                    
                                 </div>         
                                    </div>
                                 </div>
                                 
                            </div>
						
                           
                          <?php
								endwhile;
							endif;
							wp_reset_query();
						?>
                            
                        </div></div></div><?php
				}
			?>
                             <section>
                                <div class="row">
                                  <div class="span12">
                                        <div class="titlemore">
                                            <h3 class="pull-left" style="margin-bottom:0px;"><span class="slash-colored">//</span> <?php echo get_option('of_hp_blog_title');?></h3>
                                        <div class="clearfix"></div>
                                        </div></div></div>
                                       
                                  <div class="row">
                                            <?php
          $loop = new WP_Query('post_type=post&showposts=4'); 
          if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
         ?>
                                             <div class="span3">
                                             <div class=" blockblog">
                                                    <div class="view view-first nolink noshadow">
                                                    <?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home_latest_post_img' ); 
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
if ($image) : ?>
    <img src="<?php echo $image[0]; ?>" alt="" />
<?php endif; ?> 
                                                      
                                                        <div class="mask">
                                                          <a href="<?php echo $url; ?>" rel="prettyPhoto" class="info"></a>
                                                        </div>
                                                    </div>
                                                   &nbsp;<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                     <span style="text-align:left"><?php the_time('F j, Y') ?></span>
                                             <hr>
                                                 <?php wpe_excerpt('wpe_excerptlength_home', 'wpe_excerptmore'); ?>
                                                <div class="read-more"><a href="<?php the_permalink() ?>">Read more &rarr;</a></div>
                                                
                                          </div></div>  <?php 
          endwhile; endif; 
         ?>
                                  
               </div>    </section>              
  <?php if (get_option('of_featured_titles') == 'is_on'){ ?>
<div class="row">
                                            <div class="span12">
                                <div class="hero-unit sep_bg">
                                	<h1><b><?php echo get_option('of_featured_main_title'); ?></b></h1><p><?php echo get_option('of_featured_main_desc'); ?></p><p><a class="featbtn" href="<?php echo get_option('of_featured_button_url'); ?>"><b><?php echo get_option('of_featured_button_text'); ?></b></a>
                                </div></div></div>
                                <?php } ?>
                                 <div class="clearfix"></div>
                                <?php if (get_option('of_hp_clients') == 'is_on'){ ?>
                                
                                	
                                        <h3 class="titlemore"><span class="slash-colored">//</span> <?php echo get_option('of_hp_clients_title'); ?></h3>
                                        <div class="row">
                                            <div class="span12">
                                                <div class="row">
                                                
                                                    <div class="span2 block">
                                                        <div class="view view-first noinfo">
                                                    <img class="bordered" src="<?php echo get_option('of_client1_logo'); ?>" alt="" />
                                                            <div class="mask">
                                                                <a href="<?php echo get_option('of_client1_url'); ?>" class="link"></a>
                                                            </div>
                                                        </div>
                                                    </div>
													
                                                        <div class="span2 block">
                                        	<div class="view view-first noinfo">
                                                <img class="bordered" src="<?php echo get_option('of_client2_logo'); ?>" alt="" />
                                                <div class="mask">
                                                    <a href="<?php echo get_option('of_client2_url'); ?>" class="link"></a>
                                                </div>
                                            </div>
                                        </div>
										
                                        <div class="span2 block">
                                        	<div class="view view-first noinfo">
                                                <img class="bordered" src="<?php echo get_option('of_client3_logo'); ?>" alt="" />
                                                <div class="mask">
                                                    <a href="<?php echo get_option('of_client3_url'); ?>" class="link"></a>
                                                </div>
                                            </div>
                                        </div>
										
                                        <div class="span2 block">
                                        	<div class="view view-first noinfo">
                                                <img class="bordered" src="<?php echo get_option('of_client4_logo'); ?>" alt="" />
                                                <div class="mask">
                                                    <a href="<?php echo get_option('of_client4_url'); ?>" class="link"></a>
                                                </div>
                                            </div>
                                        </div>
										
                                        <div class="span2 block">
                                        	<div class="view view-first noinfo">
                                                <img class="bordered" src="<?php echo get_option('of_client5_logo'); ?>" alt="" />
                                                <div class="mask">
                                                    <a href="<?php echo get_option('of_client5_url'); ?>" class="link"></a>
                                                </div>
                                            </div>
                                        </div>
										
                                        <div class="span2 block">
                                        	<div class="view view-first noinfo">
                                                <img class="bordered" src="<?php echo get_option('of_client6_logo'); ?>" alt="" />
                                                <div class="mask">
                                                    <a href="<?php echo get_option('of_client6_url'); ?>" class="link"></a>
                                                </div>
                                            </div>
                                        </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                            
                                            <hr>
                                            
                                            
                                            
                         
                                   
                                   </div>
                                  
                                <?php } ?>
                                
                    </div>
                    
                    
                    
                
            
    <!--PAGE CONTENT-->

 <?php get_footer(); ?>

  
