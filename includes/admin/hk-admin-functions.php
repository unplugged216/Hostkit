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



/**
 * Get all screen ids
 *
 * @return array
 */
function hk_get_screen_ids() {
	$screen_ids   = array(
		'toplevel_page_hk-settings'
	);	
	return apply_filters( 'hk_screen_ids', $screen_ids );
}


/**
 * Retur nan instance of a class
 *
 * @return array
 */
function hk_start_class($classname) {
	$class_name = 'hk_' . $classname;
	$class_path = 'class-hk-' . strtolower( str_replace('_','-',$classname) ) . '.php';
	if ( ! class_exists( $class_name ) ) include $class_path;

	$newclass = new $class_name;

	return $newclass::instance();
}
