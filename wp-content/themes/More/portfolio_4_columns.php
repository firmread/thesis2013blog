<?php 
/* Template name: Portfolio 4 Columns*/ 
?>


<?php get_header(); ?>
        
        <!--PAGE HEADER -->
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
            	</div>
            </div>
        </div>
    </div>
                <!-- end PAGE HEADER -->
               
                <!--FILTERS-->
    <div class="container" style="margin-bottom:50px;">
        <div class="row">
            <div class="span12">
                 <ul class="unstyled" id="themeFilterableNav">
				 <li class="filter-tab">FILTER</li>
				 <?php $pf_terms = get_categories( 'type=portfolio&taxonomy=department' ); ?>
                 <li class="active-tag"><a data-filter="*" href="#"><?php echo __( 'all', 'themeText' ); ?></a></li>
                  
                    <?php foreach( $pf_terms as $pf_term ) : ?>
                    <li><a href="#" data-filter=".<?php echo $pf_term->slug; ?>"><?php echo $pf_term->name; ?></a>
</li>
                    <?php endforeach; ?>
                   
                </ul>
            </div>
        </div>
                <!-- end FILTERS -->

                <!-- PORTFOLIO -->
                <section style="padding-top:25px !important;">
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
					<div class="span3 <?php echo $on_draught; ?> block ">
                    
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
							</div>
						</div>
						<div class="descr"><h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5></div>
						<p style="text-align:center"><?php echo get_post_meta( $post->ID, 'short_description', true ); ?></p>
					</div>
				<?php
					endwhile;
				endif;
				wp_reset_query();
				?>
                </div>
                <!-- end PORTFOLIO -->
        </section>
        <!-- end ************************** MIDDLE -->
    </div>
    <!-- end ************************** CONTAINER -->
   <?php get_footer(); ?>