<?php

namespace ligm19\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $rolls = array_count_values($this->serie);
        $res = "";

        for ($i = $this->min; $i <= $this->max; $i++) {
            $res .= $i . ": ";
            if (isset($rolls[$i])) {
                for ($j = 0; $j < $rolls[$i]; $j++) {
                    $res .= "*";
                }
            }
            $res .= "\n";
        }

        return $res;
    }
}
