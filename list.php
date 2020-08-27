<?php
/**
 * Plugin Name: Users Listing
 * Plugin URI: https://google.com/
 * Description: Lists the users in frontend for admin only.
 * Version: 1.1.0.1
 * Author: Intern
 * Author URI: https://Stackoverflow.com
 * Text Domain: users-listing
 * Domain Path: /languages/
 *
 * @package UserListing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
add_action('init', 'fn_to_add_shortcode');
function fn_to_add_shortcode(){
	add_shortcode('my-table', 'fn_to_create_table');
	add_action('wp_enqueue_scripts', 'vb_register_user_scripts');
	add_action('wp_ajax_register_user_front_end', 'register_user_front_end_v');
    add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end_v');
}
function fn_to_create_table(){
	$user = wp_get_current_user();
	$roles = ( array ) $user->roles;
	if( ! is_user_logged_in() or ! ($roles['0'] == 'administrator') )
        {
			printf("Restricted");
			die;
		}
	include_once dirname( __FILE__ ) . '/table-in-front-end.php';
}
function vb_register_user_scripts() {
    // Enqueue script
    wp_register_script('my_script', plugins_url() . '/list/my.js', array('jquery'), '1.2.3', false);
    wp_enqueue_script('my_script');
     wp_localize_script( 'my_script', 'my_scripts', array(
           'my_ajax_url' => admin_url( 'admin-ajax.php' ),
         )
     );
	}
	function register_user_front_end_v() {
		$my_role = $_POST['my_role'];
		$my_order = $_POST['my_order'];
		$order_by = $_POST['order_by'];
		global $wpdb;
		$args = array(
			'role'    => $my_role,
			'order'   => $my_order,
			'orderby' => $order_by,
		);
		$authors = $wpdb->get_results('SELECT wp_users.user_login, wp_users.display_name,  "'.$args['role'].'" as meta_value 
		FROM wp_users INNER JOIN wp_usermeta 
		ON wp_users.ID = wp_usermeta.user_id 
		WHERE wp_usermeta.meta_key = "wp_capabilities" 
		AND wp_usermeta.meta_value LIKE "%'.$args['role'].'%" ORDER BY '.$args['orderby'].' '.$args['order'].' ');


	// Rendering the result to Ajax
$data = [];
foreach ( $authors as $message ) {
    $data[] = $message;
}
error_log(print_r($data, true));
echo json_encode($data);
exit;
		}
