<?php
//report errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//check _GET parameters
$ok = true;
$err_string = '';
$name = '';
if (isset($_GET['name'])) {$name = $_GET['name'];} else {$ok = false; $err_string .= "No name passed. ";}

//fix body
$name = str_replace("%", "&#37;", $name);

$ini = parse_ini_file("${backendLocation}/config.ini");
$logFname = $ini['logFileName'];

//check main database
if ($ok) {
	$opt = array(
		PDO::ATTR_ERRMODE	     => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	try {
		$pdo = new PDO($ini['connection'], $ini['dbuser'], $ini['dbpw'], $opt);
	} catch (PDOException $e) {
		$ok = false;
		echo 'Database error.';
	}
}

//insert score
if ($ok) {
  try {
    $myQ = $pdo->query("SELECT MAX(SCORE) MYSCORE, MAX(BURN) MYBURN FROM PVPETRIS WHERE NAME = '$name'");
    $wrQ = $pdo->query("SELECT MAX(SCORE) MAXSCORE, MAX(BURN) MAXBURN FROM PVPETRIS");
  } catch (PDOException $e) {
    $ok = false;
    $err_string = 'Database read error.';
  }
}

//log result
if ($ok) {
	$maxscore = 0;
	$maxlines = 0;
	$myscore = 0;
	$mylines = 0;
	$row = $myQ -> fetch();
	if (!empty($row['MYSCORE'])) {
		$myscore = $row['MYSCORE'];
		$mylines = $row['MYBURN'];
	}
	if ($row = $wrQ -> fetch()) {
		$maxscore = $row['MAXSCORE'];
		$maxlines = $row['MAXBURN'];
	}
	echo "$myscore,$mylines,$maxscore,$maxlines";
	file_put_contents("${backendLocation}/$logFname", PHP_EOL . date('d.m.y H:i:s') . ' PvPetris getScore by ' . $name, FILE_APPEND);
} else {
	echo $err_string;
	file_put_contents("${backendLocation}/$logFname", PHP_EOL . date('d.m.y H:i:s') . ' PvPetris getScore fail: ' . $err_string, FILE_APPEND);
}
