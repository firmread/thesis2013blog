<?php
/*-----------------------------------------------------------------------------------*/
/*  Global Paging  */
/*-----------------------------------------------------------------------------------*/

/**
* A pagination function
* @param integer $range: The range of the slider, works best with even numbers
* Used WP functions:
* get_pagenum_link($i) - creates the link, e.g. http://site.com/page/4
* previous_posts_link(' « '); - returns the Previous page link
* next_posts_link(' » '); - returns the Next page link
*/


function num_paging($range = 4){
  // $paged - number of the current page
  global $paged, $wp_query, $max_page;
  // How much pages do we have?
  if ( !$max_page ) {
    $max_page = $wp_query->max_num_pages;
  }
  // We need the pagination only if there are more than 1 page
  if($max_page > 1){
    if(!$paged){
      $paged = 1;
    }
    // On the first page, don't put the First page link
    if($paged != 1){
		echo "<li>";
    	previous_posts_link(' &larr; Previous ');
		//echo "<a href=" . get_pagenum_link(1) . "> Newer </a>";
		echo "</li>";
    }
    // To the previous page
	
    // We need the sliding effect only if there are more pages than is the sliding range
    if($max_page > $range){
      // When closer to the beginning
      if($paged < $range){
        for($i = 1; $i <= ($range + 1); $i++){
		  echo "<li>";
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
		  echo "</li>";
        }
      }
      // When closer to the end
      elseif($paged >= ($max_page - ceil(($range/2)))){
        for($i = $max_page - $range; $i <= $max_page; $i++){
		  echo "<li>";
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
		  echo "</li>";
        }
      }
      // Somewhere in the middle
      elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
		  echo "<li>";
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
		  echo "</li>";
        }
      }
    }
    // Less pages than the range, no sliding effect needed
    else{
      for($i = 1; $i <= $max_page; $i++){
        echo "<li>";
		echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged) echo "class='current'";
        echo ">$i</a>";
		echo "</li>";
      }
    }
    // Next page
    // On the last page, don't put the Last page link
    if($paged != $max_page){
		echo "<li>";
		next_posts_link(' Next &rarr; ');
		//echo " <a href=" . get_pagenum_link($max_page) . "> Older </a>";
		echo "</li>";
   }
  }
}
?>