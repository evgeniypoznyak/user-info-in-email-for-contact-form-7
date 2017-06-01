=== User Info In Email For Contact Form 7 ===
Contributors: evgeniyjunior
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MC4A5YZXGFWRG
Tags: email, cf7, cf, contact form, contact form 7, ip, user ip, user detailed info, user info, customer information, information, customer, woocomerce, order, shortcode, user address
Requires at least: 3.1
Tested up to: 4.7
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is adding the user's internet provider information (based on IP address), to the body of the email. Contact Form 7 Plugin required.


== Description ==

This plugin is adding the user's internet provider information (based on IP address), to the body of the email.

IP: [user-info-ip]
City: [user-info-city]
State: [user-info-state]
Country:[user-info-country]
Zip-Code: [user-info-zipcode]
Time-zone: [user-info-timezone]
Longitude: [user-info-lon]
Latitude: [user-info-lat] in email body.


The plugin is making an HTTP GET request. It is sending only the users IP address to the domain ip-api.com.
The request returns all the information it is finding based on that IP address.
http://ip-api.com/json/

Note!
*Contact Form 7 Plugin required.


== Installation ==

1. Install and activate Contact Form 7 Plugin
2. Upload `user-info-in-email-for-contact-form-7` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Place shortcodes in your email body CF7:
IP: [user-info-ip]
City: [user-info-city]
State: [user-info-state]
Country:[user-info-country]
Zip-Code: [user-info-zipcode]
Time-zone: [user-info-timezone]
Longitude: [user-info-lon]
Latitude: [user-info-lat]

* You can use HTML5.

== Frequently asked questions ==



== Screenshots ==

1. Place your shortcode in your contact form 7 "mail" bookmark. As showed in the screenshot. You can use any HTML tags around shortcodes.

2. And later in your email you should include user/customer information according to his/her internet provider.


== Changelog ==

= 1.0 =
* Initial release


== Upgrade notice ==

