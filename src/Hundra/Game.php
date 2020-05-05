<?php

namespace Anax\Hundra;

class Game extends Dice
{
    /**
    * @var array $playerScore The score before for one round
    * @var array $savedScore The total score
    * @var array $activePlayer Which player is active
    * @var array $turn The starter score used to determine who starts the game
    * @var int $player Player start score
    * @var int $comp Computer start score
    * @var object $dice The dice object
    * @var int $players How many players
    */
    public $playerScore = [0, 0];
    public $savedScore = [0, 0];
    public $activePlayer = [0, 0];
    public $turn = [0, 0];
    public $player = 0;
    public $comp = 0;
    private $dice;
    public $players;

    public function __construct(int $players = 2)
    {
        $this->dice = new Dice();
        $this->players = $players;
        $this->player = rand(1, 6);
        $this->comp = rand(1, 6);
    }

    /**
    * Function used to determine who starts the game
    *
    * @return string
    */
    public function getStarter()
    {
        $this->turn[0] = $this->player;
        $this->turn[1] = $this->comp;

        if ($this->turn[0] > $this->turn[1]) {
            $this->activePlayer[0] = 1;
            return "Spelaren slog en: " . $this->player . " och datorn slog: " . $this->comp . " så spelaren börjar.";
        } elseif ($this->turn[0] < $this->turn[1]) {
            $this->activePlayer[1] = 1;
            return "Datorn slog en: " . $this->comp . " och spelaren slog: " . $this->player . " så datorn börjar.";
        } elseif ($this->player == $this->comp) {
            getStarter();
        }
    }

    /**
    * Function used to get which player is throwing the dice and if a one is thrown
    *
    * @return string
    */
    public function diceValue()
    {
        if ($this->activePlayer[0] == 1) {
            if ($this->getDice() == 1) {
                $this->playerScore[0] = 0;
                $this->activePlayer[0] = 0;
                $this->activePlayer[1] = 1;
                return "Du slog en etta så turen går vidare och du förlorar din poäng.";
            }
            return "Spelare 1 slog: " . $this->getDice();
        } elseif ($this->activePlayer[1] == 1) {
            for ($i = 0; $i < 3; $i++) {
                $this->throwDice();
                $this->getScore();
                if ($this->getDice() == 1) {
                    $this->playerScore[1] = 0;
                    $this->activePlayer[1] = 0;
                    $this->activePlayer[0] = 1;
                    return "Datorn slog en etta så turen går vidare och den förlorar sin poäng.";
                }
                $this->saveScore();
                return "Datorn slog sina slag och har nu: " . $this->savedScore[1] . " poäng.";
            }
        }
    }

    /**
     * Save the score for the turn
     *
     * @return void
     */
    public function getScore()
    {
        if ($this->activePlayer[0] == 1) {
            $this->playerScore[0] = $this->playerScore[0] + $this->getDice();
        } elseif ($this->activePlayer[1] == 1) {
            $this->playerScore[1] = $this->playerScore[1] + $this->getDice();
        }
    }

    /**
    * Save the score to another array
    *
    * @return void
    */
    public function saveScore()
    {
        if ($this->activePlayer[0] == 1) {
            $this->savedScore[0] = $this->savedScore[0] + $this->playerScore[0];
            $this->playerScore[0] = 0;
            $this->activePlayer[0] = 0;
            $this->activePlayer[1] = 1;
        } elseif ($this->activePlayer[1] == 1) {
            $this->savedScore[1] = $this->savedScore[1] + $this->playerScore[1];
            $this->playerScore[1] = 0;
            $this->activePlayer[1] = 0;
            $this->activePlayer[0] = 1;
        }
    }
}
