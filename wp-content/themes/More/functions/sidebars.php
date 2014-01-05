<?php
/*-----------------------------------------------------------------------------------

	Sidebars

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'theme_sidebars' );
function theme_sidebars() {

	
	// Blog Sidebar
	register_sidebar(
		array(
			'id' => 'blog-sidebar',
			'name' => __( 'Blog Sidebar', 'themeText' ),
			'description' => __( 'A short description of the sidebar.', 'themeText' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>'
		)
	);
	
	
	// Contact Page Sidebar
	register_sidebar(
		array(
			'id' => 'contact-sidebar',
			'name' => __( 'Contact Page Sidebar', 'themeText' ),
			'description' => __( 'A short description of the sidebar.', 'themeText' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>'
		)
	);
}
?>