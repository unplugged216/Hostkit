<?php
/**
 * Hostkit whmcs functions
 *
 * @link              http://ava.to
 * @since             0.1
 * @package           Hostkit
 *
 *
 */
if ( ! defined( 'WPINC' ) ) die;



function hk_whmcs_prepare_logins(){
	$settings = get_option('HKit');
	$return   = array();

	$return[] = $settings['hk-whmcs-domainpath'];
	$return[] = $settings['hk-whmcs-username'];
	$return[] = $settings['hk-whmcs-password'];

	return $return;
}

/**
 * hk_whmcs_get_values connects ot the whmcs api and return values
 * @param  string $command type of action to lodge
 * @param  array  $args    additional fields to add
 */
function hk_whmcs_get_values( $command, $args = array() ){
	$fields = array();
	$logins = hk_whmcs_prepare_logins();

	$fields['username']     = $logins[1];
	$fields['password']     = $logins[2];
	$fields['action']       = $command;
	$fields['responsetype'] = 'json';

	$query = '';
	foreach ($fields as $k=>$v) $query .= $k . '=' . urlencode($v) . '&';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $logins[0] );
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$jsondata = curl_exec($ch);
	if (curl_error($ch)) die("Connection Error: ".curl_errno($ch).' - '.curl_error($ch));
	curl_close($ch);

	$arr = json_decode($jsondata, true); 

	return $arr;
}