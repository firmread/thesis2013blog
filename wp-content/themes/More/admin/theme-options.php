<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$shortname = "of";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}


//Fonts
$font_for_titles = array("Open Sans", "Droid Sans",  "Ubuntu Condensed", "Istok Web", "Kameron", "Muli", "Shanti", "Terminal Dosis", "Raleway", "Molengo", "Podkova", "Nunito", "Varela"); 


//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');

//Images for radio inputs
$url =  OF_DIRECTORY . '/admin/images/';




/* GENERAl OPTIONS
-----------------------------------------------------------------------------------*/
$options[] = array( "name" => "General Settings",
                    "type" => "heading");
					

	$options[] = array( "name" => "Custom Logo",
						"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
						"id" => $shortname."_logo",
						"std" => "",
						"type" => "upload");
	
						
	$options[] = array( "name" => "Custom Favicon",
						"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
						"id" => $shortname."_custom_favicon",
						"std" => "",
						"type" => "upload"); 
	

	$options[] = array( "name" => "Tracking code",
						"desc" => "Paste here your Google Analytics tracking code. It will appear in the head of your site.",
						"id" => $shortname."_tracking_code",
						"std" => "",
						"type" => "textarea");	




/* STYLING OPTIONS
-----------------------------------------------------------------------------------*/
$options[] = array( "name" => "Styling Options",
                    "type" => "heading");
					
	
	$options[] = array( "name" => "Theme Stylesheet",
						"desc" => "Select themes color scheme.",
						"id" => $shortname."_alt_stylesheet",
						"std" => "red.css",
						"type" => "select",
						"options" => $alt_stylesheets);
	
			
	$options[] = array( "name" => "Titles font",
						"desc" => "Select font for all h1,h2,h3,h4,h5,h6 titles of your site.",
						"id" => $shortname."_title_font",
						"std" => "Forum",
						"type" => "select",
						"options" => $font_for_titles);


	$options[] = array( "name" => "Custom titles font",
						"desc" => "Copy and paste here any font name from Google fonts library",
						"id" => $shortname."_custom_title_font",
						"std" => "",
						"type" => "text");





/* HOMEPAGE OPTIONS
-----------------------------------------------------------------------------------*/
$options[] = array( "name" => "Homepage",
                    "type" => "heading");


	$options[] = array( "name" => "Header title",
					"desc" => "Turn on/off header title",
					"id" => $shortname."_hp_titles",
					"std" => "is_on",
					"type" => "images",
					"options" => array(
						'is_on' =>  $url . 'on.png',
						'is_off' => $url . 'off.png')
					);
					
	$options[] = array( "name" => "Main header Small Description",
					"desc" => "ONLY WORKS MAIN -Homepage- Page Template.",
					"id" => $shortname."_hp_main_small_title",
					"std" => "",
					"type" => "text");

	$options[] = array( "name" => "Main header Colored Text",
					"desc" => "Text for the header title with colored. Short and catchy.",
					"id" => $shortname."_hp_main_title",
					"std" => "",
					"type" => "text");
					
	$options[] = array( "name" => "Main header Black Color Text",
					"desc" => "Text for the header title with BLACK color. Short and catchy.",
					"id" => $shortname."_hp_main_title_description",
					"std" => "",
					"type" => "text");
					
	$options[] = array( "name" => "Main header Blockquite Style Description",
					"desc" => "ONLY WORKS MAIN -Homepage- Page Template.",
					"id" => $shortname."_hp_main_small_blockquite",
					"std" => "",
					"type" => "textarea");
	
	$options[] = array( "name" => "<br /><br />Thumbnails",
					"desc" => "Turn on/off portfolio thumbnails",
					"id" => $shortname."_hp_thumbs",
					"std" => "is_on",
					"type" => "images",
					"options" => array(
						'is_on' =>  $url . 'on.png',
						'is_off' => $url . 'off.png')
					);
	
	$options[] = array( "name" => "Featured Text",
					"desc" => "Turn on/off featured text",
					"id" => $shortname."_featured_titles",
					"std" => "is_on",
					"type" => "images",
					"options" => array(
						'is_on' =>  $url . 'on.png',
						'is_off' => $url . 'off.png')
					);
	

	$options[] = array( "name" => "Your Featured Text Title",
					"desc" => "Title for the featured area. Short and catchy.",
					"id" => $shortname."_featured_main_title",
					"std" => "",
					"type" => "text");
					
	 $options[] = array( "name" => "Your Featured Text Description",
					"desc" => "Text for the featured area. Short and catchy.",
					"id" => $shortname."_featured_main_desc",
					"std" => "",
					"type" => "textarea");
					
      $options[] = array( "name" => "Featured Text Button Text",
					"desc" => "Featured Button Text",
					"id" => $shortname."_featured_button_text",
					"std" => "",
					"type" => "text");	
	                    
      $options[] = array( "name" => "Featured Text Button URL",
					"desc" => "URL for the featured text button",
					"id" => $shortname."_featured_button_url",
					"std" => "",
					"type" => "text");
					

	 $options[] = array( "name" => "<br /><br />Editor content",
					"desc" => "Turn on/off editor content",
					"id" => $shortname."_hp_editor_content",
					"std" => "is_on",
					"type" => "images",
					"options" => array(
						'is_on' =>  $url . 'on.png',
						'is_off' => $url . 'off.png')
					);
	
	
	$options[] = array( "name" => "Editor content title",
					"desc" => "Enter the content title. Default is: About us.",
					"id" => $shortname."_hp_content_title",
					"std" => "About us",
					"type" => "text");
	
	
	$options[] = array( "name" => "Hide/show content title",
					"desc" => "Check to show content title, uncheck to hide.",
					"id" => $shortname."_content_title_off",
					"std" => "true",
					"type" => "checkbox");  
					
		$options[] = array( "name" => "Latest Portfolio title",
					"desc" => "Enter the home page portfolio content title. Default is: Latest Projects.",
					"id" => $shortname."_hp_portfolio_title",
					"std" => "Latest Projects",
					"type" => "text");
	
	
	$options[] = array( "name" => "Hide/show Latest Portfolio title",
					"desc" => "Check to show latest portfolio title, uncheck to hide.",
					"id" => $shortname."_portfolio_title_off",
					"std" => "true",
					"type" => "checkbox");  
	
	
	$options[] = array( "name" => "Blog title",
					"desc" => "Enter the blog title. Default is: From the blog.",
					"id" => $shortname."_hp_blog_title",
					"std" => "From the blog",
					"type" => "text");




/* BLOG OPTIONS
-----------------------------------------------------------------------------------*/
$options[] = array( "name" => "Blog",
                    "type" => "heading");

	
	
	$options[] = array( "name" => "Paging",
					"desc" => "Choose what type of paging you would like to be in our blog",
					"id" => $shortname."_paging",
					"std" => "classic",
					"type" => "images",
					"options" => array(
						'classic' =>  $url . 'classic.png',
						'paging' => $url . 'paging.png')
					);



/* 404 PAGE OPTIONS
-----------------------------------------------------------------------------------*/
$options[] = array( "name" => "Page 404",
                    "type" => "heading");

	$options[] = array( "name" => "Image",
					"desc" => "Upload an image for this page. Max width is 730 px",
					"id" => $shortname."_fof_image",
					"std" => "Image",
					"type" => "upload");
	
	
	$options[] = array( "name" => "Title",
					"desc" => "Type a tile for this page",
					"id" => $shortname."_fof_title",
					"std" => "Sorry, the page is not found",
					"type" => "text");
	
	
	$options[] = array( "name" => "Text",
					"desc" => "Type a text for this page",
					"id" => $shortname."_fof_text",
					"std" => "It seems we can&rsquo;t find what you're looking for. Perhaps searching, or one of the links below, can help.",
					"type" => "textarea");	
					
/* CLIENTS OPTIONS
-----------------------------------------------------------------------------------*/
$options[] = array( "name" => "Clients",
                    "type" => "heading");
					
$options[] = array( "name" => "Clients Area",
					"desc" => "Turn on/off header title",
					"id" => $shortname."_hp_clients",
					"std" => "is_on",
					"type" => "images",
					"options" => array(
						'is_on' =>  $url . 'on.png',
						'is_off' => $url . 'off.png')
					);
	

	$options[] = array( "name" => "Clients Area header title",
					"desc" => "Text for the clients area header title. Short and catchy.",
					"id" => $shortname."_hp_clients_title",
					"std" => "",
					"type" => "text");					

	$options[] = array( "name" => "Client 1 Image",
						"desc" => "Upload a client logo or specify the image address of your online clients logo. (http://clientsite.com/logo.png)",
						"id" => $shortname."_client1_logo",
						"std" => "",
						"type" => "upload");
	
	
	$options[] = array( "name" => "Client 1 Target URL",
						"desc" => "Type your client URL",
						"id" => $shortname."_client1_url",
						"std" => "",
						"type" => "text"); 
						
	$options[] = array( "name" => "Client 2 Image",
						"desc" => "Upload a client logo or specify the image address of your online clients logo. (http://clientsite.com/logo.png)",
						"id" => $shortname."_client2_logo",
						"std" => "",
						"type" => "upload");
	
	
	$options[] = array( "name" => "Client 2 Target URL",
						"desc" => "Type your client URL",
						"id" => $shortname."_client2_url",
						"std" => "",
						"type" => "text"); 
		

	$options[] = array( "name" => "Client 3 Image",
						"desc" => "Upload a client logo or specify the image address of your online clients logo. (http://clientsite.com/logo.png)",
						"id" => $shortname."_client3_logo",
						"std" => "",
						"type" => "upload");
	
	
	$options[] = array( "name" => "Client 3 Target URL",
						"desc" => "Type your client URL",
						"id" => $shortname."_client3_url",
						"std" => "",
						"type" => "text"); 
						
	$options[] = array( "name" => "Client 4 Image",
						"desc" => "Upload a client logo or specify the image address of your online clients logo. (http://clientsite.com/logo.png)",
						"id" => $shortname."_client4_logo",
						"std" => "",
						"type" => "upload");
	
	
	$options[] = array( "name" => "Client 4 Target URL",
						"desc" => "Type your client URL",
						"id" => $shortname."_client4_url",
						"std" => "",
						"type" => "text"); 						
						
						
	$options[] = array( "name" => "Client 5 Image",
						"desc" => "Upload a client logo or specify the image address of your online clients logo. (http://clientsite.com/logo.png)",
						"id" => $shortname."_client5_logo",
						"std" => "",
						"type" => "upload");
	
	
	$options[] = array( "name" => "Client 5 Target URL",
						"desc" => "Type your client URL",
						"id" => $shortname."_client5_url",
						"std" => "",
						"type" => "text"); 		
						
							$options[] = array( "name" => "Client 6 Image",
						"desc" => "Upload a client logo or specify the image address of your online clients logo. (http://clientsite.com/logo.png)",
						"id" => $shortname."_client6_logo",
						"std" => "",
						"type" => "upload");
	
	
	$options[] = array( "name" => "Client 6 Target URL",
						"desc" => "Type your client URL",
						"id" => $shortname."_client6_url",
						"std" => "",
						"type" => "text"); 					
						

/* SOCIAL BUTTON OPTIONS
-----------------------------------------------------------------------------------*/
	$options[] = array( "name" => "Social Buttons",
                    "type" => "heading");
	
	$options[] = array( "name" => "Social Tab Text",
						"desc" => "Type here the text for the social menu tab",
						"id" => $shortname."_social_title",
						"std" => "",
						"type" => "text"); 
						
	$options[] = array( "name" => "Facebook",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_facebook",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Twitter",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_twitter",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Google+",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_google",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Pinterest",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_pinterest",
					"std" => "",
					"type" => "text");

	$options[] = array( "name" => "Linkedin",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_linkedin",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Skype",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_skype",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Flickr",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_flickr",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Picasa",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_picasa",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Dribbble",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_dribbble",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Forrst",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_forrst",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "LastFM",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_lastfm",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Vimeo",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_vimeo",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "Youtube",
					"desc" => "You can add your social page URL. Widget shown sidebar with social icons.",
					"id" => $shortname."_social_youtube",
					"std" => "",
					"type" => "text");
	$options[] = array( "name" => "RSS Feed",
					"desc" => "Shows default RSS 2.0 feed url. If you want to change it just enter your RSS url.",
					"id" => $shortname."_social_rss",
					"std" => "",
					"type" => "text");

/* FOOTER OPTIONS
-----------------------------------------------------------------------------------*/
$options[] = array( "name" => "Footer",
                    "type" => "heading");
	
	
	$options[] = array( "name" => "Copyright",
					"desc" => "Enter your copyright line. Use &ampcopy; to create copyright sign",
					"id" => $shortname."_footer_copyright",
					"std" => "&copy; Theme. Wordpress powered",
					"type" => "text");

/* CONTACT PAGE OPTIONS
-----------------------------------------------------------------------------------*/
$options[] = array( "name" => "Contact Page",
                    "type" => "heading");
	
$options[] = array( "name" => "Contact form email address",
						"desc" => "Type email address where you want emails to be sent",
						"id" => $shortname."_email_address",
						"std" => "",
						"type" => "text"); 
		
	
	$options[] = array( "name" => "Contact form thank you message",
						"desc" => "Enter thank you message that will appear after the email will be sent",
						"id" => $shortname."_email_thanku",
						"std" => "",
						"type" => "textarea");  
	
	

	$options[] = array( "name" => "Information Text",
					"desc" => "Enter a text to display information text on the contact page.",
					"id" => $shortname."_contact_text",
					"std" => "",
					"type" => "textarea");
					
	$options[] = array( "name" => "Address",
					"desc" => "Enter a text for address information.",
					"id" => $shortname."_contact_address",
					"std" => "",
					"type" => "text");
					
					
	$options[] = array( "name" => "Telephone",
					"desc" => "Enter a text for telephone information.",
					"id" => $shortname."_contact_telephone",
					"std" => "",
					"type" => "text");					
					
					
	$options[] = array( "name" => "Fax",
					"desc" => "Enter a text for fax information.",
					"id" => $shortname."_contact_fax",
					"std" => "",
					"type" => "text");					
					
					
	$options[] = array( "name" => "Google Map URL",
					"desc" => "Don't enter an iframe code, this also an iframe. So just enter an iframe src (url) value to show custom place on the map.",
					"id" => $shortname."_contact_google",
					"std" => "",
					"type" => "text");					



update_option('of_template',$options); 					     
update_option('of_shortname',$shortname);

}
}
?>
