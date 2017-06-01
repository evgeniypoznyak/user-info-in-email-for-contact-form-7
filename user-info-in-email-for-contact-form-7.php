<?php
/**
 * Plugin Name: User Info In Email For Contact Form 7
 * Description: This plugin is adding user's internet provider info to email. IP: [user-info-ip], City: [user-info-city], State: [user-info-state], Country:[user-info-country], Zip-Code: [user-info-zipcode], Time-zone: [user-info-timezone], Longitude: [user-info-lon], Latitude: [user-info-lat] in email body. Contact Form 7 Plugin required.
 * Author: Evgeniy Poznyak
 * Author URI: https://wordpress.poznyaks.com/
 * Version: 1.00
 */

/*  Copyright 2016  Evgeniy Poznyak  (email: ek@35mm@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * @param $array
 *
 * @return mixed
 *
 * gets the information about user's IP address, and replaces all the data in the email body
 */
function user_info_in_email_for_cf7( $array ) {

	global $wpdb;
	$endLine = '';

	// Checking if page is HTML or comment this block to make your own style.
	if ( wpautop( $array['body'] ) == $array['body'] ) {
		$endLine = "<br/>";
	} else {
		$endLine = "\n";
	}


	// getting user IP
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$user_ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty ( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$user_ip = $_SERVER['REMOTE_ADDR'];
	}


	//cURL.
	$url = 'http://ip-api.com/json/';
	//GET REQUEST PARAMETERS
	$options = '?fields=country,regionName,city,zip,lat,lon,timezone';

	$ch      = curl_init();
	curl_setopt( $ch, CURLOPT_URL, ( $url . $user_ip . $options ) );
	curl_setopt( $ch, CURLOPT_TIMEOUT, 10 ); //timeout in seconds
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$data = curl_exec( $ch );
	$data = json_decode( $data );
	curl_close( $ch );


	// Transferring object values into variables.
	$ipData       = $endLine . $user_ip . $endLine;
	$cityData     = $endLine . $data->city . $endLine;
	$countryData  = $endLine . $data->country . $endLine;
	$stateData    = $endLine . $data->regionName . $endLine;
	$timezoneData = $endLine . $data->timezone . $endLine;
	$zipcodeData  = $endLine . $data->zip . $endLine;
	$latData      = $endLine . $data->lat . $endLine;
	$lonData      = $endLine . $data->lon . $endLine;

	// Replacing user's Shortcodes
	$array['body'] = str_replace( '[user-info-ip]', $ipData, $array['body'] );
	$array['body'] = str_replace( '[user-info-city]', $cityData, $array['body'] );
	$array['body'] = str_replace( '[user-info-state]', $stateData, $array['body'] );
	$array['body'] = str_replace( '[user-info-country]', $countryData, $array['body'] );
	$array['body'] = str_replace( '[user-info-zipcode]', $zipcodeData, $array['body'] );
	$array['body'] = str_replace( '[user-info-timezone]', $timezoneData, $array['body'] );
	$array['body'] = str_replace( '[user-info-lon]', $lonData, $array['body'] );
	$array['body'] = str_replace( '[user-info-lat]', $latData, $array['body'] );

	return $array;

}

// hooking into wpcf7_mail_components before sending email
add_filter( 'wpcf7_mail_components', 'user_info_in_email_for_cf7' );
