=== Just Another Author Information Widget ===
Contributors: Razesdark
Donate Link: http://blog.tommyolsen.net/donations/
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

1. Upload the folder and content `just-another-author-widget` to `/wp-content/plugins/` folder. 
1. Activate the plugin from the Plugins menu in the Wordpress Administrative Panel
1. Place the Widget at desired location from the Widget Menu in the Wordpress Administrative Panel

== Frequently Asked Questions ==

= How do i modify the looks of this widget? =

By modifying the widget_template.html file from the editor, you can easly modify the looks of the widget.
It is full of markers, which will be replaced with live information when shown on the website.

= What are the tags available to me? =
[TITLE]			=	Is ment to be used as the widget title, the value is set from the widget controlpanel
[AUTHOR]		=	Its value is the display name selected in authors profile
[AUTHORFULLNAME]=	First name + Last name, to ensure a nice looking widget
[IMAGE]			=	Returns the users avatar, size can be set from the control panel.
[SHORTPROFILE]	=	A Truncated version of the Biography from the authors profile, the length can be set from the widget controlpanel
[FULLPROFILE]	=	A Full version of the Biography from the authors profile
[WEBSITELINK]	=	Value is a full link to users website if he has one. If not, the value is empty. Text of link can be set from widget controlpanel
[WEBSITEURL]	=	The url to authors website
[WEBSITETEXT]	=	The value set for the website link in the widget control panel
[PROFILELINK]	=	A link to the users profile on site
[PROFILEURL]	=	A url to the users profile on the site
[PROFILETEXT]	=	The value set for the author link in the widget control panel
[POSTCOUNT]		=	The authors postcount on the site(not comments only posts)

Most of these tags can be turned on and off from the widget control panel. Turn off the ones you don't use to make it render faster.
= How do i use this piece of software =
1. Install the software
2. Open the Widget Control panel from the Administration Panel. (Appearances > Widgets)
3. Drag the Just Another Author Widget from the sidepanel.

== Screenshots ==

1. Widget in the Wild
2. Control Panel

== Changelog ==
= 0.3.1 =
* Fixed an unknown but fairly stupid error

= 0.3.0 =
* More universal design
* Code Cleanup
* Added a link to the widget-look editor.
* The Widget control panel looks very nice.
* More FAQ
= 0.2.5 =
* Added the posibility to disable widget for specified users.
* Fixed some more bugs!

= 0.2.1 =
* Fixed some bugs!

= 0.2.0 = 
* Completely new control panel
* Completely new widget backbone
* More tags to utilize in widget styling
* Microtime clock can be turned on, to time the execution of this widget.
* Tags look more like BBCode instead of using underscores

= 0.1.3 =
* Added External styles.
* Updating to new version no longer updates the widget_template, unless it really is needed.

= 0.1.2 = 
* Fixed bug that made the plugin look for the template in the wrong directory!

= 0.1.1 =
* Widget Control improvements, removed some useless controls and some inline help.

= 0.1 =
* First Release of this plugin

== Upgrade Notice == 
= 0.2 =
When you upgrade from 0.1.x to 0.2, your widget template will be replaced.
This is because the format for all tags have changed from using two underscores before and after a tag to using squared brackets like BBCodes.

= 0.1 =
None yet

