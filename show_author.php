<?php
/*
Plugin Name: Just Another Author Widget
Plugin URI: http://blog.tommyolsen.net/category/programming/wp-prog/
Description: Shows information about the Post author in the Widget Area
Version: 0.1.1
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
		global $authordata;
		
		// Get saved Option Value
		$options = get_option('showauthor_widget');
		
		$dir = ABSPATH . 'wp-content/plugins/show_author/';
		$content = file_get_contents($dir . "widget_template.html");
		
		// Replacing markers in the included text with data
		
		// Replacing :__TITLE__
		if($options['title'] != "")
			$content = str_replace("__TITLE__", '<h4>' . $options['title'] . '</h4>', $content);
		else
			$content = str_replace("__TITLE__", "", $content);
			
		// Replacing __AUTHOR_NAME__
			$author_display = $authordata->display_name;
			$content = str_replace("__AUTHOR_NAME__", $author_display, $content);
		
		// Replacing __IMAGE__
		if($options['show_image'])
			$content = str_replace("__IMAGE__", get_avatar($authordata->ID, 96), $content);
		else
			$content = str_replace("__IMAGE__", "", $content);
		
		// Replacing __TEXT__
		if($options['show_text'])
			$content = str_replace("__TEXT__", summary_trim(get_the_author_description($authordata->ID), $options['charlimit']), $content);
		else
			$content = str_replace("__TEXT__", "", $content);
		
		// Replacing __READMORE__
		$content = str_replace("__READMORE__", '<a href="/author/' . get_the_author_login($authordata->ID) . '">'. $options['moretext'] . '</a>', $content);
		
		// Replacing __WEBSITE__ 
		$url = get_the_author_url($authordata->ID);
		if($url != "" && $options['show_website'])
		{
			$content = str_replace("__WEBSITE__", '<a href="'.$url.'">' . $options['websitelinktext'] . '</a>', $content);
		}
		else
			$content = str_replace("__WEBSITE__", "", $content);
		
		// Show the content
		echo $content;
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
	if( $_POST['show_author-widget-submit'] ) {
		$newoptions['title'] = strip_tags( stripslashes($_POST['show_author-widget-title']) );		
		$newoptions['readfulltext'] = strip_tags( stripslashes($_POST['show_author-widget-readfulltext']) );
		$newoptions['moretext'] = $_POST['show_author-widget-moretext'];
		$newoptions['websitetext'] = $_POST['show_author-widget-websitetext'];
		$newoptions['charlimit'] = strip_tags( stripslashes($_POST['show_author-widget-charlimit']) );
		$newoptions['websitelinktext'] = strip_tags( stripslashes($_POST['show_author-widget-websitelinktext']) );
		
		// Show Image 
		if($_POST['show_author-show_image'])
			$newoptions['show_image'] = true;
		else
			$newoptions['show_image'] = false;
		
		if($_POST['show_author-show_text'])
			$newoptions['show_text'] = true;
		else
			$newoptions['show_text'] = false;
		if($_POST['show_author-show_website'])
			$newoptions['show_website'] = true;
		else
			$newoptions['show_website'] = false;
	}
  
	// update options if needed
	if( $options != $newoptions ) {
		$options = $newoptions;
		update_option('showauthor_widget', $options);
	}
  	
  	// Utgang
  	echo '<p>'._e('Title');
  		echo '<input type="text" style="width:220px" id="show_author-widget-title" name="show_author-widget-title" value="'. $options['title'].'" />';
	echo '</p>';
  	echo '<p>'._e('Display Options');
  	
  	// Show Image Checkbox
  	$checked = "";
  	if($options['show_image'])
  		$checked = "checked";
  	echo '<input type="checkbox" name="show_author-show_image" id="show_author-show_image" value="true" ' . $checked . '/>Show Image/Avatar<br />';
  	
  	// Show Text Checkbox
  	$checked = "";
  	if($options['show_text'])
  		$checked = "checked";
  	echo '<input type="checkbox" name="show_author-show_text" id="show_author-show_text" value="true" ' . $checked . '/>Show Summary Text<br />';
	
	// Show Website Checkbox
  	$checked = "";
  	if($options['show_website'])
  		$checked = "checked";
  	echo '<input type="checkbox" name="show_author-show_website" id="show_author-show_website" value="true" ' . $checked . '/>Show Author Website link Text';
	echo '</p>';
	
	echo '<p>'._e('More Text');
		echo '<input type="text" style="width:220px" id="show_author-widget-moretext" name="show_author-widget-moretext" value="'. $options['moretext'].'" />';
	echo '</p>';
	echo '<p>'._e('Summary trim text');
		echo '<input type="text" style="width:220px" id="show_author-widget-readfulltext" name="show_author-widget-readfulltext" value="'. $options['readfulltext'].'" />';
	echo '</p>';
	echo '<p>'._e('Link Description Text').'<input type="text" style="width:220px" id="show_author-widget-websitelinktext" name="show_author-widget-websitelinktext" value="' . $options['websitelinktext'] .'" />';
	echo '</p>';
	echo '<p>'._e('Max Summary Length');
		echo '<input type="text" style="width:220px" id="show_author-widget-charlimit" name="show_author-widget-charlimit" value="'. $options['charlimit'].'" />';
	echo '</p>';
	echo '<p>'._e('<b>NB</b>');
	echo 'To modify the look of the widget, use the editor to edit the widget_template.html!';
	echo '<input type="hidden" id="show_author_widget-submit" name="show_author-widget-submit" value="1" />';

	return;
}
function showauthor_activate()
{
	// Options, Default Values
	$options = array(
		'widget' => array(
			'title' => 'About Author',
	  		'moretext' => 'More posts by the Author',
	  		'readfulltext' => '...',
	  		'charlimit' => 150,
	  		'show_image' => true,
	  		'show_text' => true,
	  		'show_website' => true,
	  		'websitelinktext' => 'Here',
	  		'websitetext' => 'Website: __LINK__'
	  		)
	  	);
	 
	 // Register Widget
	 add_option("showauthor_widget", $options['widget']);
	 // Widget Registered
	 
	 return;
}
function showauthor_deactivate()
{
	delete_option("showauthor_widget");
	return;
}
function showauthor_init()
{
	$class['classname'] = 'showauthor_widget';
	wp_register_sidebar_widget('tommy_show_author', __('Just Another Author Widget'), 'showauthor_widget', $class);
  	wp_register_widget_control('tommy_show_author', __('Just Another Author Widget'), 'showauthor_widget_control', 'width=200&height=200');
  
	
	return; 
}

// ACTIONS
add_action('activate_'.plugin_basename(__FILE__), 'showauthor_activate');
add_action('deactivate_'.plugin_basename(__FILE__), 'showauthor_deactivate');
add_action('init', 'showauthor_init');
?>