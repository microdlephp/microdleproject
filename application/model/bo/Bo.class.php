<?php 
namespace model\bo;

/**
 * Core business class.
 * @author Vincent SOYSOUVANH
 * @package model.bo
 */
class Bo extends \com\microdle\model\bo\AbstractBo {
	/**
	 * Authenticate user.
	 * @return void
	 * @throws \com\microdle\exception\AuthenticationException
	 */
	public function authenticate(): void {
		//Case login or password is not set
		if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
			throw new \com\microdle\exception\AuthenticationException('Permission denied.');
		}
		
		//Retrieve user/password from database
		//@todo
		
		//Case user not found
		//@todo
		//throw new \com\microdle\exception\AuthenticationException('Permission denied.');
		
		//Check authentication
		if($_SERVER['PHP_AUTH_USER'] != 'vincent' || $_SERVER['PHP_AUTH_PW'] != 'myPassword') {
			throw new \com\microdle\exception\AuthenticationException('Permission denied.');
		}
	}
}
?>