<?php 
namespace model\bo;

/**
 * Test BO (Business Object) class for client simulation.
 * All BO class can extend directly \com\microdle\model\bo\AbstractBo.
 * @author Vincent SOYSOUVANH
 * @package model.bo
 */
class TestBo extends \model\bo\Bo {
	/**
	 * Test GET request.
	 * HTTP response should be: 200 OK
	 * @return void
	 * @uses https://xxx/test/get
	 */
	public function getGet(): void {
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/my-aspect?k1=v1',
			['id' => 1, 'methodUsed' => 'GET', 'description' => 'Request with GET method. Use to extract and return data. Response is just the data sent.'],
			'GET',
			null,
			$this->httpCode
		);
	}
	
	/**
	 * Test POST request.
	 * HTTP response should be: 200 OK
	 * @return void
	 * @uses https://xxx/test/post
	 */
	public function postGet(): void {
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/my-aspect?k2=v2',
			['id' => 2, 'methodUsed' => 'POST', 'description' => 'Request with POST method. Use to create data. Response should be the successful of the action.'],
			'POST',
			null,
			$this->httpCode
		);
	}
	
	/**
	 * Test PUT request.
	 * HTTP response should be: 200 OK
	 * @return void
	 * @uses https://xxx/test/put
	 */
	public function putGet(): void {
		$options = [
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_USERPWD => 'vincent:myPassword',
		];
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/my-aspect?action=trace',
			['id' => 3, 'methodUsed' => 'PUT', 'description' => 'Request with PUT method. Use to update data. Response should be the successful of the action.'],
			'PUT',
			$options,
			$this->httpCode
		);
	}
	
	/**
	 * Test DELETE request.
	 * HTTP response should be: 200 OK
	 * @return void
	 * @uses https://xxx/test/delete
	 */
	public function deleteGet(): void {
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/my-aspect',
			['id' => 4, 'methodUsed' => 'DELETE', 'description' => 'Request with DELETE method. Use to remove data. Response should be the successful of the action.'],
			'DELETE',
			null,
			$this->httpCode
		);
	}
	
	/**
	 * Test auth OK on PUT method. Here user and password are valid (vincent:myPassword).
	 * HTTP response should be: 200 OK
	 * @return void
	 * @uses https://xxx/test/auth-ok
	 */
	public function authOkGet(): void {
		$options = [
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_USERPWD => 'vincent:myPassword',
		];
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/auth',
			['id' => 5, 'methodUsed' => 'GET'],
			'GET',
			$options,
			$this->httpCode
		);
	}
	
	/**
	 * Test auth KO on PUT method. Here user or password is invalid.
	 * HTTP response should be: 401 Unauthorized
	 * @return void
	 * @uses https://xxx/test/auth-ko
	 */
	public function authKoGet(): void {
		$options = [
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_USERPWD => 'vin:fail',
		];
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/auth',
			['id' => 6, 'methodUsed' => 'GET'],
			'GET',
			$options,
			$this->httpCode
		);
	}
	
	/**
	 * Test form OK on POST method.
	 * HTTP response should be: 200 OK
	 * @return void
	 * @uses https://xxx/test/form-ok
	 */
	public function formOkGet(): void {
		$formData = [
			'lastName' => 'Iron-Man',
			'birthDate' => date('Y-m-d'),
			'email' => 'ironman@avengers.com'
		];
		$options = [
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_USERPWD => 'vincent:myPassword',
		];
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/form',
			$formData,
			'POST',
			$options,
			$this->httpCode
		);
	}
	
	/**
	 * Test form KO on POST method. Here, birthDate is sent with empty value, but is required.
	 * HTTP response should be: 412 Precondition Failed
	 * @return void
	 * @uses https://xxx/test/form-ko
	 */
	public function formKoGet(): void {
		$formData = [
			'lastName' => 'Iron-Man',
			'birthDate' => '',
			'email' => 'ironman@avengers.com'
		];
		$options = [
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_USERPWD => 'vincent:myPassword',
		];
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/form',
			$formData,
			'POST',
			$options,
			$this->httpCode
		);
	}
	
	/**
	 * Test form KO on PUT method. Simulate duplication data.
	 * HTTP response should be: 409 Conflict
	 * @return void
	 * @uses https://xxx/test/form-put-ko
	 */
	public function formPutKoGet(): void {
		$formData = [
			'lastName' => 'Iron-Man',
			'birthDate' => '',
			'email' => 'ironman@avengers.com'
		];
		$options = [
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_USERPWD => 'vincent:myPassword',
		];
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/form',
			$formData,
			'PUT',
			$options,
			$this->httpCode
		);
	}
	
	/**
	 * Test error server on GET method.
	 * HTTP response should be: 500 Internal Server Error
	 * @return void
	 * @uses https://xxx/test/error-server
	 */
	public function errorServerGet(): void {
		$this->response = $this->_request::send(
			$_ENV['HOME_URL'] . '/folder1/folder2/my-class/error-server',
			null,
			'GET',
			null,
			$this->httpCode
		);
	}
}
?>