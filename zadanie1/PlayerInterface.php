<?php
interface PlayerInterface {
  function __construct(string $name, int $points);
  /**
  * Przypisuje punkty graczowi
  */
  // without void, because I'm using 7.0, void is in 7.1
  function earnPoints(int $points);

  /**
  * Zwraca imię gracza
  */
  function getName():string;

  /**
  * Zwraca punkty gracza
  */
  function getPoints():int;
}
 ?>
