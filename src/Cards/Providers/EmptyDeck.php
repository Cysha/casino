<?php

namespace Cysha\Casino\Cards\Providers;

use Cysha\Casino\Cards\Contracts\CardProvider;

class EmptyDeck implements CardProvider
{
    public function getCards()
    {
        return [];
    }
}
