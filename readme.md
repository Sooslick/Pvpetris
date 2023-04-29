# Pvpetris

PvPetris is a regular Tetris game based on classic NES version. 
We developed it being inspired by [Classic Tetris World Championship](https://thectwc.com/) 
and the main feature of this game is multiplayer: play PvPetris with friend in real time!

[Download page](http://sooslick.itpony.ru/pvpetris/)

### Building from source code

1. Prepare DB and create table "PVPETRIS" using script [web/create_table.sql]
2. Change properties in [config.ini] to your own
3. Run `php -f install.php`
4. Set frontend directory as root directory for web server
5. Compile Pvpetris.gmx in GameMaker Studio