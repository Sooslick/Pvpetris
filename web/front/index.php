<!doctype html>
<HTML>
<HEAD>
<TITLE>PvPetris</TITLE>
<meta charset='utf-8' />
<meta http-equiv='Content-Type' content='text/html' />
<meta name='author' content='Sooslick' />
<meta name='description' content='A famous puzzle game with multiplayer' />
<meta name='theme-color' content='black' />
<link rel='stylesheet' href='assets/pvpetrisStyles.css' type='text/css' charset='utf-8' />
<link rel='icon' href='assets/petris.ico' type='image/x-icon' />
<meta property='og:type' content='website' />
<meta property='og:image' content='https://sooslick.art/resources/img/project/pvpetrisBig.jpg' />
</HEAD>

<BODY>
<div class='header-wrapper'>
<div class='header-background'></div>
<div class='header-content'>PvP Tetris</div>
</div>

<div class='download'>
<div class='download-header'>Current PvPetris version: ${version}</div>
<a href='/downloads/Pvpetris${version}.zip' target='_blank' download>Download 
<img src='/resources/img/downloadIcon.png' />
</a>
</div>

<div class="featuring"><p>
PvPetris is a regular Tetris game based on classic NES version.
We developed it being inspired by <a href="https://thectwc.com/">Classic Tetris World Championship</a> 
and the main feature of this game is multiplayer: play PvPetris with friend in real time!
</p>
<p>
How to host the game:<br />
1) Download and launch the game;<br />
2) Press "HOST" button, specify desired port, then press "ENABLE";<br />
3) Tell your IP and port to your friend. Press "START" when you are ready to game!
</p>
<p>
Support us on <a href="https://www.patreon.com/sooslick">Patreon</a>!<br />
Source code: <a href="https://github.com/Sooslick/Pvpetris">Github link</a>
</p>
</div>

<?php
include("scoreTable.php");
?>

<div id='ft' class='pt40'>
<hr />
<div id='bottom-info'><span id='copyrights'>&#169; 2013 - $year Sooslick.Art Project</span></div>
</div>

<div class="backstage">
</div>
<div class="backstage-almi">
<?
for ($i = 0; $i < 50; $i++) {
	$size = rand(2,5) * 0.2;
	$baseLeft = $i < 25 ? 12 : 88;
	$left = rand(-10, 10) + $baseLeft;
	$duration = rand(20, 40);
	$delay = rand(-20, 0);
	$imgIndex = rand(0, 6);
	$width = rand(50, 90);
	$direction = rand(0, 1) == 1 ? "normal" : "reverse";
	$hue = rand(0, 359);
	$spinDuration = rand(6, 18);
	echo "<div class='almi' style='--size: {$size}vw; left: {$left}vw; animation: snowfall {$duration}s linear infinite; animation-delay: {$delay}s;'><img src='assets/almiParts_{$imgIndex}.png' width='{$width}px' style='animation: spin {$spinDuration}s linear infinite; animation-delay: {$delay}s; animation-direction: {$direction}; filter: sepia(1) hue-rotate({$hue}deg) opacity(0.1);' draggable='false' /></div>";
}
?>
</div>
</body>
</html>