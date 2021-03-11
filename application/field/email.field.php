<?php 
$_formData['email'] = [
	'label' => 'E-mail',
	'title' => 'E-mail',
	'description' => null,
	'type' => 'email',
	'values' => null,
	'defaultValue' => null,
	'helpMessage' => 'Your e-mail.',
	'placeholder' => 'Your e-mail',
	'format' => [
		'pattern' => '/^[a-zA-Z\d\._\-]+@[a-zA-Z\d\-]+(?:\.[a-zA-Z\d_\-]+)*$/',
		'value' => FILTER_VALIDATE_EMAIL,
		'message' => 'Your e-mail is not in the expected format.'
	],
	'required' => [
		'value' => true,
		'message' => 'Your e-mail is required.'
	],
	'minLength' => [
		'value' => 7,
		'message' => 'Your e-mail is incorrect.'
	],
	'maxLength' => [
		'value' => 128,
		'message' => 'Your e-mail is limited to 128 characters.'
	],
	'messages' => [
		'DisposableEmail' => 'Disposable E-mail is not allowed.',
		'EmailAlreadyExists' => 'E-mail already exists.',
		'SendConfirmationCodeImpossible' => 'A technical error occured. Sending e-mail is not possible.'
	]
];
?>