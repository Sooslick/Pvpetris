<?php
//report errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//check _GET parameters
$ok = true;
$err_string = '';
if (isset($_GET['name'])) {$name = $_GET['name'];} else {$ok = false; $err_string .= "No name passed. ";}

//fix body
$name = str_replace("%", "&#37;", $name);

//check main database
if ($ok) {
	$ini = parse_ini_file("${backendLocation}/config.ini");
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
  $request = "
	SELECT l.MYSCORE, l.MYBURN, g.MAXSCORE, g.MAXBURN FROM 
	(SELECT NAME, 1 HOOK, MAX(SCORE) MYSCORE, MAX(BURN) MYBURN FROM PVPETRIS GROUP BY NAME) l 
	LEFT JOIN (SELECT 1 HOOK, MAX(SCORE) MAXSCORE, MAX(BURN) MAXBURN FROM PVPETRIS) g 
	ON (l.HOOK = g.HOOK) 
	WHERE l.NAME = '$name'";
  try {
    $q = $pdo->query($request);
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
	if ($row = $q -> fetch()) {
		$maxscore = $row['MAXSCORE'];
		$maxlines = $row['MAXBURN'];
		$myscore = $row['MYSCORE'];
		$mylines = $row['MYBURN'];
	}
	echo "$myscore,$myburn,$maxscore,$maxburn";
	file_put_contents($ini['logpath'], PHP_EOL . date('d.m.y H:i:s') . ' PvPetris getScore by ' . $name, FILE_APPEND);
} else {
	echo $err_string;
	file_put_contents($ini['logpath'], PHP_EOL . date('d.m.y H:i:s') . ' PvPetris getScore fail: ' . $err_string, FILE_APPEND);
}
