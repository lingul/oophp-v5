<?php

namespace ligm19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\ligm19\Dice\Dice", $dice);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testRoll()
    {
        $dice = new Dice();
        $res = $dice->roll();
        $this->assertTrue($res >= 1 && $res <= 6);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testGetLastRoll()
    {
        $dice = new Dice();
        $dice->roll();
        $res = $dice->getLastRoll();
        $this->assertTrue($res >= 1 && $res <= 6);
    }
}
