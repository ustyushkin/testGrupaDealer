<?php
interface TennisInterface {
  function __construct($player1, $player2);
  /**
  * Zwraca wynik meczu
  */
  function score():string;
}
