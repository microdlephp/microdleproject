<?php 
$_formData['birthDate'] = [
	'label' => 'Birth date',
	'type' => 'date',
	'values' => null,
	'defaultValue' => null,
	'helpMessage' => 'Your birth date.',
	'placeholder' => 'jj/mm/aaaa',
	'format' => [
		'value' => '/^(\d{2}\/\d{2}\/\d{4})|(\d{4}-\d{2}-\d{2})$/',
		'message' => 'Your birth date is not in the expected format.'
	],
	'required' => [
		'value' => true,
		'message' => 'Your birth date is required.'
	],
	'minLength' => [
		'value' => 10,
		'message' => 'Your birth date is incorrect.'
	],
	'maxLength' => [
		'value' => 10,
		'message' => 'Your birth date is incorrect.'
	],
	'messages' => [
		'PosteriorDate' => 'Your birth date cannot be later than today\'s date.'
	]
];
?>