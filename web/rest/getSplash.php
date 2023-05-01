<?php
$fname = "${backendLocation}/SPLASH.TXT";
$final = "YOURE FAILED";
if (file_exists($fname)) {
  $content = file_get_contents($fname);
}
if ($content === false) {
  $final = "TOO HARD TO READ";
} else {
  $content = str_replace("\r", "", $content);
  $arr = explode("\n", $content);
  $max = count($arr);
  $final = $arr[mt_rand(0, $max-1)];
}
echo($final);

$ini = parse_ini_file("${backendLocation}/config.ini");
$logFname = $ini['logFileName'];
file_put_contents("${backendLocation}/$logFname", PHP_EOL . date('d.m.y H:i:s') . ' getSplash request', FILE_APPEND);
?>