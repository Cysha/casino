<?php

namespace Cysha\Casino\Game;

use Cysha\Casino\Game\Contracts\Player as PlayerContract;
use Ramsey\Uuid\Uuid;

class Player extends Client implements PlayerContract
{
    /**
     * PlayerTest constructor.
     *
     * @param Uuid $id
     * @param string $name
     * @param Chips $chips
     */
    public function __construct(Uuid $id, $name, Chips $wallet = null)
    {
        parent::__construct($id, $name, $wallet);
    }

    /**
     * @param Uuid $id
     * @param Client $client
     * @param Chips $chipCount
     *
     * @return PlayerContract
     */
    public static function fromClient(Client $client): PlayerContract
    {
        return new self($client->id(), $client->name(), $client->wallet());
    }

    /**
     * @param PlayerContract $object
     *
     * @return bool
     */
    public function equals(PlayerContract $object): bool
    {
        return static::class === get_class($object)
        && $this->id() === $object->id()
        && $this->name() === $object->name()
        && $this->wallet() === $object->wallet();
    }
}
