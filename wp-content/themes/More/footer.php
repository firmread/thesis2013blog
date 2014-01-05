<!--FOOTER-->
    <footer>
    	<div class="container">
        	<div class="row">
            	 <!-- widget --> 
                <div class="span3">
                <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( "footer_sidebar_1" ) ) : ?>
					<?php endif; ?>
                </div>
<!-- end widget -->
 <!-- widget -->
				<div class="span3">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( "footer_sidebar_2" ) ) : ?>
					<?php endif; ?>
				</div>
                <!-- end widget -->
				
                <!-- widget -->
				<div class="span3">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( "footer_sidebar_3" ) ) : ?>
					<?php endif; ?>
				</div>
                <!-- end widget -->
				
                <!-- widget -->
				<div class="span3">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( "footer_sidebar_4" ) ) : ?>
					<?php endif; ?>
				</div>
                <!-- end widget -->
                
            </div>
        </div>
    	<hr class="bottom">
        <div class="bottom_line">
            <div class="container">
                <div class="row">
                    <div class="span6">
                        <span style="font-size:11px;"><?php echo get_option('of_footer_copyright'); ?></span>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!--/FOOTER-->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/custom.js"></script>
    
 <!--[if IE]>
    <script type="text/javascript">
        runFancy = false;
    </script>
    <![endif]-->
    <script type="text/javascript">
		if (runFancy) {
			jQuery.noConflict()(function($){
			$(".view").preloader();
			$(".theme-default").preloader();
			});
		};
    </script>
<?php echo stripcslashes( get_option('of_tracking_code') ); // Tracking code (Google Analytics) ?>
<?php wp_footer(); ?>


	</body>
</html>
