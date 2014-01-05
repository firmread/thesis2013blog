<?php
/*-----------------------------------------------------------------------------------

	Include Google fonts
 
-----------------------------------------------------------------------------------*/
?>
<?php if (get_option('of_custom_title_font') == true){ // Google fonts custom ?>

<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", get_option('of_custom_title_font')); ?>' rel='stylesheet' type='text/css'>
<style>
   h1, h2, h3, h4, h5, h6, #menu a {font-family:<?php echo get_option('of_custom_title_font'); ?> !important;}
</style>

<?php } else{ // Google fonts inbuilt select ?>

<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", get_option('of_title_font')); ?>' rel='stylesheet' type='text/css'>
<style>
   h1, h2, h3, h4, h5, h6, #menu a {font-family:<?php echo get_option('of_title_font'); ?> !important;}
</style>


<?php } ?>