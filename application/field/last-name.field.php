<?php 
$_formData['lastName'] = [
	'label' => 'Last name',
	'title' => 'Last name',
	'description' => null,
	'type' => 'text',
	'values' => null,
	'defaultValue' => null,
	'helpMessage' => 'Your last name',
	'placeholder' => 'Last name',
	'format' => [
		'value' => '/^[\p{L}\'\-\x20]+$/u',
		'message' => 'Your last name is not in the expected format.'
	],
	'required' => [
		'value' => true,
		'message' => 'Your last name is required.'
	],
	'minLength' => [
		'value' => 1,
		'message' => 'Your last name is required.'
	],
	'maxLength' => [
		'value' => 48,
		'message' => 'Your last name is limited to 48 characters.'
	],
	'messages' => null
];
?>