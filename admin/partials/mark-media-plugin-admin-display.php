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
<h2><?php esc_attr_e( 'Function Options', 'wp_admin_style' ); ?></h2>
<h2 class="nav-tab-wrapper">
	<a href="#tab-1" class="nav-tab"><?php _e('Start up Options', $this->plugin_name);?></a>
	<a href="#tab-2" class="nav-tab"><?php _e('Login Options', $this->plugin_name);?></a>
</h2>

<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<form method="post" name="cleanup_options" action="options.php">
		<?php
		//Grab all options
		$options = get_option($this->plugin_name);
		// body_slug
		$body_class_slug = $options['body_class_slug'];
    $jquery_cdn = $options['jquery_cdn'];
    $cdn_provider = $options['cdn_provider'];
    $cmf_check = $options['cmf_check'];
    $cmf_tag = $options['cmf_tag'];
    // $ga_check = $options['ga_check'];
    $ga_tag = $options['ga_tag'];
    $typekit = $options['typekit'];
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
			<legend class="screen-reader-text"><span><?php _e('Load jQuery from CDN instead of the basic wordpress script', $this->plugin_name);?></span></legend>
			<label for="<?php echo $this->plugin_name;?>-jquery_cdn">
				<input type="checkbox"  id="<?php echo $this->plugin_name;?>-jquery_cdn" name="<?php echo $this->plugin_name;?>[jquery_cdn]" value="1" <?php checked($jquery_cdn,1);?>/>
				<span><?php esc_attr_e('Load jQuery from CDN', $this->plugin_name);?></span>
			</label>
			<fieldset class="<?php if(1 != $jquery_cdn) echo 'hidden';?>">
				<p><small>You can choose your own cdn provider and jQuery version(default will be Google CDN and version 1.11.3)-Recommended CDN are <a href="https://cdnjs.com/libraries/jquery">CDNjs</a>, <a href="https://code.jquery.com/jquery/">jQuery official CDN</a>, <a href="https://developers.google.com/speed/libraries/#jquery">Google CDN</a> and <a href="http://www.asp.net/ajax/cdn#jQuery_Releases_on_the_CDN_0">Microsoft CDN</a></small></p>
				<legend class="screen-reader-text"><span><?php _e('Choose your prefered cdn provider', $this->plugin_name);?></span></legend>
				<input type="url" class="large-text" id="<?php echo $this->plugin_name;?>-cdn_provider" name="<?php echo $this->plugin_name;?>[cdn_provider]" value="<?php if(!empty($cdn_provider)) echo $cdn_provider; ?>" placeholder="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"/>
			</fieldset>
		</fieldset>
		<fieldset>

		<!-- CMF Tag -->
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('Add CMF Tag', $this->plugin_name);?></span></legend>
			<label for="<?php echo $this->plugin_name;?>-cmf_check">
				<input type="checkbox"  id="<?php echo $this->plugin_name;?>-cmf_check" name="<?php echo $this->plugin_name;?>[cmf_check]" value="1" <?php checked($cmf_check,1);?>/>
				<span><?php esc_attr_e('Add Google Analytics', $this->plugin_name);?></span>
			</label>
			<fieldset class="<?php if(1 != $cmf_check) echo 'hidden';?>">
				<p><small>Add a CMF Tag here</p>
				<legend class="screen-reader-text"><span><?php _e('Add CMF Code', $this->plugin_name);?></span></legend>
				<textarea cols="80" rows="10" id="<?php echo $this->plugin_name;?>-cmf_tag" name="<?php echo $this->plugin_name;?>[cmf_tag]"><?php if(!empty($cmf_tag)) echo esc_attr($cmf_tag);?></textarea>
			</fieldset>
		</fieldset>


		<!-- Google Anaytics -->
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('Add Google Analytics Code', $this->plugin_name);?></span></legend>
			<p>Add Google Analytics code here:</p>
			<input type="text" id="<?php echo $this->plugin_name;?>-ga_tag" name="<?php echo $this->plugin_name;?>[ga_tag]" value="<?php if(!empty($ga_tag)) echo esc_attr($ga_tag);?>">
		</fieldset>

		<!-- Typekit script -->
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('Add Typekit', $this->plugin_name);?></span></legend>
			<p>Paste Typekit embed code here</p>
			<textarea cols="80" rows="10" id="<?php echo $this->plugin_name;?>-typekit" name="<?php echo $this->plugin_name;?>[typekit]"><?php if(!empty($typekit)) echo $typekit;?></textarea>
		</fieldset>


		<?php submit_button(__('Save Changes', $this->plugin_name), 'primary','submit', TRUE); ?>
	</form>
</div>