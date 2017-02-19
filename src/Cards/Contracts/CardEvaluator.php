<?php

namespace Cysha\Casino\Cards\Contracts;

use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Hand;
use Cysha\Casino\Cards\HandCollection;

interface CardEvaluator
{
    /**
     * @param CardCollection $board
     * @param Hand           $hand
     */
    public static function evaluate(CardCollection $board, Hand $hand): CardResults;

    /**
     * @param CardCollection $board
     * @param HandCollection $hands
     */
    public function evaluateHands(CardCollection $board, HandCollection $hands);
}
