<?php $search_text = __('Enter Your Keyword...', 'themeText'); ?> 
<form method="get" action="<?php echo home_url( '/' ); ?>"> 
 <div style="margin-left:25px;" class="input-append">
                <input placeholder="<?php echo $search_text; ?>" class="span3" name="s" id="appendedInputButton" value="<?php the_search_query(); ?>" size="16" type="text">
                <button id="searchsubmit" class="btn visible-desktop" type="submit">Go!</button>
              </div>
</form>


