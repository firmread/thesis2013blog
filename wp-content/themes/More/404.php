<?php 
/* 404 Page Template */ 
?>

<?php get_header(); ?>
<div class="container">
        <div class="row">
<div class="span12">
<div style=" text-align:center;"><img src="<?php echo get_option('of_fof_image'); ?>" /></div>
<div class="hero-unit">
<h1><?php echo get_option('of_fof_title'); ?></h1>
 <p>
		 <?php echo get_option('of_fof_text'); ?>
      </p></div>
     
      
     

</div></div></div>
<?php get_footer(); ?>