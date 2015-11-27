<?php
/**
* Provide a admin area view for the plugin
*
* This file is used to markup the admin-facing aspects of the plugin.
*
* @link       http://www.jackcooc.com
* @since      1.0.0
*
* @package    Mark_Media_Plugin
* @subpackage Mark_Media_Plugin/admin/partials
*/
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<form method="post" name="cleanup_options" action="options.php">
		<?php
		//Grab all options
		$options = get_option($this->plugin_name);
		// body_slug
		$body_class_slug = $options['body_class_slug'];
		$jquery_cdn = $options['jquery_cdn'];
    // $cdn_provider = $options['cdn_provider'];
		?>
		<?php
		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>
		<!-- Add slug to the body as a class "page-<slug>" -->		
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('Add Post, page or product slug to body class', $this->plugin_name); ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-body_class_slug">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-body_class_slug" name="<?php echo $this->plugin_name; ?>[body_class_slug]" value="1" <?php checked($body_class_slug, 1); ?>  />
				<span><?php esc_attr_e('Add Post slug to body class', $this->plugin_name); ?></span>
			</label>
		</fieldset>
		    <!-- load jQuery from CDN -->
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('Load jQuery from CDN instead of the basic wordpress script', $this->plugin_name); ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-jquery_cdn">
	    	<input type="checkbox"  id="<?php echo $this->plugin_name; ?>-jquery_cdn" name="<?php echo $this->plugin_name; ?>[jquery_cdn]" value="1" />
	    	<span><?php esc_attr_e('Load jQuery from CDN', $this->plugin_name); ?></span>
			</label>
      <fieldset>
      	<p>You can choose your own cdn provider and jQuery version(default will be Google CDN and version 2.1.4)-Recommended CDNs are <a href="https://cdnjs.com/libraries/jquery">CDNjs</a>, <a href="https://code.jquery.com/jquery/">jQuery official CDN</a>, <a href="https://developers.google.com/speed/libraries/#jquery">Google CDN</a> and <a href="http://www.asp.net/ajax/cdn#jQuery_Releases_on_the_CDN_0">Microsoft CDN</a></p>
        	<legend class="screen-reader-text"><span><?php _e('Choose your prefered cdn provider', $this->plugin_name); ?></span></legend>
          <input type="url" class="regular-text" id="<?php echo $this->plugin_name; ?>-cdn_provider" name="<?php echo $this->plugin_name; ?>[cdn_provider]" value=""/>
      </fieldset>
    </fieldset>
		<?php submit_button(__('Save Changes', $this->plugin_name), 'primary','submit', TRUE); ?>
	</form>
</div>