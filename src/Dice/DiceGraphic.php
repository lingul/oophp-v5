<?php

namespace ligm19\Dice;

/**
 * Showing off a standard class with methods and properties.
 */
class DiceGraphic extends Dice
{
    /**
     * @var integer SIDES Number of sides of the Dice.
     */
    const SIDES = 6;

    /**
     * Constructor to initiate the die with six number of sides.
     */
    public function __construct()
    {
        parent::__construct(self::SIDES);
    }

    /**
    * Get a graphic value of the last rolled dice.
    *
    * @return string as graphical representation of last rolled dice.
    */
    public function graphic()
    {
        return "die-" . $this->value;
    }
}
