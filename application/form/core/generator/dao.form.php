<?php 
$_formData = [
	'dataSourceName' => [
		'label' => 'dataSourceName',
		'type' => 'hidden',
		'values' => null,
		'defaultValue' => null,
		'helpMessage' => null,
		'placeholder' => null,
		'format' => [
			'value' => '/^[a-zA-Z\-_]{1,32}$/',
			'message' => 'dataSourceName parameter is invalid.'
		],
		'required' => [
			'value' => true,
			'message' => 'dataSourceName parameter is required.'
		],
		'minLength' => [
			'value' => 1,
			'message' => 'dataSourceName parameter is required.'
		],
		'maxLength' => [
			'value' => 32,
			'message' => 'dataSourceName parameter is limited to 32 characters.'
		],
		'messages' => null
	],
	'tableName' => [
		'label' => 'tableName',
		'type' => 'hidden',
		'values' => null,
		'defaultValue' => null,
		'helpMessage' => null,
		'placeholder' => null,
		'format' => [
			'value' => '/^[a-zA-Z\-_]{1,32}$/',
			'message' => 'tableName parameter is invalid.'
		],
		'required' => [
			'value' => false,
			'message' => null,
		],
		'minLength' => [
			'value' => 0,
			'message' => null
		],
		'maxLength' => [
			'value' => 32,
			'message' => 'tableName parameter is limited to 32 characters.'
		],
		'messages' => null
	]
];
?>