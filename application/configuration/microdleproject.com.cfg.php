<?php 
/**
 * Overwrite Microdle base Configuration.
 */

//Manage error
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//Set framework root
$_ENV['FRAMEWORK_ROOT'] = $_SERVER['DOCUMENT_ROOT'] . '/../../framework/microdle';

//Load framework default configuration: $_FRAMEWORK_CONFIGURATION
require $_ENV['FRAMEWORK_ROOT'] . '/configuration/configuration.cfg.php';

//Add and/or overwrite environment variables configuration
$_ENV = array_merge(
	//Initial environment variables: framework configuration
	$_ENV,
	
	//Custom configuration and/or overwrite framework configuration
	//Put whatever you want here inside this array...
	[
		//Set environment
		'IS_LOCAL' => false,
		'IS_TEST' => false,
		'IS_STAGING' => false,
		'IS_PRODUCTION' => true
	]
);
?>