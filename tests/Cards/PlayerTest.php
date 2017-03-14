<?php

namespace Cysha\Casino\Tests\Game;

use Cysha\Casino\Game\Client;
use Cysha\Casino\Game\Player;
use Ramsey\Uuid\Uuid;

class PlayerTest extends BaseGameTestCase
{
    /** @test */
    public function it_can_be_created_from_a_client()
    {
        $client = Client::register(Uuid::uuid4(), 'xLink');
        $player = Player::fromClient($client);

        $this->assertInstanceOf(Client::class, $player);
        $this->assertEquals($client->name(), $player->name());
    }

    /** @test */
    public function check_if_same_players_are_equal()
    {
        $client = Client::register(Uuid::uuid4(), 'xLink');
        $player1 = Player::fromClient($client);

        $player2 = Player::fromClient($client);

        $this->assertTrue($player1->equals($player2));
    }

    /** @test */
    public function check_diff_players_dont_equal_eachother()
    {
        $player1 = Player::fromClient(Client::register(Uuid::uuid4(), 'xLink'));
        $player2 = Player::fromClient(Client::register(Uuid::uuid4(), 'jesus'));

        $this->assertFalse($player1->equals($player2));
    }
}
