<?php

namespace Anax\Hundra;

trait GameTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    protected $serie = [];

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }

    public function printHistogram()
    {
        $array = $this->serie;
        for ($i = 1; $i < 7; $i++) {
            $string = "";
            foreach ($array as $value) {
                if ($value == $i) {
                    $string = $string . "*";
                }
            }
            echo $i . ": " . $string . "<br>";
        }
    }
}
