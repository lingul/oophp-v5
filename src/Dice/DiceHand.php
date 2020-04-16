<?php

namespace ligm19\Dice;

/**
 * A dicehand, consisting of dice.
 */
class DiceHand
{
    /**
     * @var Dice    $dice      Array consisting of dice.
     * @var int     $values    Array consisting of last roll of the dice.
     * @var string  $graphics  Array consisting of last roll of the dice.
     */
    private $dice;
    private $values;
    private $graphics;

    /**
     * Constructor to initiate the dicehand with a number of dice.
     *
     * @param int $dice Number of dice to create, defaults to five.
     */
    public function __construct(int $dice = 5)
    {
        $this->dice  = [];
        $this->values = [];
        $this->graphics = [];

        for ($i = 0; $i < $dice; $i++) {
            $this->dice[]  = new DiceGraphic();
            $this->values[] = null;
        }
    }

    /**
     * Roll all dice save their value.
     *
     * @return array with values of the last roll.
     */
    public function roll()
    {
        $this->values = [];
        $this->graphics = [];

        foreach ($this->dice as $die) {
            $die->roll();
            $this->values[] = $die->getLastRoll();
            $this->graphics[] = $die->graphic();
        }

        return $this->values;
    }

    /**
     * Clear all dice.
     *
     * @return void.
     */
    public function clear()
    {
        $this->values = [];
        $this->graphics = [];
    }

    /**
     * Get values of dice from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Get graphics of dice from last roll.
     *
     * @return array with values of the last roll.
     */
    public function graphics()
    {
        return $this->graphics;
    }

    /**
     * Get the sum of all dice.
     *
     * @return int as the sum of all dice.
     */
    public function sum()
    {
        return array_sum($this->values);
    }

    /**
     * Get the average of all dice.
     *
     * @return float as the average of all dice.
     */
    public function average()
    {
        return $this->sum() / sizeof($this->values);
    }
}
