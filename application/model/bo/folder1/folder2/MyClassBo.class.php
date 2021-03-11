<?php 
namespace model\bo\folder1\folder2;

/**
 * MyClass BO (Business Object) class.
 * All BO class can extend directly \com\microdle\model\bo\AbstractBo.
 * See all exceptions available in Microdle framework folder: /exception
 * @author Vincent SOYSOUVANH
 * @package model.bo.folder1.folder2
 */
class MyClassBo extends \model\bo\Bo {
	/**
	 * Test GET request. Output parameters sent.
	 * @return void
	 */
	public function myAspectGet(): void {
		$this->response = $this->_parameters;
	}
	
	/**
	 * Test POST request. Output parameters sent.
	 * @return void
	 */
	public function myAspectPost(): void {
		$this->response = $this->_parameters;
	}
	
	/**
	 * Test PUT request. Output parameters sent.
	 * @return void
	 */
	public function myAspectPut(): void {
		$this->response = $this->_parameters;
	}
	
	/**
	 * Test DELETE request. Output parameters sent.
	 * @return void
	 */
	public function myAspectDelete(): void {
		$this->response = $this->_parameters;
	}
	
	/**
	 * Test POST request.
	 * @return void
	 */
	public function formPost(): void {
		$this->response = $this->_formData;
	}
	
	/**
	 * Test PUT request. Simulates duplication data.
	 * @return void
	 */
	public function formPut(): void {
		throw new \com\microdle\exception\DuplicationException('Data already exist.');
	}
	
	/**
	 * Test GET request. Simulates error server.
	 * @return void
	 */
	public function errorServerGet(): void {
		//Division by zero
		1/0;
	}
}
?>