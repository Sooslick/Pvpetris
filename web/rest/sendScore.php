<?php
$ini = parse_ini_file("${backendLocation}/config.ini");
$logFname = "${backendLocation}/" . $ini['logFileName'];

//check _GET parameters
$ok = true;
$err_string = '';
$name = '';
if (isset($_GET['name'])) {$name = $_GET['name'];} else {$ok = false; $err_string .= "No name passed. ";}
if (isset($_GET['score'])) {$score = $_GET['score'];} else {$ok = false; $err_string .= "No score passed. ";}
if (isset($_GET['burn'])) {$burn = $_GET['burn'];} else {$ok = false; $err_string .= "No lines passed. ";}
if (isset($_GET['startlevel'])) {$startlevel = $_GET['startlevel'];} else {$ok = false; $err_string .= "No startlevel passed. ";}
if (isset($_GET['ttr'])) {$ttr = $_GET['ttr'];} else {$ttr = -1;}
if (isset($_GET['hash'])) {$hash = $_GET['hash'];} else {$ok = false; $err_string .= "No hash passed.";}

if (!$ok) {
	http_response_code(400);
	echo $err_string;
	file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' [' . $_SERVER['REMOTE_ADDR'] . "] PvPetris sendScore fail: $err_string", FILE_APPEND);
	exit();
}

//check hash
$checkhash = sha1($name.$score.'Boom! Tetris for JEFF!!'.'340');
if ($checkhash != $hash) {
	http_response_code(400);
	echo "Hash is not identical. Name: $name";
	file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' [' . $_SERVER['REMOTE_ADDR'] . "] PvPetris sendScore fail: Hash is not identical", FILE_APPEND);
	exit();
}

//check main database
$opt = array(
	PDO::ATTR_ERRMODE	     => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
try {
	$pdo = new PDO($ini['connection'], $ini['dbuser'], $ini['dbpw'], $opt);
} catch (PDOException $e) {
	http_response_code(500);
	echo "Internal error, send report to @Sooslick";
	file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' PvPetris sendScore fail: db connect error. ' . strval($e), FILE_APPEND);
	exit();
}

//fix body
$sqlName = str_replace("'", "\'", $name);
//insert score
$request = 'INSERT INTO PVPETRIS (NAME, SCORE, BURN, STARTLEVEL, TTR) VALUES ("'.$sqlName.'", '.$score.', '.$burn.', '.$startlevel.', '.$ttr.')';
try {
	$q = $pdo->query($request);
} catch (PDOException $e) {
	http_response_code(500);
	echo "Internal error, send report to @Sooslick";
	file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' [' . $_SERVER['REMOTE_ADDR'] . "] PvPetris sendScore fail: db query error, name $name \n" . strval($e), FILE_APPEND);
	exit();
}

//log result
echo "ok";
file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' [' . $_SERVER['REMOTE_ADDR'] . "] PvPetris sendScore by $name", FILE_APPEND);
?>