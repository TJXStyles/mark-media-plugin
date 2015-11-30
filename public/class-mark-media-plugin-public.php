<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.jackcooc.com
 * @since      1.0.0
 *
 * @package    Mark_Media_Plugin
 * @subpackage Mark_Media_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mark_Media_Plugin
 * @subpackage Mark_Media_Plugin/public
 * @author     Jack <jackc@markmedia.co>
 */
class Mark_Media_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		 $this->mark_media_options = get_option($this->plugin_name);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mark_Media_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mark_Media_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mark-media-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mark_Media_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mark_Media_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mark-media-plugin-public.js', array( 'jquery' ), $this->version, false );

	}

  // Add post/page slug
  public function mark_media_body_class_slug( $classes ) {
	  if(!empty($this->mark_media_options['body_class_slug'])){
	    global $post;
	    if( is_singular() ) {
	    //if( isset( $post ) ) {
	    	$classes[] = $post->post_type . '-' . $post->post_name;
	    }
	  }
   	return $classes;
  }

  // Load jQuery from CDN if available
  public function mark_media_cdn_jquery(){
  	if(!empty($this->mark_media_options['jquery_cdn'])){
	    if(!is_admin()){
        if(!empty($this->mark_media_options['cdn_provider'])){
          $link = $this->mark_media_options['cdn_provider'];
  			} else {
       		$link = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js';
        }
        $try_url = @fopen($link,'r');
        if( $try_url !== false ) {
        	wp_deregister_script( 'jquery' );
          wp_register_script('jquery', $link, array(), null, false);
        }
      }
    }
  }

	public function mark_media_cmf_tag( $link ) {
		if(!empty($this->mark_media_options['cmf_check'])) {
			$link = $this->mark_media_options['cmf_tag'];
		}
	  return $link;
	}

// Add Action is under includes/class-mark-media-plugin.php
}
