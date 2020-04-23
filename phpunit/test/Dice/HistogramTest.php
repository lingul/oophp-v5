<?php

namespace ligm19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class HistogramTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateObject()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\ligm19\Dice\Histogram", $histogram);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testInjectAndGet()
    {
        $dice = new DiceHandHistogram(5);
        $histogram = new Histogram();

        $dice->roll();
        $histogram->injectData($dice);
        $res = $histogram->getSerie();
        $this->assertIsArray($res);
        $res = $histogram->getAsText();
        $this->assertIsString($res);
    }
}
