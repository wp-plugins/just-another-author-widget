<?php
/*
Plugin Name: Just Another Author Widget
Plugin URI: http://blog.tommyolsen.net/category/programming/wp-prog/
Description: Shows information about the Post author in the Widget Area
Version: 0.2.5
Author: Tommy Stigen Olsen
Author URI: http://blog.tommyolsen.net
License: BSD
*/
?>
<?php
function showauthor_widget($args)
{
	if(is_single())
	{
		$starttime = microtime(true);
		global $authordata;
		$options = get_option('showauthor_widget');
		
		$disablees = explode(",", $options['disabled_users']);
		
		foreach($disablees as $user)
		{
			if($user == $authordata->user_login)
				return;
			if($user == $authordata->ID)
				return;
		}
		
		
		// Finding plugin install dir,
		$dir = ABSPATH . 'wp-content/plugins/just-another-author-widget/';
		$content = file_get_contents($dir . "template_widget.html");
		
		/*
		
		
		
		
		*/
		// Show the content
		//
		
		$parg = array();	// Replace arguments in here
		
		$parg['title'] = $options['title'];
		$parg['author'] = $authordata->display_name;
		
		// IF DISPLAY IMG
		if($options['display_img'])
			$parg['image'] = get_avatar($authordata->ID, $options['avatar_size']);
			
		// IF DISPLAY PROFILE
		if($options['display_profile'])
			$parg['shortprofile'] = summary_trim(get_the_author_description($authordata->ID), $options['profile_length'], "...");
		else
			$parg['shortprofile'] = "";
		
		// Dispaly author website link
		if($options['display_author_webpage_link'])
		{
			$link = get_the_author_url($authordata->ID); 
			$text = $options['text_link'];
			if($link != "")
			{
				$parg['webpagelink'] = '<a href="' . $link . '">' . $text . '</a>';
			}
			else
				$parg['webpagelink'] = "";
		}
		else
			$parg ['webpagelink'] = '';
			
		// Dispaly author website link
		if($options['display_author_profile_link'])
		{
			$link = get_author_link(false, $authordata->ID);
			$text = $options['text_author'];
			if($link != "")
			{
				$parg['profilelink'] = '<a href="' . $link . '">' . $text . '</a>';
			}
			else
				$parg['profilelink'] = "";
		}
		else
			$parg ['profilelink'] = '';
			
		// POSTCOUNTER
		if($options['enable_tag_postcount'])	$parg['postcount'] = get_usernumposts($authordata->ID);
		if($options['enable_tag_profile'])		$parg['fullprofile'] = get_the_author_description($authordata->ID);
		if($options['enable_tag_site-url'])		$parg['webpageurl'] = get_the_author_url($authordata->ID);
		if($options['enable_tag_site-text'])	$parg['webpagetext'] = $options['text_link'];
		if($options['enable_tag_profile-url'])	$parg['profileurl'] = get_author_link(false, $authordata->ID);
		if($options['enable_tag_profile-text'])	$parg['profiletext'] = $options['text_author'];
		If($options['enable_tag_authorfullname']) $parg['authorfullname'] = get_the_author_firstname($authordata->ID) . " " . get_the_author_lastname($authordata->ID);
			
		// Start parsing $parg
		$key_ar = array_keys($parg);
		foreach($key_ar as $key)
			$content = str_replace("[" . strtoupper($key) . "]", $parg[$key], $content);
		
			
		/*
		
		
		
		
		
		
		*/
		echo $content;
		
		
		$endtime = microtime(true);
		if($options['microtime'])
		{
			$options['microtime_stored_time'] = $endtime - $starttime;
			update_option('showauthor_widget', $options);
		}
	}
}
function summary_trim($text, $length = 100, $trimend = "...")
{
	$ret = "";
	$length = $length - sizeof($trimend);
	
	if(sizeof($text >= $length))
		return substr($text, 0, $length) . $trimend;
	else
		return $text;
}
function showauthor_widget_control()
{
	$options = $newoptions = get_option('showauthor_widget'); // get options
  
	// set new options
	if( $_POST['jaaw-submit'] ) {
		$newoptions['title'] = strip_tags( stripslashes($_POST['jaaw-title']) );		
		$newoptions['profile_length'] = strip_tags(stripslashes($_POST['jaaw-profile_length']));
		$newoptions['text_link'] = strip_tags(stripslashes($_POST['jaaw-text_link']));
		$newoptions['text_author'] = strip_tags(stripslashes($_POST['jaaw-text_author']));
		$newoptions['avatar_size'] = strip_tags(stripslashes($_POST['jaaw-avatar_size']));
		$newoptions['disabled_users'] = strip_tags(stripslashes($_POST['jaaw-disabled_users']));
		
		// Show Image 
		if($_POST['jaaw-display_img'])					$newoptions['display_img'] = true;
		else											$newoptions['display_img'] = false;
		
		if($_POST['jaaw-display_profile'])				$newoptions['display_profile'] = true;
		else											$newoptions['display_profile'] = false;
 		
		if($_POST['jaaw-display_author_webpage_link'])	$newoptions['display_author_webpage_link'] = true;
		else											$newoptions['display_author_webpage_link'] = false;
		
		if($_POST['jaaw-display_author_profile_link'])	$newoptions['display_author_profile_link'] = true;
		else											$newoptions['display_author_profile_link'] = false;
		
		if($_POST['jaaw-display_im_icons'])				$newoptions['display_im_icons'] = true;
		else											$newoptions['display_im_icons'] = false;
		
		if($_POST['jaaw-enable_tag_postcount'])			$newoptions['enable_tag_postcount'] = true;
		else											$newoptions['enable_tag_postcount'] = false;	
				
		if($_POST['jaaw-enable_tag_profile'])			$newoptions['enable_tag_profile'] = true;
		else											$newoptions['enable_tag_profile'] = false;		
			
		if($_POST['jaaw-enable_tag_site-url'])			$newoptions['enable_tag_site-url'] = true;
		else											$newoptions['enable_tag_site-url'] = false;
		
		if($_POST['jaaw-enable_tag_site-text'])			$newoptions['enable_tag_site-text'] = true;
		else											$newoptions['enable_tag_site-text'] = false;
		
		if($_POST['jaaw-enable_tag_profile-url'])		$newoptions['enable_tag_profile-url'] = true;
		else											$newoptions['enable_tag_profile-url'] = false;
		
		if($_POST['jaaw-enable_tag_profile-text'])		$newoptions['enable_tag_profile-text'] = true;
		else											$newoptions['enable_tag_profile-text'] = false;
		
		if($_POST['jaaw-enable_tag_authorfullname'])	$newoptions['enable_tag_authorfullname'] = true;
		else											$newoptions['enable_tag_authorfullname'] = false;	
		
		if($_POST['jaaw-microtime'])					$newoptions['microtime'] = true;
		else											$newoptions['microtime'] = false;	

	}
  
	// update options if needed
	if( $options != $newoptions ) {
		$options = $newoptions;
		update_option('showauthor_widget', $options);
	}
  	
  	// Output starts here
  	$dir = ABSPATH . 'wp-content/plugins/just-another-author-widget/';
	
	// Sets nececary values.	
	$print_args = array();
	$print_content = file_get_contents($dir . "template_controlpanel.html");
	
	
	/*
	
	
	
	
	
	*/	
	// Adds to replace queue
	//
	// Replace Queue starts here
	$print_args['title'] = $options['title'];
	$print_args['profilelength'] = $options['profile_length'];
	$print_args['textlink'] = $options['text_link'];
	$print_args['textauthor'] = $options['text_author'];
	$print_args['avatarsize'] = $options['avatar_size'];
	$print_args['disabledusers'] = $options['disabled_users'];
	// Display IMG
	$print_args['displayimg'] = "";
	if($options['display_img'])
		$print_args['displayimg'] = "checked";
	
	// Display display_author_webpage_link
	$print_args['displaywebpage'] = "";
	if($options['display_author_webpage_link'])
		$print_args['displaywebpage'] = "checked";
		
	// Display display_author_profile_link
	$print_args['displayauthorprofilelink'] = "";
	if($options['display_author_profile_link'])
		$print_args['displayauthorprofilelink'] = "checked";
		
	// Display IM Strip
	$print_args['displayimicons'] = "";
	if($options['display_im_icons'])
		$print_args['displayimicons'] = "checked";
			
	// Display display_profile
	$print_args['displayprofile'] = "";
	if($options['display_profile'])
		$print_args['displayprofile'] = "checked";
	
	// ENABLE TAG POST COUNT	
	$print_args['enabletagpostcount'] = "";
	if($options['enable_tag_postcount'])
		$print_args['enabletagpostcount'] = "checked";
	
	// ENABLE TAG PROFILE	
	$print_args['enabletagprofile'] = "";
	if($options['enable_tag_profile'])
		$print_args['enabletagprofile'] = "checked";
		
	// ENABLE TAG SITE URL
	$print_args['enabletagsiteurl'] = "";
	if($options['enable_tag_site-url'])
		$print_args['enabletagsiteurl'] = "checked";
		
	// ENABLE TAG SITE TEXT
	$print_args['enabletagsitetext'] = "";
	if($options['enable_tag_site-text'])
		$print_args['enabletagsitetext'] = "checked";

	// ENABLE TAG PROFILE URL
	$print_args['enabletagprofileurl'] = "";
	if($options['enable_tag_profile-url'])
		$print_args['enabletagprofileurl'] = "checked";

	// ENABLE TAG PROFILE TEXT
	$print_args['enabletagprofiletext'] = "";
	if($options['enable_tag_profile-text'])
		$print_args['enabletagprofiletext'] = "checked";
	
	$print_args['enabletagauthorfullname'] = "";
	if($options['enable_tag_authorfullname'])
		$print_args['enabletagauthorfullname'] = "checked";

	// MICROTIME
	$print_args['microtimechecked'] = "";
	if($options['microtime'])
		$print_args['microtimechecked'] = "checked";
	
	$print_args['microtimer'] = "";
	if($options['microtime'])
		$print_args['microtimer'] = $options['microtime_stored_time'];
	/*
	
	
	
	
	*/
	$key_ar = array_keys($print_args);
	foreach ($key_ar as $key)
	{
		$print_content = str_replace('[' . strtoupper($key) . ']', $print_args[$key], $print_content);
	}

	echo $print_content;
	return;
}
function showauthor_activate()
{
	// Options, Default Values
	$options = array(
		'widget' => array(
			'title' => 'About Author',
			'display_img' => true,
			'display_author_webpage_link' => true,
			'display_author_profile_link' => true,
			'display_im_icons' => false,
			'display_profile' => true,
			'profile_length' => 150,
			'text_link' => "Author's Webpage",
			'text_author' => "Author's Profile",
			'enable_tag_postcount' => true,
			'enable_tag_profile' => true,
			'enable_tag_site-url' => true,
			'enable_tag_site-text' => true,
			'enable_tag_profile-url' => true,
			'enable_tag_profile-text' => true,
			'enable_tag_authorfullname' => true,
			'avatar_size' => 96,
			'microtime' => false,
			'disabled_users' => ''
	  		)
	  	);
	 add_option("showauthor_widget", $options['widget']);
	 
	 // Load the backuped template!
	 
	 $used_template_path = ABSPATH . 'wp-content/plugins/just-another-author-widget/widget_template.html';
	 $saved_template_path = ABSPATH . 'wp-content/plugins/just-another-author-widget/saved_template.html';
	 if( file_exists($saved_template_path) )
	 {
	 	/*if(!copy($saved_template_path, $used_template_path))
	 	{
	 		echo 'JAAW failed to copy the saved template, you must do so yourself!';
	 	}
	 	else
	 	{
	 		unlink($saved_template_path);
	 	}*/
	 	
	 }
	 
	 return;
}
function showauthor_deactivate()
{
	// Delete Widget
	delete_option("showauthor_widget");
	
	// Backup the widget_template.html file.
	
	$used_template_path = ABSPATH . 'wp-content/plugins/just-another-author-widget/widget_template.html';
	$saved_template_path = ABSPATH . 'wp-content/plugins/just-another-author-widget/saved_template.html';
	if(!copy($used_template_path, $saved_template_path))
	{
		echo 'JAAW was unable to backup the used widget_template.html, you might want to do so yourself!';
	}
	
	
	return;
}
function showauthor_init()
{
	$class['classname'] = 'showauthor_widget';
	wp_register_sidebar_widget('tommy_show_author', __('Just Another Author Widget'), 'showauthor_widget', $class);
  	wp_register_widget_control('tommy_show_author', __('Just Another Author Widget'), 'showauthor_widget_control', 'width=200&height=200');
  
	
	return; 
}
function showauthor_addstyle()
{
	$style = WP_PLUGIN_URL . '/just-another-author-widget/jaaw-style.css';
    $location = WP_PLUGIN_DIR . '/just-another-author-widget/jaaw-style.css';

	if( file_exists($location) )
	{
        wp_register_style('template', $style);
        wp_enqueue_style( 'template');

	}	
}
// ACTIONS
add_action('activate_'.plugin_basename(__FILE__), 'showauthor_activate');
add_action('deactivate_'.plugin_basename(__FILE__), 'showauthor_deactivate');
add_action('init', 'showauthor_init');
add_action('wp_print_styles', 'showauthor_addstyle');

?>