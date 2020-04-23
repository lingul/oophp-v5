<?php

namespace ligm19\Dice;

/**
 * A dicehand, consisting of dice.
 */
class DicePlayer
{
    /**
     * @var Dice $dice   Array consisting of dice.
     * @var int  $score  Player's current score.
     */
    private $dice;
    private $histogram;
    private $score;

    /**
     * Constructor to initiate the dicehand with a number of dice.
     *
     * @param int $dice Number of dice to create, defaults to five.
     */
    public function __construct(int $dice = 5)
    {
        $this->dice = new DiceHandHistogram($dice);
        $this->histogram = new Histogram();
        $this->score = 0;
    }

    /**
     * Get player's score.
     *
     * @return int.
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Get the values and graphics of all dice.
     *
     * @return array.
     */
    public function getDice()
    {
        return [
            "values" => $this->dice->values(),
            "graphics" => $this->dice->graphics()
        ];
    }

    /**
     * Add score after a round.
     *
     * @param int $score How much score to add.
     *
     * @return void.
     */
    public function addScore(int $score)
    {
        $this->score += $score;
    }

    /**
     * Roll all dice.
     *
     * @return bool.
     */
    public function doRoll()
    {
        $this->dice->roll();
        $this->histogram->injectData($this->dice);

        foreach ($this->dice->values() as $die) {
            if ($die === 1) {
                return false;
            }
        }

        return true;
    }

    /**
     * Clear dice values after a round.
     *
     * @return void.
     */
    public function clear()
    {
        $this->dice->clear();
    }



    /**
     * Clear dice values after a round.
     *
     * @return void.
     */
    public function histogram()
    {
        return $this->histogram->getAsText();
    }
}
