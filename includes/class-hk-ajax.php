<?php
/**
 * Hostkit ajax functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Hostkit
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'HK_Ajax' ) ) :

	class HK_Ajax{


		/**
	    * Hook in ajax handlers
	    */
	   public static function init() {
	   		add_action( 'template_redirect', array( __CLASS__, 'do_hk_ajax'), 0 );
	   		self::add_ajax_events();
	   }



		/**
		* Hook in methods - uses WordPress ajax handlers (admin-ajax)
		*/
		public static function add_ajax_events() {

			$ajax_events = array(
				'update_whmcs_apidetails' => true,
				'test_apidetails'         => true,
			);

			foreach ( $ajax_events as $ajax_event => $nopriv ) {
				add_action( 'wp_ajax_hk_' . $ajax_event, array( __CLASS__, $ajax_event ) );
				if ( $nopriv ) {
					add_action( 'wp_ajax_nopriv_hk_' . $ajax_event, array( __CLASS__, $ajax_event ) );
					// WC AJAX can be used for frontend ajax requests
					add_action( 'wc_ajax_kh_' . $ajax_event, array( __CLASS__, $ajax_event ) );
				}
			}
		}



		/**
	    * Check for WC Ajax request and fire action
	    */
		public static function do_hk_ajax() {
			global $wp_query;

			if ( ! empty( $_GET['hk-ajax'] ) ) {
				$wp_query->set( 'hk-ajax', sanitize_text_field( $_GET['hk-ajax'] ) );
			}
		
			
			if ( $action = $wp_query->get( 'hk-ajax' ) ) {
			
				if ( ! defined( 'DOING_AJAX' ) ) {
					define( 'DOING_AJAX', true );
				}
			
				if ( ! defined( 'HK_DOING_AJAX' ) ) {
					define( 'HK_DOING_AJAX', true );
				}
			
				do_action( 'hk_ajax_' . sanitize_text_field( $action ) );
				die();
			}
		}


		/**
		 * update_whmcs_apidetails updates the api details in the admon
		 */
		public static function update_whmcs_apidetails(){
			$settings = get_option('HKit');

			check_ajax_referer( 'hk-admin-actions', 'security' );

			$settings['hk-whmcs-domainpath'] = sanitize_text_field( $_POST['hk-whmcs-domainpath'] );
			$settings['hk-whmcs-username']   = sanitize_text_field( $_POST['hk-whmcs-username'] );

			if ($_POST['hk-whmcs-password'] != ''){
				$settings['hk-whmcs-password']   = sanitize_text_field( md5( $_POST['hk-whmcs-password'] ) );
			}

			update_option('HKit',$settings);

			echo wp_send_json( array('response' => 100, 'message' => '' ) );

			die();
		}

		public function test_apidetails(){

			$result = hk_whmcs_get_values('getstats');

			if ($result['result'] == 'error'){
				echo wp_send_json( array('response' => 100, 'message' => $result['message'] ) );
			} else {
				echo wp_send_json( array('response' => 100, 'message' => __('Connection to WHMCS api Successfull','hk'), 'results' => $result  ) );
			}

			die();
		}

	}

endif; // End if class_exists check



HK_Ajax::init();