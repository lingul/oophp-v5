<?php

namespace ligm19\Dice;

/**
 * A dicehand, consisting of dice.
 */
class DiceGame
{
    /**
     * @var DicePlayer  $players   Array consisting of players.
     * @var Dice        $turnDie   Single die used to determine starting turn order.
     * @var int         $turn      Which player is currently acting.
     * @var int         $turnScore The score of the current turn.
     * @var bool        $finished  Whether or not the game has ended.
     */

    const WIN_SCORE = 100;

    // private $player;
    // private $computer;
    private $players;
    private $turnDie;
    private $turn;
    private $turnScore;
    private $finished;

    /**
     * Constructor to initiate the dicehand with a number of dice.
     *
     * @param int $players Number of players in the game, defaults to two.
     * @param int $dice    Number of dice to create, defaults to two.
     */
    public function __construct(int $players = 2, int $dice = 2)
    {
        for ($i = 0; $i < $players; $i++) {
            $this->players[] = new DicePlayer($dice);
        }
        $this->turnDie = new DiceGraphic();

        $this->initGame();
    }

    /**
     * Initialize a new game.
     *
     * @return void.
     */
    public function initGame()
    {
        $this->turnScore = 0;
        $this->finished = false;

        $rolls = [];
        $graphics = [];

        for ($i = 0; $i < sizeof($this->players); $i++) {
            $this->turnDie->roll();
            $rolls[$i] = $this->turnDie->getLastRoll();
            $graphics[$i] = $this->turnDie->graphic();
        }

        // Kind of a lazy solution, first player will always win ties
        $this->turn = array_search(max($rolls), $rolls);
    }

    /**
     * Get status of game.
     *
     * @return bool.
     */
    public function getStatus()
    {
        return $this->finished;
    }

    /**
     * Get all dice belonging to a player.
     *
     * @param int $player Which player to get info for.
     *
     * @return array.
     */
    public function getDice(int $player)
    {
        return $this->players[$player]->getDice();
    }

    /**
     * Get whose turn it is.
     *
     * @return int.
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Get a player's score.
     *
     * @param int $player Which player to get info for.
     *
     * @return int.
     */
    public function getScore(int $player)
    {
        return $this->players[$player]->getScore();
    }

    /**
     * Get score of current turn.
     *
     * @return int.
     */
    public function getTurnScore()
    {
        return $this->turnScore;
    }

    /**
     * Get score of current turn.
     *
     * @return int.
     */
    public function getHistogram(int $player)
    {
        return $this->players[$player]->histogram();
    }

    /**
     * Finish a turn.
     *
     * @param int $player Which player to end turn for.
     *
     * @return void.
     */
    public function endTurn(int $player)
    {
        if ($this->finished || $this->turn !== $player) {
            return;
        }

        $this->players[$player]->addScore($this->getTurnScore());

        if ($this->players[$player]->getScore() >= DiceGame::WIN_SCORE) {
            $this->finished = true;
        }

        if ($player >= sizeof($this->players) - 1) {
            $this->turn = 0;
        } else {
            $this->turn += 1;
        }

        $this->players[$this->turn]->clear();
        $this->turnScore = 0;
    }

    /**
     * Roll all dice.
     *
     * @param int $player Which player to roll for.
     *
     * @return void.
     */
    public function doRoll(int $player)
    {
        if ($this->finished || $this->turn !== $player) {
            return;
        }

        $res = $this->players[$player]->doRoll();

        if (!$res) {
            $this->turnScore = 0;
            $this->endTurn($player); // Change turn to player if any 1s were rolled.
        } else {
            $this->turnScore += array_sum($this->getDice($player)["values"]);
        }
    }
}
