<?php

namespace Cysha\Casino\Game;

use Cysha\Casino\Game\Contracts\Name as NameContract;
use Ramsey\Uuid\Uuid;

class Client implements NameContract
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Chips
     */
    private $wallet;

    /**
     * ClientTest constructor.
     *
     * @param Uuid $id
     * @param string $name
     * @param Chips $chips
     */
    public function __construct(Uuid $id, $name, Chips $wallet = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->wallet = $wallet ?? Chips::zero();
    }

    /**
     * @param string $name
     * @param Chips  $chips
     *
     * @return Client
     */
    public static function register(Uuid $id, $name, Chips $chips = null): Client
    {
        return new static($id, $name, $chips);
    }

    /**
     * @return Uuid
     */
    public function id(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Chips
     */
    public function wallet(): Chips
    {
        return $this->wallet;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name();
    }
}
