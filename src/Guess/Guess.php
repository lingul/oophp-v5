<?php
/**
 * Guessing game.
 */

namespace ligm19\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var int $guess    Players guess.
     * @var string $doInit    Starts game.
     * @var string $doGuess    Make a guess.
     * @var string $doCheat    Show secret number.
     */
    public $number;
    public $tries;
    public $guess;
    public $doInit;
    public $doGuess;
    public $doCheat;



    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        $this->tries = $tries;
        $this->random();
    }

    /**
     * Set the string to start game.
     *
     * @param string $doInit Starts game.
     *
     * @return void
     */
    public function setInit(string $doInit)
    {
        $this->doInit = $doInit;
    }

    /**
     * Set the string to make guess.
     *
     * @param string $doGuess Make a guess.
     *
     * @return void
     */
    public function setGuess(string $doGuess)
    {
        $this->doGuess = $doGuess;
    }


    /**
     * Set the string to show secret number.
     *
     * @param string $doCheat Show secret number.
     *
     * @return void
     */
    public function setCheat(string $doCheat)
    {
        $this->doCheat = $doCheat;
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    private function random()
    {
        $this->number = rand(1, 100);
    }


    /**
     * Reset number of tries.
     *
     * @return void
     */
    public function resetTries()
    {
        $this->tries = 6;
    }



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries()
    {
        return $this->tries;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number()
    {
        return $this->number;
    }




    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     *
     * @param int $guess namber that has been guessed.
     */
    public function makeGuess(int $guess)
    {
        $res = "";
        if ($guess > 100 || $guess < 1) {
            throw new GuessException("Guess is not between 1 and 100.");
        } else {
            if ($this->doInit === "Start from beginning" || $this->number === -1) {
                //$res = $this->number;
                // Init the game.
                $this->random();
                $this->resetTries();
            } elseif ($this->doGuess) {
                // Do a guess.
                $this->tries -= 1;
                if ($guess === $this->number) {
                    $res = "CORRECT";
                } elseif ($guess > $this->number) {
                    $res = "TOO HIGH";
                } else {
                    $res = "TOO LOW";
                }
            }
        }
        return $res;
    }
}
