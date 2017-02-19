<?php

namespace Cysha\Casino\Cards\Evaluators;

use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Contracts\CardEvaluator;
use Cysha\Casino\Cards\Contracts\CardResults;
use Cysha\Casino\Cards\Hand;
use Cysha\Casino\Cards\HandCollection;
use Cysha\Casino\Cards\ResultCollection;

class StandardEvaluator implements CardEvaluator
{
    /**
     * @param CardCollection $board
     * @param Hand           $hand
     *
     * @return SevenCardResult
     */
    public static function evaluate(CardCollection $board, Hand $hand): CardResults
    {
    }

    /**
     * @param CardCollection $board
     * @param HandCollection $playerHands
     *
     * @return SevenCardResultCollection
     */
    public function evaluateHands(CardCollection $board, HandCollection $playerHands): ResultCollection
    {
    }
}
