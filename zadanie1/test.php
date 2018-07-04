<?php
include 'TennisClass.php';
include 'PlayerClass.php';

//real test in tests catalog

$player1 = new PlayerClass('Bob Claster',5);
$player2 = new PlayerClass('John McKalister',7);
$game = new TennisClass($player1,$player2);
echo $game->score();
 ?>
