<?php
/**
 * Hostkit admin asset functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Hostkit
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'HK_Admin_Assets' ) ) :

	class HK_Admin_Assets{


		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );	
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );	
		}


		/**
		 * admin_styles enqueue admin styles
		 */
		public function admin_styles() {
			// enqueue global styles
			wp_enqueue_style( 'whmcs_press_admin_menu_styles', HOSTKIT_URL . '/assets/admin-menu.css', array(), HOSTKIT_VERSION );

			// enqueue admin screen styles
			$screen = get_current_screen();

			if ( in_array( $screen->id, hk_get_screen_ids() ) ) {
				wp_enqueue_style( 'hk_admin_styles', HOSTKIT_URL . 'assets/admin.css', array(), HOSTKIT_VERSION );
			}
		}



		/**
	 	* Enqueue scripts
	 	*/
		public function admin_scripts() {

			// enqueue admin screen styles
			$screen = get_current_screen();


			if ( in_array( $screen->id, hk_get_screen_ids() ) ) {


				wp_register_script( 'hk_admin', HOSTKIT_URL . 'assets/js/hk_admin.js', array( 'jquery' ), HOSTKIT_VERSION );


				wp_enqueue_script( 'hk_admin' );
				
				$params = array(
					'security'        => wp_create_nonce( "hk-admin-actions" ),
					'success_submit'  => __('Values Saved','hk'),
					'success_error'   => __('Something went wrong. Try again please.','hk')
				);

				wp_localize_script( 'hk_admin', 'hk_admin_values', $params );


			}

		}
	}

endif; // End if class_exists check



return new HK_Admin_Assets();