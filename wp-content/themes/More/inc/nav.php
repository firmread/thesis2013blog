<?php 
/*-----------------------------------------------------------------------------------

 	Blog Navigation. 
	Two variations: WOrdpress classic and Paging.
 
-------------------------------------------------------------------------------------*/
?>
   <?php if (show_posts_nav()) : ?>

   	<?php if (get_option('of_paging') == 'classic'){ // Classic ?>
    <ul class="pager">
      <li class="next2"><?php previous_posts_link(__('Newer &rarr;', 'themeText')) ?></li>
      
      <li class="previous2"><?php next_posts_link(__('&larr; Older', 'themeText')) ?></li>
  </ul>    
<?php wp_link_pages('before='); ?>
      
    <?php } else{ // Paging ?>
    
      <div class="span8 pagination pagination-left">
    <ul>
       <?php num_paging(); ?>
      </ul>
    </div>
      
    <?php } ?>
  
   <?php endif; ?>