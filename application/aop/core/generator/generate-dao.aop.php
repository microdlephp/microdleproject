<?php 
$_aopMethods = [
	'page' => null,
	'dialog' => null,
	'event' => null,
	'ws' => [
		[
			'name' => 'checkParameters',
			'arguments' => [
				'data' => $this->_parameters
			]
		],
		/*[
			'name' => 'generateDaoCheck',
			'arguments' => null
		],*/
		[
			'name' => 'openDataSource',
			'arguments' => [
				'dataSourceName' => $this->_parameters['dataSourceName']
			]
		],
		[
			'name' => 'generateDaoAction',
			'arguments' => null
		],
		//[
		//	'name' => 'commitDataSource',
		//	'arguments' => [
		//		'dataSourceName' => 'adventyDs'
		//	]
		//],
		[
			'name' => 'closeDataSource',
			'arguments' => [
				'dataSourceName' => $this->_parameters['dataSourceName']
			]
		]
	]
];
?>