<?php
/*
* if txt file long. add (.htacces) php_value max_execution_time 300  
*/

ini_set("auto_detect_line_endings", true);
require_once __DIR__ . '\src\CurlVerificationDomen.php';
$filename = __DIR__ . '\src\link.txt';

$arrayMixUrl = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$clearArrayUrl = array_filter($arrayMixUrl, function ($element) {
	return !empty($element && strlen($element) > 2);
});

$arrayUrl = array_values($clearArrayUrl);

foreach ($arrayUrl as $val) {

	$answer = CurlVerificationDomen($val);

	if ($answer == 200)

		echo '<p style="color:green"> Сайт '  . $val . ' доступен. <p>';

	else {
		if ($answer == 28) //see libcurl-errors info
		{
			echo '<p style="color:red">Ресурс ' . $val . ' не отвечает. Тайм-аут операции (более 10 сек)<p>';
		} else {
			echo '<p style="color:red">Ресурс ' . $val . ' недоступен. Причина: ' . $answer . '<p>';
		}
	}
}
