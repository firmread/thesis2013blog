    
            <!-- END #content -->
            </div>
            
        <!-- END #container -->
        </div> 
        
        <!-- BEGIN #footer -->
        <div id="footer" class="clearfix">
        
            <p class="copyright">&copy; Copyright <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> <br /> <?php _e('Powered by', 'framework') ?> WordPress and <a href="http://themessky.com/">Gridlocked Theme</a></p>
            
            <p class="credit"><?php echo get_option('tz_footer_copy'); ?></p>

        
        <!-- END #footer -->
        </div>
		
	<!-- Theme Hook -->
	<?php wp_footer(); ?>
			
<!--END body-->
</body>
<!--END html-->
</html>
