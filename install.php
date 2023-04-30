<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$ini = parse_ini_file("config.ini");

$backendLocation = $ini['backendLocation'];
mkdir($backendLocation, 0777, true);
$frontendLocation = $ini['frontendLocation'];
mkdir($frontendLocation, 0777, true);
$restLocation = $ini['frontendLocation'] . "/rest";
mkdir($restLocation, 0777, true);

$ini['backendLocation'] = realpath($ini['backendLocation']);
$ini['frontendLocation'] = realpath($ini['frontendLocation']);

$transformedIniContent = "";
foreach($ini as $key => $value)
	$transformedIniContent.= "$key = \"$value\"\n";
file_put_contents("$backendLocation/config.ini", $transformedIniContent);

// copy files to install dir
$files = array_slice(scandir('web/back'), 2);
foreach($files as $path) {
	$fcontent = file_get_contents("web/back/$path");
	foreach($ini as $key => $value)
		$fcontent = str_replace('${'.$key.'}', $value, $fcontent);
	file_put_contents("$backendLocation/$path", $fcontent);
}

echo "Deployed backend files\n";

$files = array_slice(scandir('web/front'), 2);
foreach($files as $path) {
	$fcontent = file_get_contents("web/front/$path");
	foreach($ini as $key => $value)
		$fcontent = str_replace('${'.$key.'}', $value, $fcontent);
	file_put_contents("$frontendLocation/$path", $fcontent);
}

$files = array_slice(scandir('web/rest'), 2);
foreach($files as $path) {
	$fcontent = file_get_contents("web/rest/$path");
	foreach($ini as $key => $value)
		$fcontent = str_replace('${'.$key.'}', $value, $fcontent);
	file_put_contents("$restLocation/$path", $fcontent);
}

echo "Deployed frontend files\n";

$fcontent = file_get_contents("Pvpetris.gmx/Pvpetris.project.gmx");
foreach($ini as $key => $value)
	$fcontent = str_replace('${'.$key.'}', $value, $fcontent);
file_put_contents("Pvpetris.gmx/Pvpetris.project.gmx", $fcontent);

echo "Game globals updated\n";
?>