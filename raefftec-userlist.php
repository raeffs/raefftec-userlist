<?php
/*
Plugin Name: RaeffTec Userlist
Version:     1.0.0
Author:      Raphael Fleischlin
License:     GPLv2
*/

function raefftec_userlist() {

	$users = get_users(array(
		'meta_key' => 'last_name',
		'orderby' => 'meta_value'
	));

	$fields = array(
		'avatar' => '',
		'user_lastname' => __('Lastname', 'raefftec-userlist'),
		'user_firstname' => __('Firstname', 'raefftec-userlist'),
		'address' => __('Address', 'raefftec-userlist'),
		'zip' => __('ZIP', 'raefftec-userlist'),
		'city' => __('City', 'raefftec-userlist'),
		'user_email' => __('E-Mail', 'raefftec-userlist'),
	);

	$content = '<table id="raefftec_userlist">';
	$content = $content . '<thead>';
	$content = $content . '<tr>';

	foreach ($fields as $key => $value) {

		$content = $content . '<th class="' . $key . '">' . $value . '</th>';

	}

	$content = $content . '</tr>';
	$content = $content . '</thead>';
	$content = $content . '<tbody>';

	foreach ($users as $user) {
		
		$content = $content . '<tr>';

		foreach ($fields as $key => $value) {

			$content = $content . '<td class="' . $key . '">';
			if ($key == 'avatar') {
				$content = $content . get_avatar ($user->ID);
			} else {
				$content = $content . get_the_author_meta($key, $user->ID);
			}
			$content = $content . '</td>';

		}

		$content = $content . '</tr>';

	}

	$content = $content . '</tbody>';
	$content = $content . '</table>';

	return $content;

}

add_shortcode('raefftec_userlist', 'raefftec_userlist');

function raefftec_load_textdomain() {
	load_plugin_textdomain('raefftec-userlist', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

add_action('plugins_loaded', 'raefftec_load_textdomain');

function raefftec_styles() {
	echo '<link href="' . get_bloginfo('wpurl') . '/' . PLUGINDIR . '/raefftec-userlist/raefftec-userlist.css" rel="stylesheet" type="text/css" />';
}

add_action('wp_head', 'raefftec_styles');
