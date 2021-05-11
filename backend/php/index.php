<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<html>
<body>
<center>
<h1>PvPetris score table</h1>
<table width="900" cellspacing="0">
<tr>
<th width="5%">PLACE</th>
<th width="30%">NAME</th>
<th width="20%">SCORE</th>
<th width="20%">LINES</th>
<th width="20%">TTR%</th>
<th width="5%">START LEVEL</th>
<tr>

<?php
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
$request = 'SELECT * FROM PVPETRIS ORDER BY SCORE DESC LIMIT 100';
$q = $pdo->query($request);
$i = 1;
while ($row = $q->fetch()) {
	echo "<tr>";
	echo "<td>".$i."</td>";
	$nam = $row['NAME'];
	$nam = str_replace("<", "&lt;", $nam);
	$nam = str_replace(">", "&gt;", $nam);
	echo "<td>".$nam."</td>";
	echo "<td>".$row['SCORE']."</td>";
	echo "<td>".$row['BURN']."</td>";
	$ttr = $row['TTR'];
	if (empty($ttr)) {$ttr = "N/D";}
	elseif ($ttr < 0) {$ttr = "N/D";}
	else $ttr = round($ttr / $row['BURN'] * 100, 2);
	echo "<td>".$ttr."</td>";
	echo "<td>".$row['STARTLEVEL']."</td>";
	echo "</tr>";
	$i++;
	}
?>

</table>
</center>
</body>
</html>
