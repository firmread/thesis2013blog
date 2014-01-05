	<?php get_header(); ?>
 <?php
		if ( get_post_type() == 'portfolio' )
		{
			if( have_posts() ) :

				while( have_posts() ) : the_post();
				
					$terms = get_the_terms( $post->ID, 'department' );
					$on_draught = '';
					
				if ( $terms && ! is_wp_error( $terms ) ) :
					
					$draught_links = array();

					foreach ( $terms as $term )
					{
						$draught_links[] = $term->name;
					}
			
					$on_draught = join( ", ", $draught_links );
					
				endif;
				?>  
 <!--WELCOME AREA-->
 <div class="container" style="margin-bottom:50px;">
        <div class="row">
        	<div class="span12">
            <div class="welcome">
            
            <h1><span class="colored"><?php the_title(); ?></span><span class="grey_colored"> / <?php echo $on_draught; ?></span></h1>
            <div class="divider"></div>
            </div>
            </div>
        </div>
    <!--/WELCOME AREA-->
    
    <!--PAGE CONTENT-->

        <div class="row">
 <?php
						if ( get_post_meta( $post->ID, 'portfoio_format_type2', true ) )
						{
						?>
               <div class="span9">
                <div class="slider_area">
                    <div class="theme-default">
                        <div id="slider" class="nivoSlider">
                     <?php
										if ( get_post_meta( $post->ID, 'upload_one', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_one', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_two', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_two', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_three', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_three', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_four', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_four', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_five', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_five', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_six', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_six', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_seven', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_seven', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_eight', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_eight', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_nine', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_nine', true ); ?>" alt="<?php the_title(); ?>" /><?php }
										
										if ( get_post_meta( $post->ID, 'upload_ten', true ) != "" )
										{ ?><img src="<?php  echo get_post_meta( $post->ID, 'upload_ten', true ); ?>" alt="<?php the_title(); ?>" /><?php }
									?>
                                    </div>
                    </div>
                </div>
            </div>
              <?php
						}
						elseif ( get_post_meta( $post->ID, 'portfoio_format_type3', true ) )
						{
						?>
               
               <div class="span9">
                <div class="slider_area video-container">
			<?php echo get_post_meta( $post->ID, 'portfolio_video_code', true ); ?>

                </div>
            </div>
            
           <?php
						}
						else
						{
						?>
            
                    <div class="span9">
                <div class="slider_area">
                                                                     <?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
if ($image) : ?>
    <img src="<?php echo $image[0]; ?>" alt="" />
<?php endif; ?> 
											
										<?php ?>
                </div>
            </div>
           <?php
						}
					?> 
            <div class="span3">
            <h6 class="prtHeadTitle"><?php the_title(); ?> INFO</h6><div class="margintop10"></div>
            	<?php
						if ( get_post_meta( $post->ID, 'project', true ) != "" ) { echo '<p><strong>' . __( 'Project', 'themeText' ) . '</strong> : ' . get_post_meta( $post->ID, 'project', true ) . '</p><hr class="prtLine"/>'; }
						
						if ( get_post_meta( $post->ID, 'client', true ) != "" ) { echo '<p><strong>' . __( 'Client', 'themeText' ) . '</strong> : ' . get_post_meta( $post->ID, 'client', true ) . '</p><hr class="prtLine"/>'; }
						
						if ( get_post_meta( $post->ID, 'long_description', true ) != "" ) { echo '<p><strong>' . __( 'Description', 'themeText' ) . '</strong><br />' . get_post_meta( $post->ID, 'long_description', true ) . '</p><hr class="prtLine"/>'; }
						
						if ( get_post_meta( $post->ID, 'technology', true ) != "" ) { echo '<p><strong>' . __( 'Technology', 'themeText' ) . '</strong> :' . get_post_meta( $post->ID, 'technology', true ) . '</p>'; }?><hr class="prtLine"/>
						 <?php the_content(); ?>
						<?php
						if ( get_post_meta( $post->ID, 'launch_project_url', true ) != "" )
						{
							if ( get_post_meta( $post->ID, 'project_url_new_window', true ) ) { $project_url_new_window_out = 'target="_blank"'; }
							

							echo '<a ' . $project_url_new_window_out . ' href="' . get_post_meta( $post->ID, 'launch_project_url', true ) . '" class="featbtn2">'  . __( 'Launch Project', 'themeText' ) . ' &rarr;</a>';
						}
					?>
             
            </div> 
        </div>
         </div>
<?php
				endwhile;
			endif;
		}
	?>

<?php get_footer(); ?>
                

    <!--PAGE CONTENT-->