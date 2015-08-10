<?php
/**
 * Hostkit admin asset functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           WHMCS-press
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



if ( ! class_exists( 'HK_Admin_Page_Manager' ) ) :

	class HK_Admin_Page_Manager{

		/** @var array array of all admin options. */
		public $options	= null;

		/**
	    * @var HK_Admin_Page_Manager The single instance of the class
	    */
	    protected static $_instance = null;


	    public $user;


	    /**
	    * Main HK_Admin_Page_Manager Instance
	    *
	    * Ensures only one instance of WC_Shipping is loaded or can be loaded.
	    *
	    * @since 0.1
	    * @static
	    * @return HK_Admin_Page_Manager
	    */
	    public static function instance() {
	    	if ( is_null( self::$_instance ) )
	    		self::$_instance = new self();
	    	return self::$_instance;
	    }


		public function __construct() {
			$this->init();			
		}


		/**
        * init function.
        */
        public function init() {
		     $this->options = get_option('HKit');
		     $current_user  = wp_get_current_user();
		     $this->user['email'] = $current_user->user_email;
		     $this->user['avatar'] = get_avatar( $current_user->user_email, 32 );
	    }



	    public function fetch_option($name){
	    	if ( !isset( $this->options[$name] ) ) return '';
	    	return $this->options[$name];
	    }


	    /**
	     * set a textinput field for the admin section
	     * @param string $name        field name
	     * @param string $label       input label
	     * @param string $placeholder input placeholder
	     */
	    public function set_textinput($name, $label, $placeholder, $text = 'text'){

	    	$args = array(
	    		'label'          => $label,
	    		'name'           => $name,
	    		'value'          => $this->fetch_option($name),
	    		'default'        => '',
	    		'placeholder'    => $placeholder,
	    		'type'           => $text,
	    		'autocorrect'    => 'off',
	    		'autocapitalize' => 'off',
	    		'autocomplete'   => 'off',
	    		'wrap_before'    => '<p>',
	    		'wrap_after'     => '</p>'
	    	);

	    	return avi_fetch_form($args);	    	
	    }


	    /**
	     * set a password field for the admin section
	     * @param string $name        field name
	     * @param string $label       input label
	     * @param string $placeholder input placeholder
	     */
	    public function set_password_input($name, $label, $placeholder){

	    	$args = array(
	    		'label'          => $label,
	    		'name'           => $name,
	    		'value'          => '',
	    		'default'        => '',
	    		'placeholder'    => $placeholder,
	    		'type'           => 'password',
	    		'autocorrect'    => 'off',
	    		'autocapitalize' => 'off',
	    		'autocomplete'   => 'off',
	    		'wrap_before'    => '<p>',
	    		'wrap_after'     => '</p>'
	    	);

	    	return avi_fetch_form($args);	    	
	    }

	}

endif; // End if class_exists check
