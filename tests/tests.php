<?php
require __DIR__ . "/../zadanie1/TennisClass.php";
require __DIR__ . "/../zadanie1/PlayerClass.php";
class paramsTest extends \PHPUnit\Framework\TestCase
{
  private $player1;
  private $player2;
  private $game;
  private $testNamePlayer1;
  private $testNamePlayer2;
  protected function setUp(){
    $this->testNamePlayer1 = "Bob Claster";
    $this->testNamePlayer2 = "John McKalister";
    $this->player1 = new PlayerClass($this->testNamePlayer1,0);
    $this->player2 = new PlayerClass($this->testNamePlayer2,0);
    $this->game = new TennisClass($this->player1,$this->player2);
  }
  public function myEcho()
  {
    echo "\n".$this->player1->getPoints()."-".$this->player2->getPoints()."=>".$this->game->score();
  }
  public function test_scores_a_0_0_game()
  {
    $this->assertEquals($this->game->score(), 'Love');
  }
  public function test_scores_a_1_0_game()
  {
    $this->player1->earnPoints(1);
    $this->player2->earnPoints(0);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Fifteen-Love');
  }
  public function test_scores_a_2_0_game()
  {
    $this->player1->earnPoints(2);
    $this->player2->earnPoints(0);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Thirty-Love');
  }
  public function test_scores_a_3_0_game()
  {
    $this->player1->earnPoints(3);
    $this->player2->earnPoints(0);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Forty-Love');
  }
  public function test_scores_a_4_0_game()
  {
    $this->player1->earnPoints(4);
    $this->player2->earnPoints(0);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Winner: '.$this->testNamePlayer1);
  }
  public function test_scores_a_4_3_game()
  {
    $this->player1->earnPoints(4);
    $this->player2->earnPoints(3);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Advantage: '.$this->testNamePlayer1);
  }
  public function test_scores_a_4_4_game()
  {
    $this->player1->earnPoints(4);
    $this->player2->earnPoints(4);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Deuce');
  }
  public function test_scores_a_3_3_game()
  {
    $this->player1->earnPoints(3);
    $this->player2->earnPoints(3);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Forty-All');
  }
  public function test_scores_a_2_2_game()
  {
    $this->player1->earnPoints(2);
    $this->player2->earnPoints(2);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Thirty-All');
  }
  public function test_scores_a_1_1_game()
  {
    $this->player1->earnPoints(1);
    $this->player2->earnPoints(1);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Fifteen-All');
  }
  public function test_scores_a_5_5_game()
  {
    $this->player1->earnPoints(5);
    $this->player2->earnPoints(5);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Deuce');
  }
  public function test_scores_a_5_6_game()
  {
    $this->player1->earnPoints(5);
    $this->player2->earnPoints(6);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Advantage: '.$this->testNamePlayer2);
  }
  public function test_scores_a_7_6_game()
  {
    $this->player1->earnPoints(7);
    $this->player2->earnPoints(6);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Advantage: '.$this->testNamePlayer1);
  }
  public function test_scores_a_5_7_game()
  {
    $this->player1->earnPoints(5);
    $this->player2->earnPoints(7);
    $this->myEcho();
    $this->assertEquals($this->game->score(), 'Winner: '.$this->testNamePlayer2);
  }
}
