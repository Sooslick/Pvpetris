# Pvpetris

PvPetris is a regular Tetris game based on classic NES version. 
We developed it being inspired by [Classic Tetris World Championship](https://thectwc.com/) 
and the main feature of this game is multiplayer: play PvPetris with friend in real time!

[Download page](https://pvpetris.myhmd.ru/)

### Prerequisites

1. Game Maker: Studio v1.4.9999 (GM:S is outdated however)
2. Any web server (Nginx works fine for me)
3. MySQL Database
4. PHP 5

### Building from source code

1. Prepare DB and create table "PVPETRIS" using script [web/create_table.sql](web/create_table.sql)
2. Change properties in [config.ini](config.ini) to your own
3. Run `php -f install.php`
4. Set frontend directory as root directory for web server
5. Compile Pvpetris.gmx in GameMaker Studio