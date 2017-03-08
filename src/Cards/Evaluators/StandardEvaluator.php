<?php

namespace Cysha\Casino\Cards\Evaluators;

use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Contracts\CardEvaluator;
use Cysha\Casino\Cards\Contracts\CardResults;
use Cysha\Casino\Cards\Hand;
use Cysha\Casino\Cards\HandCollection;
use Cysha\Casino\Cards\ResultCollection;
use Cysha\Casino\Cards\Results\StandardCardResult;

class StandardEvaluator implements CardEvaluator
{
    /**
     * @param CardCollection $board
     * @param Hand           $hand
     *
     * @return StandardCardResult
     */
    public static function evaluate(CardCollection $board, Hand $hand): CardResults
    {
        return new StandardCardResult(0, [], $board, 'CardDefinition', $hand);
    }

    /**
     * @param CardCollection $board
     * @param HandCollection $playerHands
     *
     * @return ResultCollection
     */
    public function evaluateHands(CardCollection $board, HandCollection $playerHands): ResultCollection
    {
        return ResultCollection::make([
            static::evaluate($board, $playerHands->first()),
        ]);
    }
}
