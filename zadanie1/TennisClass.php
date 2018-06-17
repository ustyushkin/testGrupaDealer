<?php
include 'TennisInterface.php';
class TennisClass implements TennisInterface
{
  private $player1;
  private $player2;
  function __construct($player1,$player2)
  {
    if (($player1 instanceof PlayerInterface)&&($player2 instanceof PlayerInterface))
    {
      $this->player1=$player1;
      $this->player2=$player2;
    }
    else
    {
        throw new \InvalidArgumentException('Not instance of PlayerInterface');
    }
  }
  function score():string
  {
    $score1 = $this->player1->getPoints();
    $score2 = $this->player2->getPoints();
    $advantage = "Advantage: ";
    $winner = "Winner: ";
    if (($score1==0)||($score2==0)){
      switch (abs($score1-$score2))
      {
        case 0:
          return "Love";
        case 1:
          return "Fifteen-Love";
        case 2:
          return "Thirty-Love";
        case 3:
          return "Forty-Love";
      }
    };
    if ($score1==$score2){
      switch (abs($score1))
      {
        case 0:
          return "Love";
        case 1:
          return "Fifteen-All";
        case 2:
          return "Thirty-All";
        case 3:
          return "Forty-All";
      }
    };
    if ($score1==$score2)
    {
      return "Deuce";
    };
    if (abs($score1-$score2)==1)
    {
      return intval($score1)>intval($score2)?$advantage.$this->player1->getName():$advantage.$this->player2->getName();
    };
    if (abs($score1-$score2)>=2)
    {
      return intval($score1)>intval($score2)?$winner.$this->player1->getName():$winner.$this->player2->getName();
    };
  }
}
 ?>
