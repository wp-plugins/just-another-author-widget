=== Just Another Author Information Widget ===
Contributors: Razesdark
Donate Link: http://redcross.org
Tags: widget, author information
Requires at least: 2.0.1
Tested up to: 3.0.1
Stable tag: trunk

Just another author information widget, built to be slightly easier to modify.

== Description ==

This plugin was concieved, when i wanted the author information in my site's widget.
However, none of the existing plugins looked the way i wanted, and all of them were quite hard to modify.
So i made another one which is more versatile and easier to modify to your own liking.

== Installation ==

The installation process of this plugin is very simple.

1. Upload the folder `show_author` to `/wp-content/plugins/` folder. (show_author.php and wiget_template.html)
1. Activate the plugin from the Plugins menu in the Wordpress Administrative Panel
1. Place the Widget at desired location from the Widget Menu in the Wordpress Administrative Panel

== Frequently Asked Questions ==

= How do i modify the looks of this widget? =

By modifying the widget_template.html file from the editor, you can easly modify the looks of the widget.
It is full of markers, which will be replaced with live information when shown on the website.

__TITLE__ will be replaced with the value set in the Widget Control panel
__AUTHOR_NAME__ will be replaced with the display name set in the users profile.
__READMORE__ will generate a link to a list of the authors profile(text on the link is set from the Widget Control Panel)
__IMAGE__ will return a tag with the users image. The tag may differ, depending on what image the user uses(fb,img, gravatar)
__TEXT__ will return a short bio, max length can be set from the control panel.
__WEBSITE__ will return a link to the authors website(if he has one)

== Screenshots ==

None at this time

== Changelog ==

= 0.1.1 =
* Widget Control improvements, removed some useless controls and some inline help.
= 0.1 =
* First Release of this plugin

== Upgrade Notice == 

= 0.1 =
None yet

