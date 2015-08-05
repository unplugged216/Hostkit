<?php
/**
 * Hostkit admin functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Hostkit
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'HK_Admin' ) ) :

	class HK_Admin{


		public function __construct() {
			add_action( 'init', array( $this, 'includes' ) );
		}

		/**
	    * Include any classes we need within admin.
	    */
	    public function includes() {
		include_once( 'class-hk-admin-menus.php' );
	    }

	}

endif; // End if class_exists check



return new HK_Admin();
