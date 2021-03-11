<?php
/**
 * Launch request, and output response content.
 * @author Vincent SOYSOUVANH
 */

//$t1 = microtime(true);

//Load configuration
require $_SERVER['DOCUMENT_ROOT'].'/application/configuration/' . $_SERVER['HTTP_HOST'] . '.cfg.php';

//Load request
require $_ENV['FRAMEWORK_ROOT'] . '/request/Request' . $_ENV['FILE_EXTENSIONS']['class'];

//Execute request and output response
(new \com\microdle\request\Request())->execute();

//echo 'Duration: ', microtime(true) - $t1;
?>