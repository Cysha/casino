<?php

namespace Cysha\Casino\Cards;

use Cysha\Casino\Game\Contracts\Player;
use Illuminate\Support\Collection;

class HandCollection extends Collection
{
    public function findByPlayer(Player $player)
    {
        return $this->first(function (Hand $hand) use ($player) {
            return $hand->player()->equals($player);
        });
    }
}
