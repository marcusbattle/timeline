<?php

class Timeline_Theme {
	
	public function __construct() { 
		add_theme_support( 'post-thumbnails' ); 
		add_action( 'wp_enqueue_scripts', array( $this, 'load_styles_and_scripts' ) );
		add_theme_support( 'post-formats', array( 'status', 'aside', 'image', 'video', 'audio' ) );

		add_action( 'wp_ajax_save_post_ajax', array( $this, 'save_post_ajax' ) );
		add_action( 'wp_ajax_nopriv_save_post_ajax', array( $this, 'save_post_ajax' ) );

		// Menus
		add_action( 'init', array( $this, 'register_menus' ) );

	}

	public function load_styles_and_scripts() {
		wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'timeline', get_template_directory_uri() . '/assets/css/timeline.css' );

		wp_enqueue_script( 'timeline', get_template_directory_uri() . '/assets/js/timeline.js' , array('jquery'), '0.1.0', true );
		wp_localize_script( 'timeline', 'timeline_ajax',
            array( 
            	'ajax_url' => admin_url( 'admin-ajax.php' )
            )
        );
	}

	public function register_menus() {

		register_nav_menus(
			array(
				'main_menu' => __( 'Main Menu' ),
				'social_menu' => __( 'Social Menu' ),
				'contact_menu' => __( 'Contact Menu' )
			)
		);

	}

	public function save_post_ajax() {

		$post_title = isset( $_POST['post_title'] ) ? $_POST['post_title'] : '';
		$post_content = isset( $_POST['post_content'] ) ? $_POST['post_content'] : '';
		$featured_image = isset( $_POST['featured_image'] ) ? $_POST['featured_image'] : '';

		if ( empty( $post_content ) && empty( $featured_image ) ) {
			echo json_encode( array( 'success' => false, 'message' => 'You have to say something' ) );
			exit;
		}

		$this->save_bas64_image( $featured_image );
		exit;

		$post_args = array(
			'post_title' => $post_title,
			'post_content' => $post_content,
			'post_type' => 'post',
			'post_status' => 'publish'
		);

		$post_id = wp_insert_post( $post_args );

		if ( is_wp_error( $post_id ) ) {
			echo json_encode( array( 'success' => false, 'message' => 'There was a problem adding your post' ) );
		} else {

			$html = '
			<div id="post-template" class="post">
				<div class="content">
					<div class="text">' . $post_content . '</div>
					<div class="comment">
						<input type="text" placeholder="Leave a comment" />
					</div>
				</div>
				<div class="meta">
					<span class="gravatar"></span>
					<p><span class="highlight">author</span> posted this <span class="highlight">post_format</span> a second ago</p>
				</div>
			</div>';

			echo json_encode( array( 'success' => true, 'html' => $html ) );
		}
		
		exit;

	}

	public function save_bas64_image( $base64_image ) {
		$temp_file = download_url( $base64_image, 10 );
		print_r( $temp_file );
	}

}

$timeline_theme = new Timeline_Theme();