<?php

namespace Cysha\Casino\Game;

use Cysha\Casino\Game\Contracts\Dealer;
use Cysha\Casino\Game\Contracts\Player;

class Table
{
    /**
     * @var PlayerCollection
     */
    private $players;

    /**
     * @var Dealer
     */
    private $dealer;

    /**
     * Table constructor.
     *
     * @param Dealer           $dealer
     * @param PlayerCollection $players
     */
    private function __construct(Dealer $dealer, PlayerCollection $players)
    {
        $this->dealer = $dealer;
        $this->players = $players;
    }

    /**
     * @return Table
     */
    public static function setUp(Dealer $dealer, PlayerCollection $players)
    {
        return new self($dealer, $players);
    }

    /**
     * @return PlayerCollection
     */
    public function players(): PlayerCollection
    {
        return $this->players;
    }

    /**
     * @return Dealer
     */
    public function dealer(): Dealer
    {
        return $this->dealer;
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
