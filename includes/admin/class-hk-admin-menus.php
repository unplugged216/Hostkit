<?php
/**
 * Hostkit admin menu functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           WHMCS-press
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'HK_Admin_Menus' ) ) :

	class HK_Admin_Menus{


		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
			add_action( 'admin_menu', array( $this, 'settings_menu' ), 50 );		
		}


		/**
	    * Add main menu item
	    */
		public function admin_menu() {
			add_menu_page( __( 'Hostkit', 'hk' ), __( 'Hostkit', 'hk' ), 'manage_options', 'hk-settings', null, null, '55.5' );
		}


		/**
	    * Add sub menu item
	    */
	    public function settings_menu() {
	    	$settings_page = add_submenu_page( 'hostkit', __( 'Hostkit Settings', 'hk' ),  __( 'Settings', 'hk' ) , 'manage_options', 'hk-settings', array( $this, 'settings_page' ) );
	    }



	    /**
	    * Init the settings page
	    */
	    public function settings_page() {
	    	$HK =  hk_start_class('Admin_Page_Manager');
	    	include_once( 'template/html-hk-settings-page.php' );
	    }
	}

endif; // End if class_exists check



return new HK_Admin_Menus();
