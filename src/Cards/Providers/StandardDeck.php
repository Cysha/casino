<?php

namespace Cysha\Casino\Cards\Providers;

use Cysha\Casino\Cards\Contracts\CardProvider;
use Cysha\Casino\Cards\Card;
use Cysha\Casino\Cards\Suit;

/**
 * The standard cards in a 52 card deck.
 */
class StandardDeck implements CardProvider
{
    public function getCards()
    {
        $cards = [];

        $suits = [
            Suit::club(), Suit::diamond(), Suit::heart(), Suit::spade(),
        ];

        foreach ($suits as $suit) {
            $this->addCards($cards, $suit);
        }

        return $cards;
    }

    private function addCards(&$cards, $suit)
    {
        $values = range(2, 10);
        $values[] = Card::ACE;
        $values[] = Card::JACK;
        $values[] = Card::QUEEN;
        $values[] = Card::KING;

        foreach ($values as $v) {
            $cards[] = new Card($v, $suit);
        }
    }
}
