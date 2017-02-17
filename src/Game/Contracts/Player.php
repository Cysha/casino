<?php

namespace Cysha\Casino\Game\Contracts;

use Cysha\Casino\Game\Client;

interface Player
{
    public static function fromClient(Client $client): Player;

    public function equals(Player $object): bool;
}
