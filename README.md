Esirith
=======

Esirith will be an rpg-like boardgame-like multiplayer browser based game (wow! .. many tags came along), that will be the sequel of a Neverwinter Nights custom server that I made (with many help) many years ago.

It's developed with Symfony 2.

Game-wise, the idea will be unique games that will have a start and end like a board game but for many days/weeks, where each cycle (every night or so) some things will happen. 

You will be able to create an adventurer, level up, loot, buy, hire companions and so many rpg-like features.


### Features

- **World auto-generation**: games have and start and end (time-based)
- **Multi-world**: you can all the games you want
- **RPG characters**: level up, improve abilities
- **Combat**: fight with monsters and big bosses
- **Map**: you can move around the map, enter villages and dungeons
- **Shop system**: buy new armor and weapons, sell your loot
- **Inventory system**: you can manage all the items of your character
- **Raid system**: team up with other players to defeat the Evil Boss
- **Hidden treasure system**: discover treasures around the map. Only if you are lucky enough!
- **Permadeath**: your character only have one life. You can have a rooster of heroes!
- **Companion system**: acquire new adventures to help you with quest and with in-combat skills
- **Boss system**: There is AI that every turn (time-based), attack villages, players and move around the map


### Install

You can install this game like any other Symfony2 project. I provided a script to make it easy for you and some fixtures to start with minimum data on your db.

    php composer.phar install
    sh upcode.sh
    php app/console doc:fix:load

"upcode.sh" is just for a quick-easy install. If you want to install it right, follow the official Symfony guide in order to have the right permissions.