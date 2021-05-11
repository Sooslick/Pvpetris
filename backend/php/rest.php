<?php
//report errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//check _GET parameters
$ok = true;
$err_string = '';
if (isset($_GET['name'])) {$name = $_GET['name'];} else {$ok = false; $err_string .= "No name passed. ";}
if (isset($_GET['score'])) {$score = $_GET['score'];} else {$ok = false; $err_string .= "No score passed. ";}
if (isset($_GET['burn'])) {$burn = $_GET['burn'];} else {$ok = false; $err_string .= "No lines passed. ";}
if (isset($_GET['startlevel'])) {$startlevel = $_GET['startlevel'];} else {$ok = false; $err_string .= "No startlevel passed. ";}
if (isset($_GET['ttr'])) {$ttr = $_GET['ttr'];} else {$ttr = -1;}
if (isset($_GET['hash'])) {$hash = $_GET['hash'];} else {$ok = false; $err_string .= "No hash passed.";}

//check hash
if ($ok) {
  $checkhash = sha1($name.$score."SlightlyLoosened338BOOM!! Tetris for Jeff!");		//todo move secret constants to configs
  if ($checkhash != $hash) {
    $ok = false;
    $err_string = "Hash is not identical. Name: ".$name;
    }
  }

//fix body
$name = str_replace("%", "&#37;", $name);

//check main database
if ($ok)
{
	$ini = parse_ini_file("dbConfig.ini");
	$dbs = "mysql:host=" . $ini['host'] . ";dbname=" . $ini['db'] . ";charset=utf8";
	$opt = array(
		PDO::ATTR_ERRMODE	     => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$dbp = $ini['pw'];
	$dbn = $ini['db'];
	try {
		$pdo = new PDO($dbs, $dbn, $dbp, $opt);
	} catch (PDOException $e) {
		$ok = false;
		$err_string = 'Database error.';
	}
}

//insert score
if ($ok) {
  $request = 'INSERT INTO PVPETRIS (NAME, SCORE, BURN, STARTLEVEL, TTR) VALUES ("'.$name.'", '.$score.', '.$burn.', '.$startlevel.', '.$ttr.')';
  try {
    $q = $pdo->query($request);
  } catch (PDOException $e) {
    $ok = false;
    $err_string = 'Database write error.';
  }
}

//log result
if ($ok) {
	echo "ok";
	file_put_contents($ini['logpath'], PHP_EOL . date('d.m.y H:i:s') . ' PvPetris request: success; Name: ' . $name, FILE_APPEND);
} else {
	echo $err_string;
	file_put_contents($ini['logpath'], PHP_EOL . date('d.m.y H:i:s') . ' PvPetris request: fail; Error message: ' . $err_string, FILE_APPEND);
}
