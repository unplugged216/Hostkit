<?php
/**
 * WHMCS-press link to utilities files to include
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           WHMCS-press
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;


/**
* isUrl test a string for a valid url
* @param  string  $text [description]
*/
function hk_is_url( $text )  {  
   return filter_var( $text, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false;  
}