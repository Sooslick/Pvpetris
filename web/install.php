<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$ini = parse_ini_file("config.ini");

$backendLocation = $ini['backendLocation'];
mkdir($backendLocation, 0777, true);
$frontendLocation = $ini['frontendLocation'];
mkdir($frontendLocation, 0777, true);
$restLocation = $ini['restLocation'];
mkdir($restLocation, 0777, true);

$ini['backendLocation'] = realpath($ini['backendLocation']);
$ini['frontendLocation'] = realpath($ini['frontendLocation']);
$ini['restLocation'] = realpath($ini['restLocation']);

$transformedIniContent = "";
foreach($ini as $key => $value)
	$transformedIniContent.= "$key = \"$value\"\n";
file_put_contents("$backendLocation/config.ini", $transformedIniContent);

// copy files to install dir
$files = array_slice(scandir('back'), 2);
foreach($files as $path) {
	$fcontent = file_get_contents("back/$path");
	foreach($ini as $key => $value)
		$fcontent = str_replace('${'.$key.'}', $value, $fcontent);
	file_put_contents("$backendLocation/$path", $fcontent);
}

$files = array_slice(scandir('front'), 2);
foreach($files as $path) {
	$fcontent = file_get_contents("front/$path");
	foreach($ini as $key => $value)
		$fcontent = str_replace('${'.$key.'}', $value, $fcontent);
	file_put_contents("$frontendLocation/$path", $fcontent);
}

$files = array_slice(scandir('rest'), 2);
foreach($files as $path) {
	$fcontent = file_get_contents("rest/$path");
	foreach($ini as $key => $value)
		$fcontent = str_replace('${'.$key.'}', $value, $fcontent);
	file_put_contents("$restLocation/$path", $fcontent);
}

echo "copied files to target directories";

// todo process variables both in API and GM project
?>