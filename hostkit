<?php
/**
 * hostkit is the ultimate whmcs plugin and addon for WordPress.
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           hostkit
 *
 * @wordpress-plugin
 * Plugin Name:       hostkit
 * Plugin URI:        http://hostkit.ava.to/
 * Description:       hostkit
 * Version:           0.1
 * Author:            Avato
 * Author URI:        http://ava.to
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hostkit
 * Domain Path:       /languages
 *
 * WordPress -
 * Requires at least: 4.2
 * Tested up to: 4.2.3
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'Hostkit' ) ) :

	final class Hostkit {


		/**
	 	* declare the instance
	 	*
	 	*
	 	* @since    0.1
	 	*/
		private static $instance;



		public $version = '0.1';


		/**
	 	* Main  Instance
	 	*
	 	* Insures that only one instance of the plugin exists in memory at any one
	 	* time. Also prevents needing to define globals all over the place.
	 	*
	 	* @since 0.0.1
	 	* @return instance
	 	*/
	
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Hostkit ) ) {
			
				self::$instance = new Hostkit;
			
				self::$instance->setup_constants();			
				self::$instance->includes();
				self::$instance->get_options();
			
				add_action( 'init', array( self::$instance, 'setup_objects' ), -1 );
		
			}
		
			return self::$instance;		
		}



		/**
	 	* Throw error on object clone
	 	*
	 	* The whole idea of the singleton design pattern is that there is a single
	 	* object therefore, we don't want the object to be cloned.
	 	*
	 	* @since 0.0.1
	 	* @access protected
	 	* @return void
	 	*/
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'hostkit' ), '1.0' );
		}




		/**
	 	* Disable unserializing of the class
	 	*
	 	* @since 0.0.1
	 	* @access protected
	 	* @return void
	 	*/
		public function __wakeup() {
			// Unserializing instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'hostkit' ), '1.0' );
		}



		/**
	 	* Setup plugin constants
	 	*
	 	* @access private
	 	* @since 0.0.1
	 	* @return void
	 	*/
		private function setup_constants() {

			// Plugin Folder Path
			if ( ! defined( 'HOSTKIT_DIR' ) ) {
				define( 'HOSTKIT_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'HOSTKIT_URL' ) ) {
				define( 'HOSTKIT_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Folder Path
			if ( ! defined( 'HOSTKIT_VERSION' ) ) {
				define( 'HOSTKIT_VERSION', $this->version );
			}

		}



		/**
	 	* Include required files
	 	*
	 	* @access private
	 	* @since 0.0.1
	 	* @return void
		*/
		private function includes() {

		
	
		}


		/**
	 	* Setup all objects
	 	*
	 	* @access private
	 	* @since 0.0.1
	 	* @return void
	 	*/
	
		public function setup_objects() {


		}


		public function get_options(){
			return;
		}


	}
endif; // End if class_exists check


/**
 *
 * @since 0.1
 * @return Hostkit instance
 */
function HKit() {
	return Hostkit::instance();
}
HKit();
