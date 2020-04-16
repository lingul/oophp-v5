<?php

namespace ligm19\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class GuessCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $guess = new Guess();
        $this->assertInstanceOf("\ligm19\Guess\Guess", $guess);

        $res = $guess->gameId();
        $res = $guess->tries();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use only first argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\ligm19\Guess\Guess", $guess);

        $res = $guess->tries();
        $exp = 6;
        $this->assertEquals($exp, $res);

        $res = $guess->number();
        $exp = 42;
        $this->assertEquals($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Use both arguments.
     */
    public function testCreateObjectBothArguments()
    {
        $guess = new Guess(42, 7);
        $this->assertInstanceOf("\ligm19\Guess\Guess", $guess);

        $res = $guess->tries();
        $exp = 7;
        $this->assertEquals($exp, $res);

        $res = $guess->number();
        $exp = 42;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object, make guess and verify that the object has the expected
     * properties. Use only first argument, make correct guess.
     */
    public function testMakeGuessCorrect()
    {
        $guess = new Guess(42);

        $res = $guess->makeGuess(42);
        $exp = "CORRECT_GUESS";
        $this->assertEquals($exp, $res);

        $res = $guess->recent();
        $exp = 42;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object, make guess and verify that the object has the expected
     * properties. Use only first argument, make guess too high.
     */
    public function testMakeGuessHigh()
    {
        $guess = new Guess(42);

        $res = $guess->makeGuess(84);
        $exp = "HIGH_GUESS";
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object, make guess and verify that the object has the expected
     * properties. Use only first argument, make guess too low.
     */
    public function testMakeGuessLow()
    {
        $guess = new Guess(42);

        $res = $guess->makeGuess(21);
        $exp = "LOW_GUESS";
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object, make guess and verify that the object has the expected
     * properties. Use both arguments, make guess.
     */
    public function testMakeGuessNoTries()
    {
        $guess = new Guess(42, 1);

        $res = $guess->makeGuess(21);
        $exp = "NO_TRIES";
        $this->assertEquals($exp, $res);

        $res = $guess->tries();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $guess->makeGuess(21);
    }
}
