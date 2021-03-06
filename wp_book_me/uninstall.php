<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://github.com/flashxyz/BookMe/wiki
 * @since      1.0.0
 *
 * @package    Wp_book_me
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


drop_tables();

function drop_tables(){

	global $wpdb;

	$group_options_table = $wpdb->prefix . "bookme_group_options";
	$rooms_options_table = $wpdb->prefix . "bookme_rooms_options";
	$room_reservation_table = $wpdb->prefix . "bookme_room_reservation";
	$general_options_table = $wpdb->prefix . "bookme_general_options";

	$sql = "DROP TABLE $group_options_table";
	$wpdb->query($sql);

	$sql = "DROP TABLE $rooms_options_table";
	$wpdb->query($sql);

	$sql = "DROP TABLE $room_reservation_table";
	$wpdb->query($sql);

	$sql = "DROP TABLE $general_options_table";
	$wpdb->query($sql);

}