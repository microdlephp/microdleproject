<?php 
/**
 * Error logs: write log in a file or/and send log by mail.
 * To disabled log, set to null or remove file log configuration.
 */
$_logData = [
	//Default application log
	'application' => [
		//null to disable application log. By default, apache log is used (see /var/log/apache2/error.log)
		'PATH_ERROR_LOG' => $_SERVER['DOCUMENT_ROOT'] . '/_log/',

		//Ex: admin@xxx.com to send error notification. null to disable email notification
		'MAIL_ERROR_LOG' => 'ironman@avengers.com'
	]

	//Custom logs: BOs can have their own error log file
	//For example, replace "<boName>" by "model\bo\IndexBo", and "<actionName>" by "indexAction"
	//'<boName1>' => [
	//	'<actionName1>' => [
	//		$_SERVER['DOCUMENT_ROOT'] . '/_log/error-developper-1',
	//		$_SERVER['DOCUMENT_ROOT'] . '/_log/error-developper-2',
	//		...
	//		$_SERVER['DOCUMENT_ROOT'] . '/_log/error-developper-n'
	//	]
	//],
	//...
	//'<boNameN>' => [
	//	'<actionNameN>' => [
	//		$_SERVER['DOCUMENT_ROOT'] . '/_log/error-developper-1',
	//		$_SERVER['DOCUMENT_ROOT'] . '/_log/error-developper-2',
	//		...
	//		$_SERVER['DOCUMENT_ROOT'] . '/_log/error-developper-n'
	//	]
	//]
];
?>