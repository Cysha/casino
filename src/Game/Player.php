<?php

namespace Cysha\Casino\Game;

use Cysha\Casino\Game\Contracts\Player as PlayerContract;

class Player extends Client implements PlayerContract
{
    /**
     * PlayerTest constructor.
     *
     * @param string $name
     * @param Chips  $chips
     */
    public function __construct($name, Chips $wallet = null)
    {
        parent::__construct($name, $wallet);
    }

    /**
     * @param Client $client
     * @param Chips  $chipCount
     *
     * @return PlayerContract
     */
    public static function fromClient(Client $client): PlayerContract
    {
        return new self($client->name(), $client->wallet());
    }

    /**
     * @param PlayerContract $object
     *
     * @return bool
     */
    public function equals(PlayerContract $object): bool
    {
        return static::class === get_class($object)
            && $this->name() === $object->name()
            && $this->wallet() === $object->wallet();
    }
}
