<?php
include 'src/src.php';
include 'src/Monster.php';
include 'src/Hero.php';
$stats=include 'config/config.php'; 

//error display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//set Hero stats and abilities and Monster Stats
foreach($stats as $pStats)
{
    if(ISSET($pStats['heroHP']))
    {
        $julien = new Hero(rand($pStats['heroHP']['min'],$pStats['heroHP']['max']),rand($pStats['heroStrength']['min'],$pStats['heroStrength']['max']),
                           rand($pStats['heroDefence']['min'],$pStats['heroDefence']['max']),rand($pStats['heroSpeed']['min'],$pStats['heroSpeed']['max']),
                           rand($pStats['heroLuck']['min'],$pStats['heroLuck']['max']));
    }
    if(ISSET($pStats['monsterHP']))
    {
        $monster = new Monster(rand($pStats['monsterHP']['min'],$pStats['monsterHP']['max']),rand($pStats['monsterStrength']['min'],$pStats['monsterStrength']['max']),
                              rand($pStats['monsterDefence']['min'],$pStats['monsterDefence']['max']),rand($pStats['monsterSpeed']['min'],$pStats['monsterSpeed']['max']),
                              rand($pStats['monsterLuck']['min'],$pStats['monsterLuck']['max']));
    }
}

//create a new Battle and start the game
include 'src/gameRun.php';
$startGame=new Battle($julien, $monster);
$startGame->displayStats();
$startGame->startBattle();
