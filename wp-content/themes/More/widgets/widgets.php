<?php
/**
 * Add function to widgets_init that'll load widget.
 */
add_action( 'widgets_init', 'contact_load_widgets' );

/**
 * Register widget.
 */
function contact_load_widgets() {
	register_widget( 'Contact_Info_Widget' );
}

/**
 * Latest Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.
 */
class Contact_Info_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Contact_Info_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'contact-info', 'description' => __('Your contact information', 'contact-info') );

		/* Widget control settings. */
		$control_ops = array( /*'width' => 252, 'height' => 350,*/ 'id_base' => 'contact-info-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'contact-info-widget', __('6 - More+ FOOTER Contact Info', 'contact-info'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$pnumber = $instance['pnumber'];
		$emailadr = $instance['emailadr'];
		$streetadr = $instance['streetadr'];
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?><p>
            <i class="icon-map-marker icon-white"></i> <?php echo $streetadr ?><br />
            <i class="icon-user  icon-white"></i> <?php echo $pnumber ?><br />
            <i class="icon-envelope icon-white"></i> <a href="mailto:<?php echo $emailadr ?>"><?php echo $emailadr ?></a></p>
              
            
        <?php
		
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['pnumber'] = strip_tags( $new_instance['pnumber'] );
		$instance['emailadr'] = strip_tags( $new_instance['emailadr'] );
		$instance['streetadr'] = strip_tags( $new_instance['streetadr'] );
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Contact info');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
        

		<!-- Widget Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'themeText'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
        
        
		<!-- Phone number -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pnumber' ); ?>"><?php _e('Tel number:', 'themeText'); ?></label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'pnumber' ); ?>" name="<?php echo $this->get_field_name( 'pnumber' ); ?>" value="<?php echo $instance['pnumber']; ?>" class="widefat" />
		</p>
                
        
        <!-- Email -->
		<p>
			<label for="<?php echo $this->get_field_id( 'emailadr' ); ?>"><?php _e('E-mail:', 'themeText'); ?></label><br />
			<input type="text" id="<?php echo $this->get_field_id( 'emailadr' ); ?>" name="<?php echo $this->get_field_name( 'emailadr' ); ?>" value="<?php echo $instance['emailadr']; ?>" class="widefat" />
		</p>
		
        
         <!-- Address -->
		<p>
			<label for="<?php echo $this->get_field_id( 'streetadr' ); ?>"><?php _e('Address:', 'themeText'); ?></label><br />
			<textarea type="text" id="<?php echo $this->get_field_id( 'streetadr' ); ?>" name="<?php echo $this->get_field_name( 'streetadr' ); ?>" class="widefat"><?php echo $instance['streetadr']; ?></textarea>
		</p>
	<?php
	}
}

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	class Twitter_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('twitter_widget',
								__( '1 - More+ FOOTER Twitter Tweets', 'themeText' ),
								array( 'description' => __( 'Display latest Twitter tweets', 'themeText' ) ) );
		}

		public function widget( $args, $instance )
		{
			extract( $args );
			
			$twitter_title = apply_filters( 'widget_title', $instance['twitter_title'] );
			$twitter_username = apply_filters( 'widget_title', $instance['twitter_username'] );
			$tweets_count = apply_filters( 'widget_title', $instance['tweets_count'] );

			echo $before_widget;
			
			if ( ! empty( $twitter_title ) )
			{
				echo $before_title . $twitter_title . $after_title;
			}
			
				$id = rand(0,999);
			?>
				 <script type="text/javascript">
				jQuery(function(){
				  jQuery(".tweet_<?php echo $id; ?>").tweet({
					join_text: "auto",
					username: "<?php echo $twitter_username; ?>",
					avatar_size: 30,
					count: <?php echo $tweets_count; ?>,
					auto_join_text_default: "",
					auto_join_text_ed: "we",
					auto_join_text_ing: "we were",
					auto_join_text_reply: "we replied",
					auto_join_text_url: "we were checking out",
					loading_text: "loading tweets..."
				  });
				});
  			</script>
            <div id="twitter-widget" class="tweet_<?php echo $id; ?>"></div>
			<?php
			
			echo $after_widget;
		}

		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			
			$instance['twitter_title'] = strip_tags( $new_instance['twitter_title'] );
			$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
			$instance['tweets_count'] = strip_tags( $new_instance['tweets_count'] );

			return $instance;
		}
		
		public function form( $instance )
		{
			if ( isset( $instance[ 'twitter_title' ] ) ) { $twitter_title = $instance[ 'twitter_title' ]; } else { $twitter_title = 'TWITTER'; }
			if ( isset( $instance[ 'twitter_username' ] ) ) { $twitter_username = $instance[ 'twitter_username' ]; } else { $twitter_username = 'envato'; }
			if ( isset( $instance[ 'tweets_count' ] ) ) { $tweets_count = $instance[ 'tweets_count' ]; } else { $tweets_count = '2'; }
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'twitter_title' ); ?>"><?php echo __( 'Title:', 'themeText' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter_title' ); ?>" name="<?php echo $this->get_field_name( 'twitter_title' ); ?>" value="<?php echo esc_attr( $twitter_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php echo __( 'Twitter Username:', 'themeText' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo esc_attr( $twitter_username ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'tweets_count' ); ?>"><?php echo __( 'Tweets Count:', 'themeText' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'tweets_count' ); ?>" name="<?php echo $this->get_field_name( 'tweets_count' ); ?>">
					<option <?php if ( @$instance['tweets_count'] == "1" ) { echo 'selected="selected"'; } ?> value="1">1</option>
					<option <?php if ( @$instance['tweets_count'] == "2" ) { echo 'selected="selected"'; } ?> value="2">2</option>
					<option <?php if ( @$instance['tweets_count'] == "3" ) { echo 'selected="selected"'; } ?> value="3">3</option>
					<option <?php if ( @$instance['tweets_count'] == "4" ) { echo 'selected="selected"'; } ?> value="4">4</option>
					<option <?php if ( @$instance['tweets_count'] == "5" ) { echo 'selected="selected"'; } ?> value="5">5</option>
				</select>
			</p>
		<?php
		}

	}

	add_action( 'widgets_init', create_function( '', 'register_widget( "twitter_widget" );' ) );

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	class Flickr_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('flickr_widget',
								__( '2 - More+ FOOTER Flickr Photostream', 'themeText' ),
								array( 'description' => __( 'Display Flickr Photostream', 'themeText' ) ) );
		}

		public function widget( $args, $instance )
		{
			extract( $args );
			
			$flickr_title = apply_filters( 'widget_title', $instance['flickr_title'] );
			$flickr_user_id = apply_filters( 'widget_title', $instance['flickr_user_id'] );
			$flickr_count = apply_filters( 'widget_title', $instance['flickr_count'] );
			$flickr_display = apply_filters( 'widget_title', $instance['flickr_display'] );

			echo $before_widget;
			
			if ( ! empty( $flickr_title ) )
			{
				echo $before_title . $flickr_title . $after_title;
			}
			
			?>
				<div id="flickr_badge_wrapper"  class="clearfix">
					<script src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickr_count; ?>&amp;display=<?php echo $flickr_display; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_user_id; ?>"></script>
				</div>
			<?php
			
			echo $after_widget;
		}

		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			
			$instance['flickr_title'] = strip_tags( $new_instance['flickr_title'] );
			$instance['flickr_user_id'] = strip_tags( $new_instance['flickr_user_id'] );
			$instance['flickr_count'] = strip_tags( $new_instance['flickr_count'] );
			$instance['flickr_display'] = strip_tags( $new_instance['flickr_display'] );

			return $instance;
		}
		
		public function form( $instance )
		{
			if ( isset( $instance[ 'flickr_title' ] ) ) { $flickr_title = $instance[ 'flickr_title' ]; } else { $flickr_title = 'FLICKR'; }
			if ( isset( $instance[ 'flickr_user_id' ] ) ) { $flickr_user_id = $instance[ 'flickr_user_id' ]; } else { $flickr_user_id = '52617155@N08'; }
			if ( isset( $instance[ 'flickr_count' ] ) ) { $flickr_count = $instance[ 'flickr_count' ]; } else { $flickr_count = '8'; }
			if ( isset( $instance[ 'flickr_display' ] ) ) { $flickr_display = $instance[ 'flickr_display' ]; } else { $flickr_display = 'Latest'; }
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr_title' ); ?>"><?php echo __( 'Title:', 'themeText' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickr_title' ); ?>" name="<?php echo $this->get_field_name( 'flickr_title' ); ?>" value="<?php echo esc_attr( $flickr_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr_user_id' ); ?>"><?php echo __( 'Flickr User ID:', 'themeText' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'flickr_user_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_user_id' ); ?>" value="<?php echo esc_attr( $flickr_user_id ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr_count' ); ?>"><?php echo __( 'Images Count:', 'themeText' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'flickr_count' ); ?>" name="<?php echo $this->get_field_name( 'flickr_count' ); ?>">
					<option <?php if ( @$instance['flickr_count'] == "1" ) { echo 'selected="selected"'; } ?> value="1">1</option>
					<option <?php if ( @$instance['flickr_count'] == "2" ) { echo 'selected="selected"'; } ?> value="2">2</option>
					<option <?php if ( @$instance['flickr_count'] == "3" ) { echo 'selected="selected"'; } ?> value="3">3</option>
					<option <?php if ( @$instance['flickr_count'] == "4" ) { echo 'selected="selected"'; } ?> value="4">4</option>
					<option <?php if ( @$instance['flickr_count'] == "5" ) { echo 'selected="selected"'; } ?> value="5">5</option>
					<option <?php if ( @$instance['flickr_count'] == "6" ) { echo 'selected="selected"'; } ?> value="6">6</option>
					<option <?php if ( @$instance['flickr_count'] == "7" ) { echo 'selected="selected"'; } ?> value="7">7</option>
					<option <?php if ( @$instance['flickr_count'] == "8" ) { echo 'selected="selected"'; } ?> value="8">8</option>
					<option <?php if ( @$instance['flickr_count'] == "9" ) { echo 'selected="selected"'; } ?> value="9">9</option>
					<option <?php if ( @$instance['flickr_count'] == "10" ) { echo 'selected="selected"'; } ?> value="10">10</option>
					<option <?php if ( @$instance['flickr_count'] == "12" ) { echo 'selected="selected"'; } ?> value="12">12</option>
					<option <?php if ( @$instance['flickr_count'] == "16" ) { echo 'selected="selected"'; } ?> value="16">16</option>
					<option <?php if ( @$instance['flickr_count'] == "20" ) { echo 'selected="selected"'; } ?> value="20">20</option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr_display' ); ?>"><?php echo __( 'Display:', 'themeText' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'flickr_display' ); ?>" name="<?php echo $this->get_field_name( 'flickr_display' ); ?>">
					<option <?php if ( @$instance['flickr_display'] == "Latest" ) { echo 'selected="selected"'; } ?> value="Latest">Latest</option>
					<option <?php if ( @$instance['flickr_display'] == "Random" ) { echo 'selected="selected"'; } ?> value="Random">Random</option>
				</select>
			</p>
		<?php
		}

	}

	add_action( 'widgets_init', create_function( '', 'register_widget( "flickr_widget" );' ) );

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	class Categories_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('categories_widget',
								__( '3 - More+ Categories', 'themeText' ),
								array( 'description' => __( 'A list of post categories', 'themeText' ) ) );
		}

		public function widget( $args, $instance )
		{
			extract( $args );
			
			$categories_title = apply_filters( 'widget_title', $instance['categories_title'] );

			echo $before_widget;
			
			if ( ! empty( $categories_title ) )
			{
				echo $before_title . $categories_title . $after_title;
			}
			
			$post_categories = get_categories( 'type=post&taxonomy=category' );
			
			echo '<ul class="nav nav-pills nav-stacked">';
			
				foreach( $post_categories as $post_category ) :
				?>
					<li><a href="<?php echo get_category_link( $post_category->term_id ); ?>"><i class="icon-star-empty"></i> &nbsp;<?php echo $post_category->name; ?></a></li>
				<?php 
				endforeach;
			
			echo '</ul>';
			
			echo $after_widget;
		}

		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			
			$instance['categories_title'] = strip_tags( $new_instance['categories_title'] );

			return $instance;
		}
		
		public function form( $instance )
		{
			if ( isset( $instance[ 'categories_title' ] ) ) { $categories_title = $instance[ 'categories_title' ]; } else { $categories_title = 'CATEGORIES'; }
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'categories_title' ); ?>"><?php echo __( 'Title:', 'themeText' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'categories_title' ); ?>" name="<?php echo $this->get_field_name( 'categories_title' ); ?>" value="<?php echo esc_attr( $categories_title ); ?>" />
			</p>
		<?php
		}

	}

	add_action( 'widgets_init', create_function( '', 'register_widget( "categories_widget" );' ) );

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	class Feat_Posts_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('feat_posts_widget',
								__( '4 - More+ Featured Posts', 'themeText' ),
								array( 'description' => __( 'Most populer posts from your blog', 'themeText' ) ) );
		}

		public function widget( $args, $instance )
		{
			extract( $args );
			
			$feat_posts_title = apply_filters( 'widget_title', $instance['feat_posts_title'] );
			$feat_posts_count = apply_filters( 'widget_title', $instance['feat_posts_count'] );

			echo $before_widget;
			
			if ( ! empty( $feat_posts_title ) )
			{
				echo $before_title . $feat_posts_title . $after_title;
			}
			
			echo '<div class="featured-posts">';
			
			$feat_posts_query = 'orderby=comment_count&posts_per_page=' . $feat_posts_count;

			$pc = new WP_Query($feat_posts_query);
			
			function the_excerpt_max_charlength2($charlength)
			{
				$excerpt = get_the_excerpt();
				$charlength++;

				if ( strlen( $excerpt ) > $charlength )
				{
					$subex = substr( $excerpt, 0, $charlength - 5 );
					$exwords = explode( ' ', $subex );
					$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
					
					if ( $excut < 0 )
					{
						echo substr( $subex, 0, $excut );
					}
					else
					{
						echo $subex;
					}
					
					echo '...';
				}
				else
				{
					echo $excerpt;
				}
			}
	
			while ( $pc->have_posts() ) : $pc->the_post();
			?>
				<!--item-->
				<div class="item">
					<a href="<?php the_permalink(); ?>" class="image-box">
						<?php
						if ( has_post_thumbnail() )
						{
							$the_post_img_alt = get_the_title();
							the_post_thumbnail('featured_post', array('alt'	=> "$the_post_img_alt", 'title'	=> ""));
						}
						
						?>
					</a>
					<div class="info">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<p><?php the_excerpt_max_charlength2(80); ?></p>
					</div>
				</div>
				<!--item-->
			<?php
			endwhile;
			
			wp_reset_query();
			
			echo '</div>';
			
			echo $after_widget;
		}

		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			
			$instance['feat_posts_title'] = strip_tags( $new_instance['feat_posts_title'] );
			$instance['feat_posts_count'] = strip_tags( $new_instance['feat_posts_count'] );

			return $instance;
		}
		
		public function form( $instance )
		{
			if ( isset( $instance[ 'feat_posts_title' ] ) ) { $feat_posts_title = $instance[ 'feat_posts_title' ]; } else { $feat_posts_title = 'FEATURED POSTS'; }
			if ( isset( $instance[ 'feat_posts_count' ] ) ) { $feat_posts_count = $instance[ 'feat_posts_count' ]; } else { $feat_posts_count = '5'; }
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'feat_posts_title' ); ?>"><?php echo __( 'Title:', 'themeText' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'feat_posts_title' ); ?>" name="<?php echo $this->get_field_name( 'feat_posts_title' ); ?>" value="<?php echo esc_attr( $feat_posts_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'feat_posts_count' ); ?>"><?php echo __( 'Posts Count:', 'themeText' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'feat_posts_count' ); ?>" name="<?php echo $this->get_field_name( 'feat_posts_count' ); ?>">
					<option <?php if ( @$instance['feat_posts_count'] == "1" ) { echo 'selected="selected"'; } ?> value="1">1</option>
					<option <?php if ( @$instance['feat_posts_count'] == "2" ) { echo 'selected="selected"'; } ?> value="2">2</option>
					<option <?php if ( @$instance['feat_posts_count'] == "3" ) { echo 'selected="selected"'; } ?> value="3">3</option>
					<option <?php if ( @$instance['feat_posts_count'] == "4" ) { echo 'selected="selected"'; } ?> value="4">4</option>
					<option <?php if ( @$instance['feat_posts_count'] == "5" ) { echo 'selected="selected"'; } ?> value="5">5</option>
					<option <?php if ( @$instance['feat_posts_count'] == "6" ) { echo 'selected="selected"'; } ?> value="6">6</option>
					<option <?php if ( @$instance['feat_posts_count'] == "7" ) { echo 'selected="selected"'; } ?> value="7">7</option>
					<option <?php if ( @$instance['feat_posts_count'] == "8" ) { echo 'selected="selected"'; } ?> value="8">8</option>
					<option <?php if ( @$instance['feat_posts_count'] == "9" ) { echo 'selected="selected"'; } ?> value="9">9</option>
					<option <?php if ( @$instance['feat_posts_count'] == "10" ) { echo 'selected="selected"'; } ?> value="10">10</option>
				</select>
			</p>
		<?php
		}

	}

	add_action( 'widgets_init', create_function( '', 'register_widget( "feat_posts_widget" );' ) );

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	class Footer_Text_Image_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('footer_text_image_widget',
								__( '5 - More+ Text with Image', 'themeText' ),
								array( 'description' => __( 'Mostly uses in the sidebar about us', 'themeText' ) ) );
		}

		public function widget( $args, $instance )
		{
			extract( $args );
			
			$text_image_title = apply_filters( 'widget_title', $instance['text_image_title'] );
			$text_image_image = apply_filters( 'widget_title', $instance['text_image_image'] );
			$text_image_text = apply_filters( 'widget_title', $instance['text_image_text'] );

			echo $before_widget;
			
			if ( ! empty( $text_image_title ) )
			{
				echo $before_title . $text_image_title . $after_title;
			}
			
			echo '<div class="text-widget">';
				?>
					<img class="widgetlogo" alt="" src="<?php echo $text_image_image; ?>">
					<p><?php echo $text_image_text; ?></p>
				<?php
			echo '</div>';
			
			echo $after_widget;
		}

		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			
			$instance['text_image_title'] = strip_tags( $new_instance['text_image_title'] );
			$instance['text_image_image'] = strip_tags( $new_instance['text_image_image'] );
			$instance['text_image_text'] = strip_tags( $new_instance['text_image_text'] );

			return $instance;
		}
		
		public function form( $instance )
		{
			if ( isset( $instance[ 'text_image_title' ] ) ) { $text_image_title = $instance[ 'text_image_title' ]; } else { $text_image_title = 'ABOUT US'; }
			if ( isset( $instance[ 'text_image_image' ] ) ) { $text_image_image = $instance[ 'text_image_image' ]; } else { $text_image_image = ''; }
			if ( isset( $instance[ 'text_image_text' ] ) ) { $text_image_text = $instance[ 'text_image_text' ]; } else { $text_image_text = ''; }
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'text_image_title' ); ?>"><?php echo __( 'Title:', 'themeText' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'text_image_title' ); ?>" name="<?php echo $this->get_field_name( 'text_image_title' ); ?>" value="<?php echo esc_attr( $text_image_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'text_image_image' ); ?>"><?php echo __( 'Image:', 'themeText' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'text_image_image' ); ?>" name="<?php echo $this->get_field_name( 'text_image_image' ); ?>" value="<?php echo esc_attr( $text_image_image ); ?>" />
				<span style="display: inline-block; font-size: 11px; color: #666666; margin-top: 5px;"><?php echo __( 'Specify an image address of your image (http://example.com/logo.png)', 'themeText' ); ?></span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'text_image_text' ); ?>"><?php echo __( 'Text:', 'themeText' ); ?></label>
				<textarea id="<?php echo $this->get_field_id( 'text_image_text' ); ?>" name="<?php echo $this->get_field_name( 'text_image_text' ); ?>" class="widefat" style="outline: none; resize: none; width: 100%" rows="5" cols="50"><?php echo esc_attr( $text_image_text ); ?></textarea>
			</p>
		<?php
		}

	}

	add_action( 'widgets_init', create_function( '', 'register_widget( "footer_text_image_widget" );' ) );

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
?>