<?php

namespace Anax\Hundra;

interface GameInterface
{
    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie();

    /**
    * Prints the serie.
    *
    * @return string containing the serie in numerical order.
    */
    public function printHistogram();
}
