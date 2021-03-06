<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/flashxyz/BookMe/wiki
 * @since      1.0.0
 *
 * @package    Wp_book_me
 * @subpackage Wp_book_me/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_book_me
 * @subpackage Wp_book_me/admin
 * @author     nirbm, hudeda, rotemsd, flashxyz, liorsap1 <flashxyz@gmail.com>
 */
class Wp_book_me_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_book_me_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_book_me_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		/*wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp_book_me-admin.css', array(), $this->version, 'all' );*/
		if ( 'toplevel_page_wp_book_me' == get_current_screen() -> id ) {
	             // CSS stylesheet for Color Picker
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp_book_me-admin.css', array( 'wp-color-picker'  ), $this->version, 'all' );
			wp_enqueue_style( 'jquery.timepicker', plugin_dir_url( __FILE__ ) . 'css/jquery.timepicker.css', array( 'wp-color-picker' ), $this->version, 'all' );
	         }

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_book_me_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_book_me_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		/*wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp_book_me-admin.js', array( 'jquery' ), $this->version, false );*/
	        if ( 'toplevel_page_wp_book_me' == get_current_screen() -> id ) {
				
	            wp_enqueue_media();
	            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp_book_me-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false);
				wp_enqueue_script( 'jquery.timepicker.min', plugin_dir_url( __FILE__ ) . 'js/jquery.timepicker.min.js', array( 'jquery'), $this->version, false);
				//added validation jQuery script
				wp_enqueue_script( 'jquery.validate.min', plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', array( 'jquery'), $this->version, false);
				wp_enqueue_script( 'jquery-2.2.4.min', plugin_dir_url( __FILE__ ) . 'js/jquery-2.2.4.min.js', array( 'jquery'), $this->version, false);
				wp_enqueue_script( 'jquery-ui-1.10.4.custom.min', plugin_dir_url( __FILE__ ) . 'js/jquery-ui-1.10.4.custom.min.js', array( 'jquery'), $this->version, false);

			}
	}

	public function add_plugin_admin_menu() {

		
		//Add a settings page for this plugin to the Settings menu.
		add_menu_page( 'WP BookMe Options Functions Setup', 'WP BookMe', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'), plugins_url('wp_book_me/admin/css/bookme_icon.png'));
	}

	/**
	* Add settings action link to the plugins page.
	*
	* @since    1.0.0
	*/
 
	public function add_action_links( $links ) {
		/*
		*  	Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',);
		return array_merge(  $settings_link, $links );

	}

	/**
	* Render the settings page for this plugin.
	*
	* @since    1.0.0
	*/
 
	public function display_plugin_setup_page() {

		if($_GET['group_id'] == false and $_POST['group_id'] == false)
		{	
			include_once( 'partials/wp_book_me-admin-display.php' );
		}
		if($_GET['group_id'] == true AND $_GET['delete'] == true)
		{

			require_once('partials/delete-group.php');
			require_once('partials/wp_book_me-admin-display.php');

		}
		if($_GET['group_id']==true  AND @$_GET['edit_group'] == true )
		{
			require_once('partials/edit-group.php');
		}
		if($_GET['group_id']==true AND $_GET['create_group']==true AND @$_GET['edit_group'] == true )
		{
			require_once('partials/create-group.php');
			require_once('partials/edit-group.php');
		}
		if($_GET['group_id']==true AND $_GET['save_options']==true)
		{
			require_once('partials/save-options.php');
		}
		if($_GET['group_id']==true AND $_GET['edit_rooms']==true)
		{
			require_once('partials/edit-rooms.php');
		}
		if($_GET['group_id']==true AND $_GET['create_room']==true)
		{
			require_once('partials/create-room.php');
		}
		if($_GET['save_general_options']==true)
		{
			require_once('partials/save-general-options.php');
		}
		if($_GET['save_room']==true)
		{
			require_once('partials/save-rooms.php');
		}
		if($_GET['delete_room']==true)
		{
			require_once('partials/delete-room.php');
			require_once('partials/edit-rooms.php');
		}
		if($_GET['group_id']==true AND $_GET['add_service']==true)
		{
			require_once('partials/add-service.php');
		}
		if($_GET['group_id']==true AND $_GET['delete_service']==true)
		{
			require_once('partials/delete-service.php');
		}


	}
	//need to remove this - > not used
	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}


	

}