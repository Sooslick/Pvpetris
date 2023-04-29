<?php
$ini = parse_ini_file("config.ini");
$opt = array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
try {
	$pdo = new PDO($ini['connection'], $ini['dbuser'], $ini['dbpw'], $opt);
} catch (PDOException $e) {
	$ok = false;
	$err_string = 'Database error.';
}
if ($ok) {
$request = "DELETE p FROM PVPETRIS p 
	LEFT JOIN (SELECT NAME, MAX(SCORE) MAXSCORE, MAX(BURN) MAXBURN FROM PVPETRIS GROUP BY NAME) m ON (p.NAME = m.NAME) 
	WHERE p.SCORE != m.MAXSCORE AND p.BURN != m.MAXBURN;";
	$q = $pdo -> query($request);
	echo "ok";
	file_put_contents($ini['logFileName'], 
	PHP_EOL . date('d.m.y H:i:s') . ' PvPetris scores cleanup. Deleted rows: ' . strval($q -> rowCount()), FILE_APPEND);
	exit();
}
echo $err_string;
file_put_contents($ini['logFileName'], PHP_EOL . date('d.m.y H:i:s') . ' PvPetris scores cleanup: ' . $err_string, FILE_APPEND);
?>