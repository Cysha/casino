<?php

namespace Cysha\Casino\Game;

use Cysha\Casino\Game\Contracts\Player;
use Illuminate\Support\Collection;

class PlayerCollection extends Collection
{
    /**
     * @param string $playerName
     *
     * @return Player|null
     */
    public function findByName($playerName)
    {
        return $this->first(function (Player $player) use ($playerName) {
            return $player->name() === $playerName;
        });
    }
}
