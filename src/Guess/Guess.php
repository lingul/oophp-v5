<?php

namespace ligm19\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $GUESS_MIN The minimum number that can be guessed from.
     * @var int $GUESS_MAX The maximum number that can be guessed from.
     */
    const GUESS_MIN = 1;
    const GUESS_MAX = 100;

    /** @var int    $number    The current secret number. */
    private $number;
    /** @var int    $tries     Number of tries a guess has been made. */
    private $tries;
    /** @var int    $maxTries  Max number of tries allowed. */
    private $maxTries;
    /** @var int    $recent    The most recent guess made. */
    private $recent;
    /** @var string $state     State of the game. */
    private $state;
    /** @var string $gameId    The id of the game. */
    private $gameId;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @throws Exception if number is outside of range GUESS_MIN-GUESS_MAX and not -1 or
     * tries is less than 1.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries which can be made.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        /**
         * Initiate the game with the specified secret number or a random one if
         * none is specified, throw an Exception if an invalid number is provided.
         */
        if ($number === -1) {
            $this->random();
        } elseif ($number < Guess::GUESS_MIN || $number > Guess::GUESS_MAX) {
            throw new GuessException("Number must be between {Guess::GUESS_MIN}-{Guess::GUESS_MAX} or -1 to randomize.");
        } else {
            $this->number = $number;
            $this->tries = 0;
            $this->state = "INITIATED";
            $this->recent = 0;
        }

        /**
         * Initiate the game with specified number of tries, throw an Exception if
         * tries fewer than 1.
         */
        if ($tries < 1) {
            throw new GuessException("Tries must be greater than 1.");
        } else {
            $this->maxTries = $tries;
        }

        /**
         * Create the game id.
         */
        $hash = hash_init("sha256");
        hash_update($hash, rand());
        $this->gameId = hash_final($hash);
    }



    /**
     * Randomize the secret number between 1 and 100 and reset number of tries made
     * to initiate a new game.
     *
     * @return void
     */
    public function random()
    {
        $this->number = rand(Guess::GUESS_MIN, Guess::GUESS_MAX);
        $this->tries = 0;
        $this->state = "INITIATED";
        $this->recent = 0;
    }



    /**
     * Get number of tries left.
     *
     * @return int as number of tries left.
     */
    public function tries()
    {
        return $this->maxTries - $this->tries;
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
     * Get the game id.
     *
     * @return string as game id.
     */
    public function gameId()
    {
        return $this->gameId;
    }



    /**
     * Get the game state.
     *
     * @return string as game state.
     */
    public function state()
    {
        return $this->state;
    }



    /**
     * Get most recent guess.
     *
     * @return int last guess.
     */
    public function recent()
    {
        return $this->recent;
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @param int $number The number being guessed.
     *
     * @return string to show the state of the guess made.
     */
    public function makeGuess($number)
    {
        $state = $this->state();

        /**
         * Check if game is still active.
         */
        if ($state === "NO_TRIES" || $state === "CORRECT_GUESS") {
            return $state;
        }

        /**
         * Check if guess is in valid range.
         */
        if ($number < Guess::GUESS_MIN || $number > Guess::GUESS_MAX) {
            throw new GuessException("INVALID_GUESS");
            return $state;
        }

        /**
         * Increase number of tries and set recent guess.
         */
        $triesLeft = $this->maxTries - ++$this->tries;
        $this->recent = $number;

        /**
         * Determine if guess is too low, too high or correct and return
         * the appropriate string.
         */
        if ($number > $this->number) {
            $this->state = "HIGH_GUESS";
        } else if ($number < $this->number) {
            $this->state = "LOW_GUESS";
        } else {
            $this->state = "CORRECT_GUESS";
        }

        if ($triesLeft <= 0 && $this->state !== "CORRECT_GUESS") {
            $this->state = "NO_TRIES";
        }

        return $this->state;
    }
}
