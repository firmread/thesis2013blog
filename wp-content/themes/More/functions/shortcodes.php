<?php
/*-----------------------------------------------------------------------------------

	SHORCODES
 
-----------------------------------------------------------------------------------

	  1. Columns
	  2. Quotes
	  3. Alerts
	  4. Inline Slider
	  5. Inline Video
	  6. Tabs
	  7. Buttons
	  8. Accordion
	  9. Toggle
	  10. Hero Unit
	  11. Tagline
	  12. Labels
	  13. Code
	  14. Tooltip
	  15. Badges
 
-----------------------------------------------------------------------------------*/
	function my_formatter($content)
	{
		$new_content = '';
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		$pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

		foreach ( $pieces as $piece )
		{
			if ( preg_match( $pattern_contents, $piece, $matches ) )
			{
				$new_content .= $matches[1];
			}
			else
			{
				$new_content .= wptexturize( wpautop( $piece ) );
			}
		}
		
		return $new_content;
	}

	remove_filter( 'the_content', 'wpautop' );
	remove_filter( 'the_content', 'wptexturize' );

	add_filter( 'the_content', 'my_formatter', 99 );
	add_filter( 'widget_text', 'my_formatter', 99 );
	
	add_filter( 'widget_text', 'do_shortcode' );
	add_filter( 'the_excerpt', 'do_shortcode' );
	


/*-----------------------------------------------------------------------------------
	COLUMNS 
-----------------------------------------------------------------------------------*/
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	function column_full( $atts, $content = null )
	{	
		$column_full =  '<div class="row"><div class="span12">' . do_shortcode( $content ) . '</div></div>';
		
		return $column_full;
	}
  
	add_shortcode('column_full', 'column_full');
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
	function column_wrap( $atts, $content = null )
	{	
		$column_wrap =  '<div class="row">' . do_shortcode( $content ) . '</div>';
		
		return $column_wrap;
	}
  
	add_shortcode('column_wrap', 'column_wrap');
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
	function column_half( $atts, $content = null )
	{	
		$column_half =  '<div class="span6">' . do_shortcode( $content ) . '</div>';
		
		return $column_half;
	}
  
	add_shortcode('column_half', 'column_half');
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
	function column_two_third( $atts, $content = null )
	{	
		$column_two_third =  '<div class="span8">' . do_shortcode( $content ) . '</div>';
		
		return $column_two_third;
	}
  
	add_shortcode('column_two_third', 'column_two_third');
	
	function column_one_third( $atts, $content = null )
	{	
		$column_one_third =  '<div class="span4">' . do_shortcode( $content ) . '</div>';
		
		return $column_one_third;
	}
  
	add_shortcode('column_one_third', 'column_one_third');
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
	function column_three_fourth( $atts, $content = null )
	{	
		$column_three_fourth =  '<div class="span9">' . do_shortcode( $content ) . '</div>';
		
		return $column_three_fourth;
	}
  
	add_shortcode('column_three_fourth', 'column_three_fourth');
	
	function column_one_fourth( $atts, $content = null )
	{	
		$column_one_fourth =  '<div class="span3">' . do_shortcode( $content ) . '</div>';
		
		return $column_one_fourth;
	}
  
	add_shortcode('column_one_fourth', 'column_one_fourth');
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
	function column_five_sixth( $atts, $content = null )
	{	
		$column_five_sixth =  '<div class="span10">' . do_shortcode( $content ) . '</div>';
		
		return $column_five_sixth;
	}
  
	add_shortcode('column_five_sixth', 'column_five_sixth');
	
	function column_one_sixth( $atts, $content = null )
	{	
		$column_one_sixth =  '<div class="span2">' . do_shortcode( $content ) . '</div>';
		
		return $column_one_sixth;
	}
  
	add_shortcode('column_one_sixth', 'column_one_sixth');
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	function column_eleven_twelveth( $atts, $content = null )
	{	
		$column_eleven_twelveth =  '<div class="span11">' . do_shortcode( $content ) . '</div>';
		
		return $column_eleven_twelveth;
	}
  
	add_shortcode('column_eleven_twelveth', 'column_eleven_twelveth');
	
	function column_one_twelveth( $atts, $content = null )
	{	
		$column_one_twelveth =  '<div class="span1">' . do_shortcode( $content ) . '</div>';
		
		return $column_one_twelveth;
	}

	add_shortcode('column_one_twelveth', 'column_one_twelveth');




/*-----------------------------------------------------------------------------------
	QUOTES
-----------------------------------------------------------------------------------*/
function blockquote( $atts, $content = null )
	{
		extract( shortcode_atts( array('sign' => ''), $atts ) );
		
		if ( $sign != "" )
		{
			$sign_out = '<small>' . $sign . '</small>';
		}
		
		$blockquote =  '<blockquote><p>' . do_shortcode( $content ) . '</p>' . $sign_out . '</blockquote>';
		
		return $blockquote;
	}

	add_shortcode('blockquote', 'blockquote');




/*-----------------------------------------------------------------------------------
	ALERTS
-----------------------------------------------------------------------------------*/
	function alert( $atts, $content = null )
	{
		extract( shortcode_atts( array('alert_type' => '', 'closable_alert' => 'x', 'alert_title' => ''), $atts ) );
		
		$alert =  '<div class="alert ' . $alert_type . ' fade in"><a class="close" data-dismiss="alert">' . $closable_alert . '</a><strong>' . $alert_title . '</strong> ' . do_shortcode( $content ) . '</div>';
		
		return $alert;
	}
  
	add_shortcode('alert', 'alert');


/*----------------------------------------------------------------------------------
	INLINE SLIDER
-----------------------------------------------------------------------------------*/
function inline_slider( $atts, $content = null )
	{
		extract( shortcode_atts( array( 'arrows' => 'true' ), $atts ) );

		$inline_slider =  '<div class="slider_area"><div class="theme-default"><div id="slider" class="nivoSlider">' . do_shortcode( $content ) . '</div></div></div>';
		
		return $inline_slider;
	}

	add_shortcode('inline_slider', 'inline_slider');

	function slide( $atts, $content = null )
	{
		extract( shortcode_atts( array( 'url' => '', 'src' => '' ), $atts ) );
		

		$url_out_begin = '';
		$url_out_end = '';
		
		if ( $url != '' )
		{
			$url_out_begin = '<a href="' . $url . '">';
			$url_out_end = '</a>';
		}

		$slide =  '' . $url_out_begin . '<img src="' . $src . '" alt="">' . $url_out_end . '';

		return $slide;
	}

	add_shortcode( 'slide', 'slide' );


/*-----------------------------------------------------------------------------------
	INLINE VIDEO
-----------------------------------------------------------------------------------*/

function inline_video( $atts, $content = null )
	{
		extract( shortcode_atts( array( 'src' => '' ), $atts ) );

		$inline_video = '<div class="theme-default video-container"><iframe src="' . $src . '" frameborder="0"></iframe></div>';
		
		return $inline_video;
	}

	add_shortcode( 'inline_video', 'inline_video' );

/*-----------------------------------------------------------------------------------
	TABS
-----------------------------------------------------------------------------------*/
function tabset( $atts, $content = null )
	{
		$tabset =  '<div>' . do_shortcode( $content ) . '</div>';
		
		return $tabset;
	}
  
	add_shortcode('tabset', 'tabset');
	
	function tab_head( $atts, $content = null )
	{
		$tab_head = '<ul class="nav nav-tabs">' . do_shortcode( $content ) . '</ul>';
		
		return $tab_head;
	}
  
	add_shortcode('tab_head', 'tab_head');
	
	function tab_title( $atts, $content = null )
	{
		extract( shortcode_atts( array( 'active' => '',
										'sequence' => ''), $atts ) );
										
		$tab_title = '<li class="' . $active . '"><a href="#' . $sequence . '" data-toggle="tab">' . $content . '</a></li>';
		
		return $tab_title;
	}
  
	add_shortcode('tab_title', 'tab_title');
	
	function tab_content( $atts, $content = null )
	{
		$tab_content = '<div class="tab-content">' . do_shortcode( $content ) . '</div>';
		
		return $tab_content;
	}
  
	add_shortcode('tab_content', 'tab_content');
	
	function tab_pane( $atts, $content = null )
	{
		extract( shortcode_atts( array( 'active' => '',
										'sequence' => ''), $atts ) );
		
		$tab_pane = '<div class="tab-pane ' . $active . '" id="' . $sequence . '"><p>' . do_shortcode( $content ) . '</p></div>';
		
		return $tab_pane;
	}
  
	add_shortcode('tab_pane', 'tab_pane');
/*-----------------------------------------------------------------------------------
	BUTTONS
-----------------------------------------------------------------------------------*/
function button( $atts, $content = null )
	{
		extract( shortcode_atts( array('button_text' => 'Button', 'bold_text' => '', 'button_type' => 'btn-default', 'button_size' => '', 'button_link' => '#'), $atts ) );
		
		if ( $bold_text == "yes" )
		{
			$button_text_out =  "<b>$button_text</b>";
		}
		else
		{
			$button_text_out =  "$button_text";
		}
		
		$button =  '<a class="btn ' . $button_type . ' ' . $button_size . '" href="' . $button_link . '">' . $button_text_out . '</a>';
		
		return $button;
	}
  
	add_shortcode('button', 'button');
/*-----------------------------------------------------------------------------------
	ACCORDIONS
-----------------------------------------------------------------------------------*/


	function accordion( $atts, $content = null )
	{
		$accordion =  '<div class="accordion">' . do_shortcode( $content ) . '</div>';
		
		return $accordion;
	}
  
	add_shortcode('accordion', 'accordion');
	
	function accordion_pane( $atts, $content = null )
	{
		extract( shortcode_atts( array('accordion_title' => ''), $atts ) );
										
		$accordion_pane = '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle"><i class="icon-active icon-chevron-down"></i> <i class="icon-passive icon-chevron-right"></i> ' . $accordion_title . '</a></div><div class="accordion-body"><div class="accordion-inner">' . do_shortcode( $content ) . '</div></div></div>';
		
		return $accordion_pane;
	}
  
	add_shortcode('accordion_pane', 'accordion_pane');

/*-----------------------------------------------------------------------------------
	HERO UNIT
-----------------------------------------------------------------------------------*/	
	function hero_unit( $atts, $content = null )
	{
		extract( shortcode_atts( array('hero_title' => '', 'hero_button_type' => '', 'hero_button_title' => 'Click Here!', 'hero_button_link' => '#'), $atts ) );
		
		if ( !$hero_title == "" )
		{
			$hero_title_out =  "<h1><b>$hero_title</b></h1>";
		}
		else
		{
			$hero_title_out =  "";
		}
		
		if ( !$hero_button_type == "" )
		{
			$hero_button_out =  '<p><a href="' . $hero_button_link . '" class="btn ' . $hero_button_type . ' btn-large"><b>' . $hero_button_title . '</b></a></p>';
		}
		else
		{
			$hero_button_out =  "";
		}
	
		$hero_unit =  '<div class="hero-unit sep_bg">' . $hero_title_out . '<p>' . do_shortcode( $content ) . '</p>' . $hero_button_out . '</div>';
		
		return $hero_unit;
	}
  
	add_shortcode('hero_unit', 'hero_unit');	
/*-----------------------------------------------------------------------------------
	TAGLINE
-----------------------------------------------------------------------------------*/		
	function tagline( $atts, $content = null )
	{
		$tagline =  '<div class="presentation"><h1><span class="colored">' . do_shortcode( $content ) . '</span></h1></div>';
		
		return $tagline;
	}

	add_shortcode('tagline', 'tagline');
	
/*-----------------------------------------------------------------------------------
	LABELS
-----------------------------------------------------------------------------------*/

function label( $atts, $content = null )
	{
		extract( shortcode_atts( array( 'color' => 'grey' ), $atts ) );
		
		if ( $color == 'grey')
		{
			$color_out = '';
		}
		elseif ( $color == 'green')
		{
			$color_out = 'label-success';
		}
		elseif ( $color == 'yellow')
		{
			$color_out = 'label-warning';
		}
		elseif ( $color == 'red')
		{
			$color_out = 'label-important';
		}
		elseif ( $color == 'blue')
		{
			$color_out = 'label-info';
		}
		elseif ( $color == 'black')
		{
			$color_out = 'label-inverse';
		}
		
		$label =  '<span class="label ' . $color_out . '">' . do_shortcode( $content ) . '</span>';
		
		return $label;
	}

	add_shortcode('label', 'label');
	
/*-----------------------------------------------------------------------------------
	CODE
-----------------------------------------------------------------------------------*/	
	
	function code_text( $atts, $content = null )
	{		
		$code_text =  '<pre class="prettyprint linenums">' . do_shortcode( $content ) . '</pre>';
		
		return $code_text;
	}

	add_shortcode('code_text', 'code_text');
	
/*-----------------------------------------------------------------------------------
	TABLE
-----------------------------------------------------------------------------------*/
	
function table_wrap( $atts, $content = null )
	{
		$table_wrap =  '<table class="table table-striped table-bordered">' . do_shortcode( $content ) . '</table>';
		
		return $table_wrap;
	}

	add_shortcode('table_wrap', 'table_wrap');
	
	function table_columns( $atts, $content = null )
	{
		$table_columns =  '<thead><tr>' . do_shortcode( $content ) . '</tr></thead>';
		
		return $table_columns;
	}

	add_shortcode('table_columns', 'table_columns');
	
	function table_column( $atts, $content = null )
	{
		$table_column =  '<th>' . do_shortcode( $content ) . '</th>';
		
		return $table_column;
	}

	add_shortcode('table_column', 'table_column');
	
	function table_content( $atts, $content = null )
	{
		$table_content =  '<tbody>' . do_shortcode( $content ) . '</tbody>';
		
		return $table_content;
	}

	add_shortcode('table_content', 'table_content');
	
	function table_row( $atts, $content = null )
	{
		$table_row =  '<tr>' . do_shortcode( $content ) . '</tr>';
		
		return $table_row;
	}

	add_shortcode('table_row', 'table_row');
	
	function table_cell( $atts, $content = null )
	{
		$table_cell =  '<td>' . do_shortcode( $content ) . '</td>';
		
		return $table_cell;
	}

	add_shortcode( 'table_cell', 'table_cell' );	
		
/*-----------------------------------------------------------------------------------
	TOOLTIP
-----------------------------------------------------------------------------------*/

function tooltip( $atts, $content = null )
	{
		extract( shortcode_atts( array('tip' => ''), $atts ) );
		
		if ( $tip != "" )
		{
			$tip_out = 'title="' . $tip . '"';
		}
		
		$tooltip =  '<a href="#" rel="tooltip" ' . $tip_out . '> ' . do_shortcode( $content ) . '</a>';
		
		return $tooltip;
	}

	add_shortcode('tooltip', 'tooltip');
	
	
/*-----------------------------------------------------------------------------------
	BADGES
-----------------------------------------------------------------------------------*/

function badge( $atts, $content = null )
	{
		extract( shortcode_atts( array( 'color' => 'grey' ), $atts ) );
		
		if ( $color == 'grey')
		{
			$color_out = '';
		}
		elseif ( $color == 'green')
		{
			$color_out = 'badge-success';
		}
		elseif ( $color == 'yellow')
		{
			$color_out = 'badge-warning';
		}
		elseif ( $color == 'red')
		{
			$color_out = 'badge-important';
		}
		elseif ( $color == 'blue')
		{
			$color_out = 'badge-info';
		}
		elseif ( $color == 'black')
		{
			$color_out = 'badge-inverse';
		}
		
		$label =  '<span class="badge ' . $color_out . '">' . do_shortcode( $content ) . '</span>';
		
		return $label;
	}

	add_shortcode('badge', 'badge');
	
	?>