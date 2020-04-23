<?php

namespace ligm19\Dice;

/**
 * A dicehand, consisting of dice.
 */
class DiceHandHistogram extends DiceHand implements HistogramInterface
{
    use HistogramTrait;

    /**
     * Roll all dice save their value.
     *
     * @return void.
     */
    public function roll()
    {
        foreach (parent::roll() as $roll) {
            $this->serie[] = $roll;
        }

        return $this->values();
    }
}
