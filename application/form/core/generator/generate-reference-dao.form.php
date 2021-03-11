<?php 
$_formData = array(
	'dataSourceName' => array(
		'label' => 'Data source name',
		'type' => 'hidden',
		'values' => null,
		'defaultValue' => null,
		'helpMessage' => null,
		'placeholder' => null,
		'format' => array(
			'value' => '/^[a-zA-z\-_]{1,32}$/',
			'message' => 'dataSourceName parameter invalid.'),
		'required' => array(
			'value' => true,
			'message' => 'dataSourceName parameter required.'),
		'minLength' => array(
			'value' => 1,
			'message' => 'dataSourceName parameter required.'),
		'maxLength' => array(
			'value' => 32,
			'message' => 'dataSourceName parameter lenght limited to 32 characters.'
		),
		'messages' => null
	),
	'tableName' => array(
		'label' => 'Table name',
		'type' => 'hidden',
		'values' => null,
		'defaultValue' => null,
		'helpMessage' => null,
		'placeholder' => null,
		'format' => array(
			'value' => '/^[a-zA-z\-_]{1,32}$/',
			'message' => 'tableName parameter invalid.'
		),
		'required' => array(
			'value' => true,
			'message' => 'tableName required.'
		),
		'minLength' => array(
			'value' => 1,
			'message' => 'tableName required.'
		),
		'maxLength' => array(
			'value' => 32,
			'message' => 'tableName parameter length limited to 32 characters.'
		),
		'messages' => null
	),
	'labelName' => array(
		'label' => 'Label name',
		'type' => 'hidden',
		'values' => null,
		'defaultValue' => null,
		'helpMessage' => null,
		'placeholder' => null,
		'format' => array(
			'value' => '/^[a-zA-z\-_]{1,32}$/',
			'message' => 'labelName parameter invalid.'
		),
		'required' => array(
			'value' => true,
			'message' => 'labelName required.'
		),
		'minLength' => array(
			'value' => 1,
			'message' => 'labelName required.'
		),
		'maxLength' => array(
			'value' => 32,
			'message' => 'labelName parameter length limited to 32 characters.'
		),
		'messages' => null
	)
);
?>