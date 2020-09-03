<?php
/**
 * Plugin Name: User Listing
 * Plugin URI: https://google.com/
 * Description: Lists the users in frontend for admin only.
 * Version: 1.1.0.1
 * Author: Intern
 * Author URI: https://Stackoverflow.com
 * Text Domain: user-listing
 * Domain Path: /languages/
 *
 * @package UserListing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class UserListing{
	public function __construct()
	{
		add_action('init', array($this, 'ul_add_shortcode'));		
	}
	public function ul_add_shortcode(){
		add_shortcode('my-table', array($this, 'ul_to_create_table'));
		add_action('wp_enqueue_scripts', array($this, 'ul_enqueue_scripts'));
		add_action('wp_ajax_ul_listing_users_in_frontend', array($this, 'ul_showusers_ajax_request'));
		add_action('wp_ajax_nopriv_ul_listing_users_in_frontend', array($this, 'ul_showusers_ajax_request'));
	} 
	public function ul_to_create_table(){
		$user = wp_get_current_user();
		$roles = ( array ) $user->roles;
		if( ! is_user_logged_in() || ! ($roles['0'] == 'administrator') )
			{
				_e('Restricted', 'user-listing');
				die;
			}
			ob_start();
		include_once dirname( __FILE__ ) . '/table-in-front-end.php';
		return ob_get_clean();
	}
	public function ul_enqueue_scripts() {
		// Enqueue script
		wp_enqueue_style('ul_style', plugins_url().'/user-listing/assets/css/style.css');
		wp_register_script('ul_script', plugins_url().'/user-listing/assets/js/script.js' , array('jquery'), '1.2.3', false);
		wp_enqueue_script('ul_script');
		wp_localize_script( 'ul_script', 'ul_scripts', array(
			   'ul_ajax_url' => admin_url( 'admin-ajax.php' ),
			   'security' => wp_create_nonce( 'ul-nonce' ),
		)
		 );
		}
	public function ul_showusers_ajax_request() {
		check_ajax_referer('ul-nonce', 'security');
		$my_role = sanitize_key($_POST['my_role']);
		$my_order = sanitize_key($_POST['my_order']);
		$order_by = sanitize_key($_POST['order_by']);
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

		if ($authors){		
				header("Content-Type: text/json");	
				wp_send_json_success($authors);
			}
		else{	
			wp_send_json_error("Error");
					}
	
		}

}
new UserListing();

	