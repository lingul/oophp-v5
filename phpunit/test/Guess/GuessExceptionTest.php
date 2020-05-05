<?php

namespace ligm19\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class GuessCreateObjectTestException extends TestCase
{

  /**
  *
  * Construct object & test the exception thrown
  *
  */

  // SOLUTION FROM: https://thephp.cc/news/2016/02/questioning-phpunit-best-practices

  /**
     *
     * @expectedException \ligm19\Guess\GuessException
     *
     *
     */
    public function testExpectedExceptionIsRaised()
    {
        $guess = new Guess(7, 1);
        $this->assertInstanceOf("\ligm19\Guess\Guess", $guess);

        $exc = new GuessException();
        $this->assertInstanceOf("\ligm19\Guess\GuessException", $exc);

        $guess->makeGuess(200);
    }
}
