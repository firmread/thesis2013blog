<?php
/* Template Name: Full width Page */
?>

<?php get_header(); ?>
 <div class="container" style="margin-bottom:50px;">
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
        

    	<div class="row">
        	<div class="span12">
            	
           <?php if ( have_posts() ) : ?>
			
				<?php while ( have_posts() ) : the_post(); ?>
					
					<!-- content -->
					<?php the_content(); ?>
					<!-- end content -->
				
				<?php endwhile; ?>
			
			<?php endif; ?> 		
            
        </div>
    </div></div>

	<?php get_footer(); ?>