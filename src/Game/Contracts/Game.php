<?php

namespace Cysha\Casino\Game\Contracts;

use Cysha\Casino\Game\Chips;
use Cysha\Casino\Game\Client;
use Cysha\Casino\Game\PlayerCollection;
use Cysha\Casino\Game\TableCollection;
use Ramsey\Uuid\UuidInterface;

interface Game
{
    public function id(): UuidInterface;

    public function name(): string;

    public function players(): PlayerCollection;

    public function tables(): TableCollection;

    public function registerPlayer(Client $client, Chips $buyInAmount = null);

    public function __toString(): string;
}
