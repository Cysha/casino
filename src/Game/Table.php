<?php

namespace Cysha\Casino\Game;

use Cysha\Casino\Game\Contracts\Dealer;
use Cysha\Casino\Game\Contracts\Player;
use Ramsey\Uuid\Uuid;

class Table
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var Dealer
     */
    private $dealer;

    /**
     * @var PlayerCollection
     */
    private $players;

    /**
     * Table constructor.
     *
     * @param Uuid $id
     * @param Dealer $dealer
     * @param PlayerCollection $players
     */
    private function __construct(Uuid $id, Dealer $dealer, PlayerCollection $players)
    {
        $this->id = $id;
        $this->dealer = $dealer;
        $this->players = $players;
    }

    /**
     * @return Table
     */
    public static function setUp(Uuid $id, Dealer $dealer, PlayerCollection $players)
    {
        return new self($id, $dealer, $players);
    }

    /**
     * @return Uuid
     */
    public function id(): Uuid
    {
        return $this->id;
    }

    /**
     * @return Dealer
     */
    public function dealer(): Dealer
    {
        return $this->dealer;
    }

    /**
     * @return PlayerCollection
     */
    public function players(): PlayerCollection
    {
        return $this->players;
    }
    /**
     * @param Player $player
     *
     * @return int
     */
    public function findSeat(Player $findPlayer): int
    {
        return $this->players()
            ->filter(function (Player $player) use ($findPlayer) {
                return $player->equals($findPlayer);
            })
            ->keys()
            ->first();
    }

    /**
     * @param string $playerName
     *
     * @return Player
     */
    public function findPlayerByName($playerName): Player
    {
        return $this->players()
            ->filter(function (Player $player) use ($playerName) {
                return $player->name() === $playerName;
            })
            ->first();
    }
}
