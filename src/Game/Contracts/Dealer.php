<?php

namespace Cysha\Casino\Game\Contracts;

use Cysha\Casino\Cards\Card;
use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Contracts\CardEvaluator;
use Cysha\Casino\Cards\Deck;
use Cysha\Casino\Cards\HandCollection;
use Cysha\Casino\Holdem\Cards\SevenCardResultCollection;

interface Dealer
{
    public static function startWork(Deck $deck, CardEvaluator $cardEvaluationRules);

    public function deck(): Deck;

    public function dealCard(): Card;

    public function shuffleDeck();

    // TODO: SevenCardResultCollection shouldnt be here...
    public function evaluateHands(CardCollection $board, HandCollection $playerHands): SevenCardResultCollection;
}
