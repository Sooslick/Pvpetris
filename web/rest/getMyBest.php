<?php
$ini = parse_ini_file("${backendLocation}/config.ini");
$logFname = "${backendLocation}/" . $ini['logFileName'];

//check _GET parameters
$name = '';
if (isset($_GET['name'])) 
	$name = $_GET['name'];
else {
	http_response_code(400);
	echo "No name passed.";
	file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' [' . $_SERVER['REMOTE_ADDR'] . '] PvPetris getMyBest fail: no name passed', FILE_APPEND);
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
	file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' PvPetris getMyBest fail: db connect error. ' . strval($e), FILE_APPEND);
	exit();
}

//fix name
$sqlName = str_replace("'", "\'", $name);
//insert score
try {
	$myQ = $pdo->query("SELECT MAX(SCORE) MYSCORE, MAX(BURN) MYBURN FROM PVPETRIS WHERE NAME = '$sqlName'");
	$wrQ = $pdo->query("SELECT MAX(SCORE) MAXSCORE, MAX(BURN) MAXBURN FROM PVPETRIS");
} catch (PDOException $e) {
	http_response_code(500);
	echo "Internal error, send report to @Sooslick";
	file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' [' . $_SERVER['REMOTE_ADDR'] . "] PvPetris getMyBest fail: db query error, name $name \n" . strval($e), FILE_APPEND);
	exit();
}

//log result
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
file_put_contents($logFname, PHP_EOL . date('d.m.y H:i:s') . ' [' . $_SERVER['REMOTE_ADDR'] . "] PvPetris getScore by $name", FILE_APPEND);
?>