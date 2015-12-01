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

	// public function mark_media_cmf_tag( $link ) {
	// 	if(!empty($this->mark_media_options['cmf_check'])) {
	// 		$link = $this->mark_media_options['cmf_tag'];
	// 		$cmf = "<script type='text/javascript'>

	// 						function udm_(a){var b='comScore=',c=document,d=c.cookie,e='',f='indexOf',g='substring',h='length',i=2048,j,k='&ns_',l='&',m,n,o,p,q=window,r=q.encodeURIComponent||escape;if(d[f](b)+1)for(o=0,n=d.split(';''),p=n[h];o<p;o++)m=n[o][f](b),m+1&&(e=l+unescape(n[o][g](m+b[h])));a+=k+"_t="+ +(new Date)+k+"c="+(c.characterSet||c.defaultCharset||"")+"&c8="+r(c.title)+e+"&c7="+r(c.URL)+"&c9="+r(c.referrer),a[h]>i&&a[f](l)>0&&(j=a[g](0,i-8).lastIndexOf(l),a=(a[g](0,j)+k+"cut="+r(a[g](j+1)))[g](0,i)),c.images?(m=new Image,q.ns_p||(ns_p=m),m.src=a):c.write("<","p","><",'img src="',a,'" height="1" width="1" alt="*"',"><","/p",">")}
	// 						udm_('http://b.scorecardresearch.com/p?c1=2&c2=14990625&application_id=133948&name=133948.mirandas-world.content&ns_site=cmf-fmc&content1=richinteractivemedia&class1=convergent.variety.mandarin&class2=website');
	// 						</script>
	// 						<noscript><p><img src='http://b.scorecardresearch.com/p?c1=2&c2=14990625' height='1' width='1' alt='*''></p></noscript>
	// 						<script type='text/javascript' language='JavaScript1.3' src='http://b.scorecardresearch.com/c2/14990625/cs.js'></script>";
	// 	}
	//   return $cmf;
	// }

	// //declutter to dashboard
	// public function mark_media_declutter() {
	// 	remove_meta_box('dashboard_primary', 'dashboard', 'post_container_1');
	// }

	public function mark_media_add_google_analytics() {
		if(!is_admin()){
			if(!empty($this->mark_media_options['ga_tag'])){
				$link = $this->mark_media_options['ga_tag'];
				$string = strval($link);
				$analytics = "<script type='text/javascript'>
				var _gaq = _gaq || [];
				_gaq.push(['_setAccount','" . $string . "']);
				_gaq.push(['_setDomainName', 'none']);
				_gaq.push(['_setAllowLinker', true]);
				_gaq.push(['_trackPageview']);
				(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				})();
				</script>";
			echo $analytics;
		} else {
			echo "Add Google Analytics code";
		}
	}
}

public function mark_media_add_cmf_tag() {
	if(!empty($this->mark_media_options['cmf_tag'])){
		$link = $this->mark_media_options['cmf_tag'];
		echo $cmf;
	} else { ?>
		<script type='text/javascript'></script>
	<?php 
	}
}

public function mark_media_add_typekit() {
	if(!is_admin()) {
		if(!empty($this->mark_media_options['typekit'])) { 
			$link = $this->mark_media_options['typekit'];
			$matches = array();
			$pattern = preg_match( '/".*?"/', $link, $matches );
			$title = $matches[0];
			?>
			<script src="<?php echo esc_url($title); ?>"></script>
			<script>try{Typekit.load({ async: true });}catch(e){}</script>
		<?php
		} else { ?>
			<script ="text/javascript" src="http://www.google.com">
		<?php }
	}
}
}
