<?php

namespace Cysha\Casino\Cards\Contracts;

use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\HandCollection;

interface CardEvaluator
{
    /**
     * @param CardCollection $board
     * @param HandCollection $hands
     */
    public function evaluateHands(CardCollection $board, HandCollection $hands);
}
