<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
	echo ' | ' . sprintf( __( 'Page %s', 'themetext' ), max( $paged, $page ) );?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
       <!-- IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--[if lte IE 8]>
    	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/ie.css" />
		<![endif]-->
        
        <!-- Favicon and Apple Touch Icons -->
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/ico/favicon.png">
        <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/assets/ico/apple-touch-icon-57-precomposed.png">
         
        <?php include(get_template_directory() . '/inc/custom-style.php'); // Include Google fonts ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); } ?>
<?php wp_head(); ?>
        
    </head>

	<body <?php body_class(); ?>>
    <!--TOP-->
    <div id="TopContentInset">
  	<div class="top_line">
    	<div class="container">
        	<div class="row">
            	<div class="span6">
					<p class="feed"><?php echo get_option('of_social_title');?></p>
    			</div>
                <div class="span6 soc_icons">
						<?php
							if ( get_option('of_social_rss') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_rss') . '"><div class="icon_rss"></div></a>'; }
							if ( get_option('of_social_dribbble') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_dribbble') . '"><div class="icon_dribbble"></div></a>'; }
							if ( get_option('of_social_forrst') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_forrst') . '"><div class="icon_forrst"></div></a>'; }
							if ( get_option('of_social_lastfm') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_lastfm') . '"><div class="icon_lastfm"></div></a>'; }
							if ( get_option('of_social_vimeo') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_vimeo') . '"><div class="icon_vimeo"></div></a>'; }
							if ( get_option('of_social_youtube') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_youtube') . '"><div class="icon_youtube"></div></a>'; }
							if ( get_option('of_social_pinterest') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_pinterest') . '"><div class="icon_pinterest"></div></a>'; }
							if ( get_option('of_social_linkedin') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_linkedin') . '"><div class="icon_linkedin"></div></a>'; }
							if ( get_option('of_social_skype') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_skype') . '"><div class="icon_skype"></div></a>'; }
							if ( get_option('of_social_flickr') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_flickr') . '"><div class="icon_flickr"></div></a>'; }
							if ( get_option('of_social_picasa') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_picasa') . '"><div class="icon_picasa"></div></a>'; }
							if ( get_option('of_social_google') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_google') . '"><div class="icon_google"></div></a>'; }
							if ( get_option('of_social_twitter') != "" ) { echo '<a target="_blank" href="' . get_option('of_social_twitter') . '"><div class="icon_t"></div></a>'; }
							if ( get_option('of_social_facebook') != "" ) { echo '<a target="_blank"  href="' . get_option('of_social_facebook') . '"><div class="icon_facebook"></div></a>'; }
						?>
                </div>
    		</div>
    	</div>
    </div></div>
    <div id="TopTrigger">+</div>
    <!--/TOP-->
    <div class="page_head">
    	<div class="container">
        	<div class="row">
            	<div class="span4">
                	<div class="logo">
                    	<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('of_logo'); ?>" alt="<?php bloginfo('name');?> - <?php echo get_option('of_hp_title'); ?>" title="<?php bloginfo('name');?> - <?php echo get_option('of_hp_title'); ?>" /></a>
                    </div>
                </div>
                <div class="span8">
                	<nav>
<?php wp_nav_menu( array( 'menu' => 'main', 'menu_id' => 'menu', 'menu_class' => '', 'container' => false, 'depth' => 0 ) ); ?>
                    </nav>
                </div>
    		</div>
    	</div>
    </div>
 