<?php
	if ( get_post_type() == 'page' )
	{
	?>

			<!-- SEARCH - WIDGET -->
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("page_search_sidebar") ) : ?>
				<?php endif; ?>
			<!-- end SEARCH - WIDGET -->

			<!-- WIDGET -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("page_sidebar_1") ) : ?>
			<?php endif; ?>
			<!-- end WIDGET -->
		
			<!-- WIDGET -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("page_sidebar_2") ) : ?>
			<?php endif; ?>
			<!-- end WIDGET -->
			
			<!-- WIDGET -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("page_sidebar_3") ) : ?>
			<?php endif; ?>
			<!-- end WIDGET -->


<?php
	}
	else
	{
	?>

			<!-- SEARCH - WIDGET -->
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("blog_search_sidebar") ) : ?>
				<?php endif; ?>
			<!-- end SEARCH - WIDGET -->

			<!-- WIDGET -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("blog_sidebar_1") ) : ?>
			<?php endif; ?>
			<!-- end WIDGET -->
		
			<!-- WIDGET -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("blog_sidebar_2") ) : ?>
			<?php endif; ?>
			<!-- end WIDGET -->
			
			<!-- WIDGET -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("blog_sidebar_3") ) : ?>
			<?php endif; ?>
			<!-- end WIDGET -->
            
            <!-- WIDGET -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("blog_sidebar_4") ) : ?>
			<?php endif; ?>
			<!-- end WIDGET -->


            <!-- WIDGET -->
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("blog_sidebar_5") ) : ?>
			<?php endif; ?>
			<!-- end WIDGET -->
<?php
	}
?>