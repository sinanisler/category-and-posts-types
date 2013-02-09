<?php
/*
Plugin Name: Category and Posts Types
Plugin URI: https://github.com/sinanisler/
Description: This plugin add a widget to the widgets zone. You can confugire the widget for show custom category posts, custom post types posts and what you image with that. Simple and easy to use. Thanks for using.
Author: Sinan İŞLER
Version: 0.1
Author URI: http://sinanisler.com/
*/









class CategoryandPostsTypes extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'CategoryandPostsTypes', // Base ID
			'Category and Posts Types', // Name
			array( 'description' => __( 'This plugin add a widget to the widgets zone. You can confugire the widget for show custom category posts, custom post types posts and what you image with that. Simple and easy to use. Thanks for using.', 'cpt' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

			$title = $instance[ 'title' ];
			$sayi = $instance[ 'sayi' ];
			$category = $instance[ 'category' ];
			$postslug = $instance[ 'postslug' ];


            ?>	
        	
    		<li class="icerikler-sag-kutu widget CategoryandPostsTypes-widget">
            	<h2 class="widgettitle"><?php echo esc_attr($title); ?></h2>
                <ul class="icerikler-sag-kutu-icerik sondakika">
                    
					<?php  query_posts( "posts_per_page=$sayi&cat=$category&post_type=$postslug");   if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    	<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; else : endif; wp_reset_query(); ?>
                	
                </ul>
            </li>
            
            
		<?php


	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['sayi'] = strip_tags( $new_instance['sayi'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['postslug'] = strip_tags( $new_instance['postslug'] );

		return $instance;
	}

	public function form( $instance ) {
			$title = $instance[ 'title' ];
			$sayi = $instance[ 'sayi' ];
			$category = $instance[ 'category' ];
			$postslug = $instance[ 'postslug' ];
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" 
        type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category Slug or ID:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" 
        type="text" value="<?php echo esc_attr( $category ); ?>" />
        <small>For multiple category use separate by commas</small>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'postslug' ); ?>"><?php _e( 'Custom Post Type Slug:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'postslug' ); ?>" name="<?php echo $this->get_field_name( 'postslug' ); ?>" 
        type="text" value="<?php echo esc_attr( $postslug ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'sayi' ); ?>"><?php _e( 'Numbers of Posts:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'sayi' ); ?>" name="<?php echo $this->get_field_name( 'sayi' ); ?>" 
        type="text" value="<?php echo esc_attr( $sayi ); ?>" />
		</p>
		<?php 
		
	}

} 

add_action( 'widgets_init', create_function( '', 'register_widget( "CategoryandPostsTypes" );' ) );




?>