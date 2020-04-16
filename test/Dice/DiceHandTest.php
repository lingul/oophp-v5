<?php

namespace ligm19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\ligm19\Dice\DiceHand", $dicehand);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testSumMatchesValues()
    {
        $dicehand = new DiceHand();
        $dicehand->roll();

        $res = $dicehand->sum();
        $exp = array_sum($dicehand->values());
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testAverage()
    {
        $dicehand = new DiceHand();
        $dicehand->roll();

        $res = $dicehand->average();
        $exp = $dicehand->sum() / sizeof($dicehand->values());
        $this->assertEquals($exp, $res);
    }
}
