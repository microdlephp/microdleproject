<?php 
$_aopMethods = [
	'get' => null,
	'post' => [
		[
			'name' => 'authenticate',
			'arguments' => null
		],
		[
			'name' => 'checkParameters',
			'arguments' => [
				'data' => &$this->_parameters
			]
		],
		[
			'name' => 'formPost',
			'arguments' => null
		],
	],
	'put' => null,
	'delete' => null
];
?>