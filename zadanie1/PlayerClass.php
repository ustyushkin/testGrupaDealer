<?php
include 'PlayerInterface.php';
class PlayerClass implements PlayerInterface
{
  private $name;
  private $points;
  function __construct(string $name, int $points)
  {
    $this->name = $name;
    $this->points = $points;
  }
  function earnPoints(int $points)
  {
    $this->points = $points;
  }
  function getName():string
  {
    return $this->name;
  }
  function getPoints():int
  {
    return $this->points;
  }
}
 ?>
