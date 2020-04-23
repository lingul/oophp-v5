<?php

namespace ligm19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceGameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateObject()
    {
        $dice = new DiceGame();
        $this->assertInstanceOf("\ligm19\Dice\DiceGame", $dice);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testStatus()
    {
        $dice = new DiceGame();

        $res = $dice->getStatus();
        $exp = false;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testRoll()
    {
        $dice = new DiceGame();

        $res = $dice->getTurn();
        $dice->doRoll($res);
        $res = $dice->getDice($res);
        $this->assertIsArray($res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testGetScore()
    {
        $dice = new DiceGame();

        $res = $dice->getTurn();
        $res = $dice->getScore($res);
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testGetHistogram()
    {
        $dice = new DiceGame();

        $res = $dice->getTurn();
        $dice->doRoll($res);
        $res = $dice->getHistogram($res);
        $this->assertIsString($res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testEndTurn()
    {
        $dice = new DiceGame();

        $res = $dice->getTurn();
        $this->assertTrue($res === 0 || $res === 1);
        $dice->endTurn($res);
    }
}
