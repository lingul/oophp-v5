<?php

namespace ligm19\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class Dice
{
    /**
     * Constructor to create a die.
     *
     * @param int $sides  The number of sides on the die.
     */
    public function __construct($sides = 6)
    {
        $this->sides = $sides;
        $this->value = 0;
    }

    /**
     * @var int   $sides  The number of sides on the die.
     * @var int   $value  The value of the last roll.
     */
    private $sides;
    protected $value;


    /**
     * Roll the die.
     *
     * @return int the value of the rolled dice.
     */
    public function roll()
    {
        $this->value = rand(1, $this->sides);

        return $this->value;
    }

    /**
     * Get last roll value.
     *
     * @return int.
     */
    public function getLastRoll()
    {
        return $this->value;
    }
}
