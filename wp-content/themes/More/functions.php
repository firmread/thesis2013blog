<?php

/*  THEME OPTIONS PANEL
-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

if ( get_stylesheet_directory() == get_template_directory() ) {
	define('OF_FILEPATH', get_template_directory());
	define('OF_DIRECTORY', get_template_directory_uri());
} else {
	define('OF_FILEPATH', get_stylesheet_directory());
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
}

/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php');	// Theme actions based on options settings




/*  Functions
-----------------------------------------------------------------------------------*/

include(get_template_directory() . '/functions/shortcodes.php');
include(get_template_directory() . '/functions/paging.php');
include(get_template_directory() . '/functions/comments-template.php');

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	function my_enqueue_scripts()
	{
		
		// Register our stylesheets
		wp_register_style( 'opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' );
		wp_register_style( 'bootstrapresponsive', get_template_directory_uri() . '/assets/css/bootstrap-responsive.css' );
		wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
		wp_register_style( 'main', get_template_directory_uri() . '/assets/css/main.css' );
		wp_register_style( 'nivoslider', get_template_directory_uri() . '/assets/nivo/nivo-slider.css' );
		wp_register_style( 'prettyphoto', get_template_directory_uri() . '/assets/css/prettyPhoto.css' );
		wp_register_style( 'googleprettify', get_template_directory_uri() . '/assets/js/google-code-prettify/prettify.css' );
		
		// Register our scripts
		wp_deregister_script( 'jquery' );
		
		wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-1.7.1.min.js', 'jquery' );
		wp_register_script( 'twitter', get_template_directory_uri() . '/widgets/js/jquery.tweet.js', 'jquery' );
		
		wp_register_script( 'prettify', get_template_directory_uri() . '/assets/js/google-code-prettify/prettify.js', 'jquery' );
		wp_register_script( 'bootstrapmin', get_template_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery' );
		wp_register_script( 'mainapp', get_template_directory_uri() . '/assets/js/application.js', 'jquery' );
		wp_register_script( 'easing', get_template_directory_uri() . '/assets/js/jquery.easing.1.3.js', 'jquery' );
		wp_register_script( 'superfish', get_template_directory_uri() . '/assets/js/superfish-menu/superfish.js', 'jquery' );
		wp_register_script( 'nivoslider', get_template_directory_uri() . '/assets/js/jquery.nivo.slider.pack.js', 'jquery' );
		wp_register_script( 'prettyphoto', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.js', 'jquery' );
		wp_register_script( 'blogslides', get_template_directory_uri() . '/assets/js/slides.min.jquery.js', 'jquery' );
		wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', 'jquery' );
		wp_register_script( 'testimonalrotator', get_template_directory_uri() . '/assets/js/testimonialrotator.js', 'jquery' );
		wp_register_script( 'waitforimages', get_template_directory_uri() . '/assets/js/jquery.waitforimages.js', 'jquery' );
		wp_register_script( 'preloaders', get_template_directory_uri() . '/assets/js/jquery.preloader.js', 'jquery' );
		
		
		
		// Enqueue our scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'twitter' );
		wp_enqueue_script( 'prettify' );
		wp_enqueue_script( 'bootstrapmin' );
		wp_enqueue_script( 'mainapp' );
		wp_enqueue_script( 'easing' );
		wp_enqueue_script( 'superfish' );
		wp_enqueue_script( 'nivoslider' );
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_script( 'blogslides' );
		wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'testimonalrotator' );
		wp_enqueue_script( 'waitforimages' );
		wp_enqueue_script( 'preloaders' );
		
		// Enqueue our styles
		wp_enqueue_style( 'opensans' );
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'bootstrapresponsive' );
		wp_enqueue_style( 'main' );
		wp_enqueue_style( 'googleprettify' );
		wp_enqueue_style( 'nivoslider' );
		wp_enqueue_style( 'prettyphoto' );
	}
	
	add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );
/*  Post types
-----------------------------------------------------------------------------------*/
function create_post_type_portfolio()
	{
		$labels = array('name' => __( 'Portfolio Items', 'themeText' ),
						'singular_name' => __( 'Portfolio Item', 'themeText' ),
						'add_new' => __( 'Add New Item', 'themeText' ),
						'add_new_item' => __( 'Add New Portfolio Item', 'themeText' ),
						'edit_item' => __( 'Edit Portfolio Item', 'themeText' ),
						'new_item' => __( 'New Portfolio Item', 'themeText' ),
						'view_item' => __( 'View Portfolio Item', 'themeText' ),
						'search_items' => __( 'Search Portfolio Items', 'themeText' ),
						'not_found' =>  __( 'No Portfolio Items found', 'themeText' ),
						'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'themeText' ),
						'parent_item_colon' => '',
						'menu_name' => 'Portfolio');
		
		$args = array(  'labels' => $labels,
						'public' => true,
						'publicly_queryable' => true,
						'show_ui' => true,
						'query_var' => true,
						'show_in_nav_menus' => true,
						'menu_icon' => get_template_directory_uri() . '/assets/img/moremenu.png',
						'capability_type' => 'post',
						'hierarchical' => false,
						'menu_position' => 5,
						'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', ),
						'rewrite' => array( 'slug' => 'portfolio', 'with_front' => false ));
		
		register_post_type( 'portfolio' , $args );
	}
	
	add_action( 'init', 'create_post_type_portfolio' );

	function portfolio_updated_messages( $messages )
	{
		global $post, $post_ID;
		
		$messages['portfolio'] = array( 0 => '', // Unused. Messages start at index 1.
										1 => sprintf( __( 'Portfolio Item updated. <a href="%s">View Portfolio Item</a>', 'themeText' ), esc_url( get_permalink( $post_ID) ) ),
										2 => __( 'Custom field updated.', 'themeText' ),
										3 => __( 'Custom field deleted.', 'themeText' ),
										4 => __( 'Portfolio Item updated.', 'themeText' ),
										// translators: %s: date and time of the revision
										5 => isset( $_GET['revision'] ) ? sprintf( __( 'Portfolio Item restored to revision from %s', 'themeText' ), wp_post_revision_title( ( int ) $_GET['revision'], false ) ) : false,
										6 => sprintf( __( 'Portfolio Item published. <a href="%s">View Portfolio Item</a>', 'themeText' ), esc_url( get_permalink( $post_ID) ) ),
										7 => __( 'Portfolio Item saved.', 'themeText' ),
										8 => sprintf( __( 'Portfolio Item submitted. <a target="_blank" href="%s">Preview Portfolio Item</a>', 'themeText' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
										9 => sprintf( __( 'Portfolio Item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio Item</a>', 'themeText' ),
										// translators: Publish box date format, see http://php.net/date
										date_i18n( __( 'M j, Y @ G:i', 'themeText' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID) ) ),
										10 => sprintf( __( 'Portfolio Item draft updated. <a target="_blank" href="%s">Preview Portfolio Item</a>', 'themeText' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID) ) ) ) );
	
		return $messages;
	}


	
	add_filter( 'post_updated_messages', 'portfolio_updated_messages' );

	function portfolio_taxonomy()
	{
		$labels = array('name' => __( 'Departments', 'themeText' ),
						'singular_name' => __( 'Department', 'themeText' ),
						'search_items' =>  __( 'Search Departments', 'themeText' ),
						'all_items' => __( 'All Departments', 'themeText' ),
						'parent_item' => __( 'Parent Department', 'themeText' ),
						'parent_item_colon' => __( 'Parent Department:', 'themeText' ),
						'edit_item' => __( 'Edit Department', 'themeText' ),
						'update_item' => __( 'Update Department', 'themeText' ),
						'add_new_item' => __( 'Add New Department', 'themeText' ),
						'new_item_name' => __( 'New Department Name', 'themeText' ),
						'menu_name' => __( 'Departments', 'themeText' ) );

		register_taxonomy(  'department',
							array( 'portfolio' ),
							array( 'hierarchical' => true,
							'labels' => $labels,
							'show_ui' => true,
							'public' => true,
							'query_var' => true,
							'rewrite' => array( 'slug' => 'department' )));
	}
	
	add_action( 'init', 'portfolio_taxonomy' );


	function portfolio_edit_columns( $pf_columns )
	{
		$pf_columns = array('cb' => '<input type="checkbox" />',
							'title' => __( 'Portfolio Title', 'themeText' ),
							'screenshot' => __( 'Screen Shot', 'themeText' ),
							'department' => __( 'Department', 'themeText' ),
							'portfolio_type_column' => __( 'Portfolio Item Type', 'themeText' ),
							'short_description' => __( 'Short Description', 'themeText' ) );
		
		return $pf_columns;
	}
	
	add_filter( 'manage_edit-portfolio_columns', 'portfolio_edit_columns' );

	function portfolio_custom_columns( $pf_column )
	{
		global $post, $post_ID;
		
		switch ( $pf_column )
		{
			case 'screenshot':
				if ( has_post_thumbnail() )
				{
					the_post_thumbnail( 'slide_small_img' );
				}
				break;
			
			case 'department':
				$taxon = 'department';
				$terms_list = get_the_terms( $post_ID, $taxon );
				if ( !empty( $terms_list ) )
				{
					$out = array();
					foreach ( $terms_list as $term_list )
						$out[] = '<a href="edit.php?post_type=portfolio&department=' .$term_list->slug .'">' .$term_list->name .' </a>';
					echo join( ', ', $out );
				}
				break;
				
			case 'portfolio_type_column':
				$portfoio_type2_column = get_post_meta( $post->ID, 'portfoio_format_type2', true );
				$portfoio_type3_column = get_post_meta( $post->ID, 'portfoio_format_type3', true );
				if ($portfoio_type2_column)
				{
					echo 'Gallery';
				}
				elseif ($portfoio_type3_column)
				{
					echo 'Video';
				}
				else
				{
					echo 'Standart';
				}
				break;
			
			case 'short_description':
				echo get_post_meta( $post->ID, 'short_description', true );
				break;
		}
	}
	
	add_action( 'manage_posts_custom_column',  'portfolio_custom_columns' );
	
	function portfolio_details()
	{
		global $post, $post_ID;
	
		$portfoio_format_type2 = get_post_meta( $post->ID, 'portfoio_format_type2', true );
		$portfoio_format_type3 = get_post_meta( $post->ID, 'portfoio_format_type3', true );
		$short_description = get_post_meta( $post->ID, 'short_description', true );
		
		$project = get_post_meta( $post->ID, 'project', true );
		$client = get_post_meta( $post->ID, 'client', true );
		$long_description = get_post_meta( $post->ID, 'long_description', true );
		$technology = get_post_meta( $post->ID, 'technology', true );
		$launch_project_url = get_post_meta( $post->ID, 'launch_project_url', true );
		$project_url_new_window = get_post_meta( $post->ID, 'project_url_new_window', true );
		
		$portfolio_video_code = get_post_meta( $post->ID, 'portfolio_video_code', true );
?>
		<div class="admin-inside-box">
			<p>
				<input type="hidden" name="portfolio_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
			</p>
			
			<p style="border-bottom: 1px solid #dfdfdf; padding-bottom: 20px; margin-bottom: 0px;">
			
				<label style="display: block; cursor: default; margin-bottom: 5px; width: 100%;"><?php echo __( 'Portfolio Item Type', 'themeText' ); ?></label>
				
				<label style="display: inline-block; margin-bottom: 3px;"><input type="radio" id="portfoio_format_type1" name="portfoio_format_type1" value="portfoio_format_standart" <?php if ( (!$portfoio_format_type2) && (!$portfoio_format_type3) ) { echo 'checked="checked"'; } ?> /> <?php echo __( 'Standart', 'themeText' ); ?></label>
				<br>
				<label style="display: inline-block; margin-bottom: 3px;"><input type="radio" id="portfoio_format_type2" name="portfoio_format_type2" value="portfoio_format_gallery" <?php if ($portfoio_format_type2) { echo 'checked="checked"'; } ?> /> <?php echo __( 'Gallery', 'themeText' ); ?></label>
				<br>
				<label style="display: inline-block;"><input type="radio" id="portfoio_format_type3" name="portfoio_format_type3" value="portfoio_format_video" <?php if ($portfoio_format_type3) { echo 'checked="checked"'; } ?> /> <?php echo __( 'Video', 'themeText' ); ?></label>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
				<script>
					$(function()
					{
						$("#portfolio_type_box").hide();
					
						$('#portfoio_format_type1').click(function()
						{
							$("#portfoio_format_type2").removeAttr("checked");
							$("#portfoio_format_type3").removeAttr("checked");
							$("#portfoio_format_type1").attr("checked", "checked");
							$("#portfolio_type_box").hide();
						});
						
						$('#portfoio_format_type2').click(function()
						{
							$("#portfoio_format_type1").removeAttr("checked");
							$("#portfoio_format_type3").removeAttr("checked");
							$("#portfoio_format_type2").attr("checked", "checked");
							$("#portfolio_type_box").show();
							$(".portfolio-type-gallery").show();
							$(".portfolio-type-video").hide();
						});
						
						$('#portfoio_format_type3').click(function()
						{
							$("#portfoio_format_type1").removeAttr("checked");
							$("#portfoio_format_type2").removeAttr("checked");
							$("#portfoio_format_type3").attr("checked", "checked");
							$("#portfolio_type_box").show();
							$(".portfolio-type-video").show();
							$(".portfolio-type-gallery").hide();
						});
						
						if ( $("#portfoio_format_type2").attr("checked") == "checked" )
						{
							$("#portfolio_type_box").show();
							$(".portfolio-type-gallery").show();
							$(".portfolio-type-video").hide();
						}
						
						if ( $("#portfoio_format_type3").attr("checked") == "checked" )
						{
							$("#portfolio_type_box").show();
							$(".portfolio-type-video").show();
							$(".portfolio-type-gallery").hide();
						}

					});
				</script>
		
			</p>
			
			<p style="border-top: 1px solid #ffffff; border-bottom: 1px solid #dfdfdf; padding-top: 20px; padding-bottom: 20px; margin-top: 0px; margin-bottom: 0px;">
				<label for="short_description"><?php echo __( 'Short Description (optional)', 'themeText' ); ?></label>
				<input type="text" id="short_description" name="short_description" style="width: 100%;" value="<?php echo $short_description; ?>" />
			</p>
			
			<p style="border-top: 1px solid #ffffff; padding-top: 20px; margin-top: 0px;">
				<label for="project"><?php echo __( 'Project', 'themeText' ); ?></label>
				<input type="text" id="project" name="project" style="width: 100%;" value="<?php echo $project; ?>" />
			</p>
			
			<p>
				<label for="client"><?php echo __( 'Client', 'themeText' ); ?></label>
				<input type="text" id="client" name="client" style="width: 100%;" value="<?php echo $client; ?>" />
			</p>
			
			<p>
				<label for="long_description"><?php echo __( 'Description', 'themeText' ); ?></label>
				<input type="text" id="long_description" name="long_description" style="width: 100%;" value="<?php echo $long_description; ?>" />
			</p>
			
			<p>
				<label for="technology"><?php echo __( 'Technology', 'themeText' ); ?></label>
				<input type="text" id="technology" name="technology" style="width: 100%;" value="<?php echo $technology; ?>" />
			</p>
			
			<p>
				<label for="launch_project_url"><?php echo __( 'Launch Project URL', 'themeText' ); ?></label>
				<input type="text" id="launch_project_url" name="launch_project_url" style="width: 100%;" value="<?php echo $launch_project_url; ?>" />
				<label style="display: inline-block; font-size: 11px; color: #666666; margin-top: 5px;"><input type="checkbox" <?php if ($project_url_new_window) echo 'checked="checked"' ?> id="project_url_new_window" name="project_url_new_window" value="new_window" /> <?php echo __( 'Open link in new window', 'themeText' ); ?></label>
			</p>
		</div>
<?php
	}

	function add_portfolio_metabox()
	{
		add_meta_box( 'portfolio_meta_box', __( 'Portfolio Item Details', 'themeText' ), 'portfolio_details', 'portfolio', 'side', 'default' );
	}
	
	add_action( 'admin_init', 'add_portfolio_metabox' );
	
	function portfolio_type()
	{
		global $post, $post_ID;
		
		$upload_one = get_post_meta( $post->ID, 'upload_one', true );
		$upload_two = get_post_meta( $post->ID, 'upload_two', true );
		$upload_three = get_post_meta( $post->ID, 'upload_three', true );
		$upload_four = get_post_meta( $post->ID, 'upload_four', true );
		$upload_five = get_post_meta( $post->ID, 'upload_five', true );
		$upload_six = get_post_meta( $post->ID, 'upload_six', true );
		$upload_seven = get_post_meta( $post->ID, 'upload_seven', true );
		$upload_eight = get_post_meta( $post->ID, 'upload_eight', true );
		$upload_nine = get_post_meta( $post->ID, 'upload_nine', true );
		$upload_ten = get_post_meta( $post->ID, 'upload_ten', true );
		
		$portfolio_video_code = get_post_meta( $post->ID, 'portfolio_video_code', true );
		
	?>
		
		<div class="portfolio-type-gallery">
			<h2><?php echo __( 'Gallery', 'themeText' ); ?></h2>
			
			<script>
				$(function()
				{
					var uploadID = ''; /* setup the var */

					jQuery('.upload-button').click(function() {
						uploadID = jQuery(this).prev('input'); /* grab the specific input */
						formfield = jQuery('.upload').attr('name');
						tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
						return false;
					});

					window.send_to_editor = function(html) {
						imgurl = jQuery('img',html).attr('src');
						uploadID.val(imgurl); /* assign the value to the input */
						tb_remove();
					}
				});
			</script>

			<p class="upload_field">
				<label for="upload_one"><?php echo __( 'Image 1', 'themeText' ); ?></label>
				<input type="text" id="upload_one" name="upload_one" class="upload" style="width: 75%;" value="<?php  echo $upload_one; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>

			<p class="upload_field">
				<label for="upload_two"><?php echo __( 'Image 2', 'themeText' ); ?></label>
				<input type="text" id="upload_two" name="upload_two" class="upload" style="width: 75%;" value="<?php  echo $upload_two; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>

			<p class="upload_field">
				<label for="upload_three"><?php echo __( 'Image 3', 'themeText' ); ?></label>
				<input type="text" id="upload_three" name="upload_three" class="upload" style="width: 75%;" value="<?php  echo $upload_three; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>
			
			<p class="upload_field">
				<label for="upload_four"><?php echo __( 'Image 4', 'themeText' ); ?></label>
				<input type="text" id="upload_four" name="upload_four" class="upload" style="width: 75%;" value="<?php  echo $upload_four; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>

			<p class="upload_field">
				<label for="upload_five"><?php echo __( 'Image 5', 'themeText' ); ?></label>
				<input type="text" id="upload_five" name="upload_five" class="upload" style="width: 75%;" value="<?php  echo $upload_five; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>
			
			<p class="upload_field">
				<label for="upload_six"><?php echo __( 'Image 6', 'themeText' ); ?></label>
				<input type="text" id="upload_six" name="upload_six" class="upload" style="width: 75%;" value="<?php  echo $upload_six; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>
			
			<p class="upload_field">
				<label for="upload_seven"><?php echo __( 'Image 7', 'themeText' ); ?></label>
				<input type="text" id="upload_seven" name="upload_seven" class="upload" style="width: 75%;" value="<?php  echo $upload_seven; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>
			
			<p class="upload_field">
				<label for="upload_eight"><?php echo __( 'Image 8', 'themeText' ); ?></label>
				<input type="text" id="upload_eight" name="upload_eight" class="upload" style="width: 75%;" value="<?php  echo $upload_eight; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>
			
			<p class="upload_field">
				<label for="upload_nine"><?php echo __( 'Image 9', 'themeText' ); ?></label>
				<input type="text" id="upload_nine" name="upload_nine" class="upload" style="width: 75%;" value="<?php  echo $upload_nine; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>
			
			<p class="upload_field">
				<label for="upload_ten"><?php echo __( 'Image 10', 'themeText' ); ?></label>
				<input type="text" id="upload_ten" name="upload_ten" class="upload" style="width: 75%;" value="<?php  echo $upload_ten; ?>" />
				<input type="button" class="upload-button button" value="Upload Image" />
			</p>
		</div>
		
		<div class="portfolio-type-video">
			<h2><?php echo __( 'Video', 'themeText' ); ?></h2>
			<label for="portfolio_video_code"><?php echo __( 'Video Embed Code', 'themeText' ); ?></label>
			<textarea id="portfolio_video_code" name="portfolio_video_code" style="outline: none; width: 100%;" rows="4" cols="50"><?php  echo $portfolio_video_code; ?></textarea>
		</div>
	<?php
	}
	
	function add_metabox_portfolio_type()
	{		
		add_meta_box( 'portfolio_type_box', __( 'Portfolio Item Type', 'themeText' ), 'portfolio_type', 'portfolio', 'advanced', 'high' );
	}
	
	add_action( 'admin_init', 'add_metabox_portfolio_type' );

	function save_portfolio_details( $post_id )
	{
		global $post, $post_ID;
	
		if ( !wp_verify_nonce( @$_POST['portfolio_nonce'], basename(__FILE__) ) )
		{
			return $post_id;
		}

		if ( $_POST['post_type'] == 'portfolio' )
		{
			if ( !current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		}
		else
		{
			if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		}
	
		if ( $_POST['post_type'] == 'portfolio' )
		{
			update_post_meta( $post->ID, 'portfoio_format_type2', $_POST['portfoio_format_type2'] );
			update_post_meta( $post->ID, 'portfoio_format_type3', $_POST['portfoio_format_type3'] );
			update_post_meta( $post->ID, 'short_description', $_POST['short_description'] );
			update_post_meta( $post->ID, 'project', $_POST['project'] );
			update_post_meta( $post->ID, 'client', $_POST['client'] );
			update_post_meta( $post->ID, 'long_description', $_POST['long_description'] );
			update_post_meta( $post->ID, 'technology', $_POST['technology'] );
			update_post_meta( $post->ID, 'launch_project_url', $_POST['launch_project_url'] );
			update_post_meta( $post->ID, 'project_url_new_window', $_POST['project_url_new_window'] );
			
			update_post_meta( $post->ID, 'upload_one', $_POST['upload_one'] );
			update_post_meta( $post->ID, 'upload_two', $_POST['upload_two'] );
			update_post_meta( $post->ID, 'upload_three', $_POST['upload_three'] );
			update_post_meta( $post->ID, 'upload_four', $_POST['upload_four'] );
			update_post_meta( $post->ID, 'upload_five', $_POST['upload_five'] );
			update_post_meta( $post->ID, 'upload_six', $_POST['upload_six'] );
			update_post_meta( $post->ID, 'upload_seven', $_POST['upload_seven'] );
			update_post_meta( $post->ID, 'upload_eight', $_POST['upload_eight'] );
			update_post_meta( $post->ID, 'upload_nine', $_POST['upload_nine'] );
			update_post_meta( $post->ID, 'upload_ten', $_POST['upload_ten'] );
			
			update_post_meta( $post->ID, 'portfolio_video_code', $_POST['portfolio_video_code'] );
		}
	}
	
	add_action( 'save_post', 'save_portfolio_details' );

	function only_show_departments()
	{
		global $typenow;
		
		if ( $typenow == 'portfolio' )
		{
			$filters = array( 'department' );
			
			foreach ( $filters as $tax_slug )
			{
				$tax_obj = get_taxonomy( $tax_slug );
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms( $tax_slug );
			
				echo '<select name="' .$tax_slug .'" id="' .$tax_slug .'" class="postform">';
				echo '<option value="">Show All ' .$tax_name .'</option>';
				
				foreach ( $terms as $term )
				{
					echo '<option value='. $term->slug, @$_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo '</select>';
			}
		}
	}

	add_action( 'restrict_manage_posts', 'only_show_departments' );

	function get_nav_menu_id($template)
	{
		static $nav_menu_id;
		
		if ( !isset( $nav_menu_id ) )
		{
			global $wpdb;
			
			$sql = <<<SQL
			SELECT menu.post_id AS menu_id FROM {$wpdb->postmeta}
			AS template INNER JOIN {$wpdb->postmeta}
			AS menu_id ON menu_id.meta_key='_menu_item_object_id'
                        AND menu_id.meta_value=template.post_id
			INNER JOIN {$wpdb->postmeta} AS menu ON menu_id.post_id=menu.post_id
			WHERE 1=1
			AND menu.meta_key='_menu_item_object' AND menu.meta_value='page'
			AND template.meta_key='_wp_page_template' AND template.meta_value='%s'
SQL;
			$nav_menu_id = $wpdb->get_var( $wpdb->prepare( $sql, $template ) );
		}
		
		return $nav_menu_id;
	}

	function remove_class($var)
	{
		if ( $var == 'current_page_parent' )
		{
			return false;
		}
		
		return true;
	}

	function add_class_to_menu($current)
	{
		global $wp_query, $post;
		
		$post_type = get_query_var( 'post_type' );
		$term_type = get_query_var( 'taxonomy' );
		
		if ( $post_type == 'portfolio' || $term_type == 'department' || is_404() )
		{
			$current = array_filter( $current, 'remove_class' );

			if ( !is_404() )
			{
				// get nav_menu_id from products page that using page template (products_page.php)
				$menu_id = 'menu-item-' . get_nav_menu_id( 'portfolio.php' );
				
				if ( in_array( $menu_id, $current) )
				{
					$current[] = 'current_page_parent';
				}
			}
		}
		
		return $current;
	}
	
	// check if we are not in backend
	if ( !is_admin() )
	{
		add_filter( 'nav_menu_css_class', 'add_class_to_menu' );
	}
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	function create_post_type_slides()
	{	
		$labels = array('name' => __( 'Slides', 'themeText' ),
						'singular_name' => __( 'Slide', 'themeText' ),
						'add_new' => __( 'Add New Slide', 'themeText' ),
						'add_new_item' => __( 'Add New Slide', 'themeText' ),
						'edit_item' => __( 'Edit Slide', 'themeText' ),
						'new_item' => __( 'New Slide', 'themeText' ),
						'view_item' => __( 'View Slide', 'themeText' ),
						'search_items' => __( 'Search Slide', 'themeText' ),
						'not_found' =>  __( 'No Slides found', 'themeText' ),
						'not_found_in_trash' => __( 'No Slides found in Trash', 'themeText' ),
						'parent_item_colon' => '',
						'menu_name' => 'Slides');
		
		$args = array(  'labels' => $labels,
						'public' => true,
						'publicly_queryable' => true,
						'show_ui' => true,
						'query_var' => true,
						'show_in_nav_menus' => false,
						'menu_icon' => get_template_directory_uri() . '/assets/img/moremenu.png',
						'capability_type' => 'post',
						'hierarchical' => false,
						'menu_position' => 5,
						'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'revisions', 'page-attributes' ),
						'rewrite' => array( 'slug' => 'slides', 'with_front' => false ));
					
		register_post_type( 'slides' , $args );
	}
	
	add_action( 'init', 'create_post_type_slides' );

	function slide_updated_messages( $messages )
	{
		global $post, $post_ID;
		
		$messages['slides'] = array(0 => '', // Unused. Messages start at index 1.
									1 => sprintf( __( 'Slide updated. <a href="%s">View Slide</a>', 'themeText' ), esc_url( get_permalink( $post_ID) ) ),
									2 => __( 'Custom field updated.', 'themeText' ),
									3 => __( 'Custom field deleted.', 'themeText' ),
									4 => 'Slide updated.',
									// translators: %s: date and time of the revision
									5 => isset( $_GET['revision'] ) ? sprintf( __( 'Slide restored to revision from %s', 'themeText' ), wp_post_revision_title( ( int ) $_GET['revision'], false ) ) : false,
									6 => sprintf( __( 'Slide published. <a href="%s">View Slide</a>', 'themeText' ), esc_url( get_permalink( $post_ID) ) ),
									7 => __( 'Slide saved.', 'themeText' ),
									8 => sprintf( __( 'Slide submitted. <a target="_blank" href="%s">Preview Slide</a>', 'themeText' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
									9 => sprintf( __( 'Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Slide</a>', 'themeText' ),
									// translators: Publish box date format, see http://php.net/date
									date_i18n( __( 'M j, Y @ G:i', 'themeText' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID) ) ),
									10 => sprintf( 'Slide draft updated. <a target="_blank" href="%s">Preview Slide</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID) ) ) ) );
			
		return $messages;
	}
	
	add_filter( 'post_updated_messages', 'slide_updated_messages' );

	function slides_edit_columns( $sd_columns )
	{
		$sd_columns = array('cb' => '<input type="checkbox" />',
							'title' => __( 'Slide Title', 'themeText' ),
							'slideimage' => __( 'Slide Image', 'themeText' ),
							'slidecaption' => __( 'Slide Caption', 'themeText' ),
							'author' => __( 'Author', 'themeText' ),
							'date' => __( 'Date', 'themeText' ) );
		
		return $sd_columns;
	}
	
	add_filter( 'manage_edit-slides_columns', 'slides_edit_columns' );

	function slides_columns( $sd_column )
	{
		global $post, $post_ID;
		
		switch ( $sd_column )
		{
			case 'slideimage':
				if ( has_post_thumbnail() )
				{
					the_post_thumbnail( 'slide_small_img' );
				}
				break;
				
			case 'slidecaption':
				echo get_post_meta( $post->ID, 'image_caption', true );
				break;
		}
	}
	
	add_action( 'manage_posts_custom_column',  'slides_columns' );
	
	function slide_details()
	{
		global $post, $post_ID;
	
		$image_link = get_post_meta( $post->ID, 'image_link', true );
		$image_new_window = get_post_meta( $post->ID, 'image_new_window', true );
		$image_caption = get_post_meta( $post->ID, 'image_caption', true );
?>
		<div class="admin-inside-box">
			<p>
				<input type="hidden" name="slide_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
			</p>
			
			<p style="border-bottom: 1px solid #dfdfdf; padding-bottom: 20px; margin-bottom: 0px;">
				<label for="image_link"><?php echo __( 'Image Target URL (optional)', 'themeText' ); ?></label>

				<input type="text" id="image_link" name="image_link" style="width: 100%;" value="<?php echo $image_link; ?>" />
				<label style="display: inline-block; font-size: 11px; color: #666666; margin-top: 5px;"><input type="checkbox" <?php if ($image_new_window) echo 'checked="checked"' ?> id="image_new_window" name="image_new_window" value="new_window" /> <?php echo __( 'Open link in new window', 'themeText' ); ?></label>
			</p>
			
			<p style="border-top: 1px solid #ffffff; padding-top: 20px; margin-top: 0px;">
				<label for="image_caption"><?php echo __( 'Image Caption (optional)', 'themeText' ); ?></label>
				<input type="text" id="image_caption" name="image_caption" style="width: 100%;" value="<?php echo $image_caption; ?>" />
				<span style="display: inline-block; font-size: 11px; color: #666666; margin-top: 5px;"><?php echo __( 'You can use', 'themeText' ); ?> <span><</span>b<span>></span><span><</span>/b<span>></span> <?php echo __( 'and', 'themeText' ); ?> <span><</span>i<span>></span><span><</span>/i<span>></span></span>
			</p>
		</div>
<?php
	}

	function add_slide_metabox()
	{
		add_meta_box( 'slide_meta_box', __( 'Slide Image Attributes', 'themeText' ), 'slide_details', 'slides', 'side', 'low' );
	}
	
	add_action( 'admin_init', 'add_slide_metabox' );

	function save_slide_details( $post_id )
	{
		global $post, $post_ID;
	
		if ( !wp_verify_nonce( @$_POST['slide_nonce'], basename(__FILE__) ) )
		{
			return $post_id;
		}

		if ( $_POST['post_type'] == 'slides' )
		{
			if ( !current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		}
		else
		{
			if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		}
	
		if( $_POST['post_type'] == 'slides' )
		{
			update_post_meta( $post->ID, 'image_link', $_POST['image_link'] );
			update_post_meta( $post->ID, 'image_new_window', $_POST['image_new_window'] );
			update_post_meta( $post->ID, 'image_caption', $_POST['image_caption'] );
		}
	}
	
	add_action( 'save_post', 'save_slide_details' );
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
function page_subtitle()
	{
		global $post, $post_ID;
		
		$page_subtitle = get_post_meta( $post->ID, 'page_subtitle', true );
	?>
		<div class="admin-inside-box">
			<input type="hidden" name="page_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
			<p><label><?php echo __( 'Enter subtitle:', 'themeText' ); ?><input type="text" name="page_subtitle" style="width: 100%;" value="<?php echo $page_subtitle; ?>" /></label></p>
		</div>
	<?php
	}
	
	function add_page_metabox()
	{
		add_meta_box( 'page_meta_box', __( 'Page Subtitle', 'themeText' ), 'page_subtitle', 'page', 'side', 'high' );
	}
	
	add_action( 'admin_init', 'add_page_metabox' );
	
	function save_page_subtitle( $post_id )
	{
		global $post, $post_ID;
		
		if ( !wp_verify_nonce( @$_POST['page_nonce'], basename(__FILE__) ) )
		{
			return $post_id;
		}
		
		if ( $_POST['post_type'] == 'page' )
		{
			if ( !current_user_can( 'edit_page', $post_id ) )
			
				return $post_id;
		}
		else
		{
			if ( !current_user_can( 'edit_post', $post_id ) )
			
			return $post_id;
		}
		
		if( $_POST['post_type'] == 'page' )
		{
			update_post_meta( $post->ID, 'page_subtitle', $_POST['page_subtitle'] );
		}
	}
	
	add_action( 'save_post', 'save_page_subtitle' );

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */


/*  Widgets
-----------------------------------------------------------------------------------*/
include(get_template_directory() . '/widgets/widgets.php');


/*-----------------------------------------------------------------------------------
	Misc Stuff
-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*  Add Featured image
-----------------------------------------------------------------------------------*/
add_theme_support( 'post-thumbnails', array( 'post', 'slides', 'portfolio' ) );
add_image_size( 'home_latest_post_img', 740, 9999, true );
add_image_size( 'home_latest_portfolio_img', 460, 460, true );
add_image_size( 'home_slider_img', 570, 9999, true );
add_image_size( 'slide_small_img', 150, 100, true );
add_image_size( 'blog-single', 770, 600, true );
add_image_size( 'blog-list', 770, 300, true );
add_image_size( 'featured_post', 70, 52, true );


if ( ! isset( $content_width ) ) $content_width = 1170;

/*  Wordpress menu feature 
-----------------------------------------------------------------------------------*/
register_nav_menus( array(
	'main' => __( 'Main Menu' ),
));




/*  Add link to file of featured image (the closing </a> tag is in the template file)
-----------------------------------------------------------------------------------*/
function full_size_link(){
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id, 'fullsize', true);
	echo '<a href="'.$image_url[0].'" class="fullsize">';
}



/*  Custom excerpt
-----------------------------------------------------------------------------------*/
function wpe_excerptlength_teaser($length) {
    return 35;
    }
function wpe_excerptlength_home($length) {
    return 25;
    }
    function wpe_excerptlength_index($length) {
    return 130;
    }
    function wpe_excerptmore($more) {
    return '...';
    }
	
	function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
    add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
    add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
    }

// Start of Presstrends Magic
function presstrends() {

// PressTrends Account API Key
$api_key = 'ugf7vue65zxus308fxxom2syfkf6178yi7sa';

// Start of Metrics
global $wpdb;
$data = get_transient( 'presstrends_data' );
if (!$data || $data == ''){
$api_base = 'http://api.presstrends.io/index.php/api/sites/update/api/';
$url = $api_base . $api_key . '/';
$data = array();
$count_posts = wp_count_posts();
$count_pages = wp_count_posts('page');
$comments_count = wp_count_comments();
$theme_data = wp_get_theme();
$plugin_count = count(get_option('active_plugins'));
$all_plugins = get_plugins();
foreach($all_plugins as $plugin_file => $plugin_data) {
$plugin_name .= $plugin_data['Name'];
$plugin_name .= '&';}
$posts_with_comments = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}posts WHERE post_type='post' AND comment_count > 0");
$comments_to_posts = number_format(($posts_with_comments / $count_posts->publish) * 100, 0, '.', '');
$pingback_result = $wpdb->get_var('SELECT COUNT(comment_ID) FROM '.$wpdb->comments.' WHERE comment_type = "pingback"');
$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
$data['posts'] = $count_posts->publish;
$data['pages'] = $count_pages->publish;
$data['comments'] = $comments_count->total_comments;
$data['approved'] = $comments_count->approved;
$data['spam'] = $comments_count->spam;
$data['pingbacks'] = $pingback_result;
$data['post_conversion'] = $comments_to_posts;
$data['theme_version'] = $theme_data->Version;
$data['theme_name'] = urlencode($theme_data->Name);
$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
$data['plugins'] = $plugin_count;
$data['api_version'] = '2.3';
$data['plugin'] = urlencode($plugin_name);
$data['wpversion'] = get_bloginfo('version');
foreach ( $data as $k => $v ) {
$url .= $k . '/' . $v . '/';}
$response = wp_remote_get( $url );
set_transient('presstrends_data', $data, 60*60*24);}
}

// PressTrends WordPress Action
add_action('admin_init', 'presstrends');
		

/*	Enable blog navigation
/*-----------------------------------------------------------------------------------*/
function show_posts_nav() {
   global $wp_query;
   return ($wp_query->max_num_pages > 1);
}



/*	Theme localization
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain( 'themeText', get_template_directory().'/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);
	
if ( function_exists('register_sidebar') )
	{
		register_sidebar(array( 'name' => __( 'Blog Search Sidebar', 'themeText' ),
								'id' => 'blog_search_sidebar',
								'before_widget' => '',
								'after_widget' => '',
								'before_title' => '<span style="display: none;">',
								'after_title' => '</span>'));
								
		register_sidebar(array( 'name' => __( 'Blog Sidebar 1', 'themeText' ),
								'id' => 'blog_sidebar_1',
								'before_widget' => '<div class="well">',
								'after_widget' => '</div>',
								'before_title' => '<h4 class="sep_bg">',
								'after_title' => '</h4>'));
								
		register_sidebar(array( 'name' => __( 'Blog Sidebar 2', 'themeText' ),
								'id' => 'blog_sidebar_2',
								'before_widget' => '<div class="well">',
								'after_widget' => '</div>',
								'before_title' => '<h4 class="sep_bg">',
								'after_title' => '</h4>'));
								
		register_sidebar(array( 'name' => __( 'Blog Sidebar 3', 'themeText' ),
								'id' => 'blog_sidebar_3',
								'before_widget' => '<div class="well">',
								'after_widget' => '</div>',
								'before_title' => '<h4 class="sep_bg">',
								'after_title' => '</h4>'));
								
		register_sidebar(array( 'name' => __( 'Blog Sidebar 4', 'themeText' ),
								'id' => 'blog_sidebar_4',
								'before_widget' => '<div class="well">',
								'after_widget' => '</div>',
								'before_title' => '<h4 class="sep_bg">',
								'after_title' => '</h4>'));
								
		register_sidebar(array( 'name' => __( 'Blog Sidebar 5', 'themeText' ),
								'id' => 'blog_sidebar_5',
								'before_widget' => '<div class="well">',
								'after_widget' => '</div>',
								'before_title' => '<h4 class="sep_bg">',
								'after_title' => '</h4>'));

								
		register_sidebar(array( 'name' => __( 'Footer Sidebar 1', 'themeText' ),
								'id' => 'footer_sidebar_1',
								'before_widget' => '',
								'after_widget' => '',
								'before_title' => '<h6>',
								'after_title' => '</h6><hr>'));
								
		register_sidebar(array( 'name' => __( 'Footer Sidebar 2', 'themeText' ),
								'id' => 'footer_sidebar_2',

								'before_widget' => '',
								'after_widget' => '',
								'before_title' => '<h6>',
								'after_title' => '</h6><hr>'));
								
		register_sidebar(array( 'name' => __( 'Footer Sidebar 3', 'themeText' ),
								'id' => 'footer_sidebar_3',
								'before_widget' => '',
								'after_widget' => '',
								'before_title' => '<h6>',
								'after_title' => '</h6><hr>'));
								
		register_sidebar(array( 'name' => __( 'Footer Sidebar 4', 'themeText' ),
								'id' => 'footer_sidebar_4',
								'before_widget' => '',
								'after_widget' => '',
								'before_title' => '<h6>',
								'after_title' => '</h6><hr>'));
								
	/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	function post_image_size_info() { echo '<div class="admin-inside-box"><p>Recommended image size 770px width.</p></div>'; }
	function slide_image_size_info() { echo '<div class="admin-inside-box"><p>Recommended image size 1000px height.</p></div>'; }
	function portfolio_image_size_info() { echo '<div class="admin-inside-box"><p>Recommended image size 870px width.</p></div>'; }
	
	function add_image_size_info()
	{
		add_meta_box( 'post_image_size_info', __( 'Featured Image Size', 'themeText' ), 'post_image_size_info', 'post', 'side', 'low' );
		add_meta_box( 'slide_image_size_info', __( 'Featured Image Size', 'themeText' ), 'slide_image_size_info', 'slides', 'side', 'low' );
		add_meta_box( 'portfolio_image_size_info', __( 'Featured Image Size', 'themeText' ), 'portfolio_image_size_info', 'portfolio', 'side', 'low' );
	}
	
	add_action( 'admin_init', 'add_image_size_info' );
								
								
	}

?>