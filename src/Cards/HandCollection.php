<?php

namespace Cysha\Casino\Cards;

use Cysha\Casino\Game\Contracts\Player;
use Cysha\Casino\Game\PlayerCollection;
use Illuminate\Support\Collection;

class HandCollection extends Collection
{
    public function findByPlayer(Player $player)
    {
        return $this->first(function (Hand $hand) use ($player) {
            return $hand->player()->equals($player);
        });
    }

    public function findByPlayers(PlayerCollection $players)
    {
        $hands = $players->map(function (Player $player) {
            return $this->first(function (Hand $hand) use ($player) {
                return $hand->player()->equals($player);
            });
        });

        return self::make($hands);
    }
}
