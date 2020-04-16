<?php

namespace ligm19\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class GuessExceptionTest extends TestCase
{
    /**
     * Construct object and make guess out of bounds. Use no arguments.
     */
    public function testInvalidGuess()
    {
        $this->expectException(GuessException::class);
        $guess = new Guess();

        $guess->makeGuess(200);
    }


    /**
     * Construct object and make guess out of bounds. Use no arguments.
     */
    public function testCreateObjectInvalidFirstArgument()
    {
        $this->expectException(GuessException::class);
        new Guess(200);
    }


    /**
     * Construct object and make guess out of bounds. Use no arguments.
     */
    public function testCreateObjectInvalidSecondArgument()
    {
        $this->expectException(GuessException::class);
        new Guess(42, 0);
    }
}
