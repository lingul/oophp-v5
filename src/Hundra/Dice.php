<?php

namespace Anax\Hundra;

/**
 * Dice class used when you roll the dice.
 */
class Dice
{
    /**
     * @var int $value   The value of the first dice.
     * @var int $score   The score if the first player.
     * @var int $players Them amount of players.
     */
    public $value;
    private $dices;

    public function __construct(int $dices = 2)
    {
        $this->dices = $dices;
    }

    /**
     * Roll the dice, randomize number between 1 and 6.
     *
     * @return void
     */
    public function throwDice()
    {
        $this->value = rand(1, 6);
    }

    /**
    * Get the value from the thrown dice
    * @return int
    */
    public function getDice()
    {
        return $this->value;
    }
}
