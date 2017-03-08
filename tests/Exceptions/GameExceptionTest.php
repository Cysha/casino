<?php

namespace Cysha\Casino\Tests\Exceptions;

use Cysha\Casino\Exceptions\GameException;
use Cysha\Casino\Game\Chips;
use Cysha\Casino\Game\Client;
use Cysha\Casino\Game\DefaultGame;
use Cysha\Casino\Game\Player;
use PHPUnit_Framework_TestCase;
use Ramsey\Uuid\Uuid;

class GameExceptionTest extends PHPUnit_Framework_TestCase
{
    public function test_the_invalid_id_has_a_default_message()
    {
        $expectedException = new GameException('ID passed to the Game must be a valid UUID');
        $this->assertEquals($expectedException, GameException::invalidId());
    }

    public function test_the_already_registered_can_accept_custom_messages()
    {
        $expectedException = new GameException('custom message');
        $client = Client::register('xLink', Chips::fromAmount(0));
        $game = DefaultGame::setUp(Uuid::uuid4(), 'test game', Chips::zero());

        $this->assertEquals($expectedException, GameException::alreadyRegistered($client, $game, 'custom message'));
    }

    public function test_the_not_registered_can_accept_custom_messages()
    {
        $expectedException = new GameException('custom message');
        $client = Client::register('xLink', Chips::fromAmount(0));
        $game = DefaultGame::setUp(Uuid::uuid4(), 'test game', Chips::zero());

        $this->assertEquals($expectedException, GameException::notRegistered($client, $game, 'custom message'));
    }

    public function test_the_insufficient_funds_has_a_default_message()
    {
        $uuid = Uuid::uuid4();
        $gameName = 'game name';
        $game = DefaultGame::setUp($uuid, $gameName, Chips::fromAmount(100));
        $player = Player::fromClient(Client::register('xLink', Chips::fromAmount(0)));

        $expectedException = new GameException(sprintf(
            '%s doesnt have sufficient funds to register for game: "%s"',
            $player->name(),
            $gameName
        ));

        $this->assertEquals($expectedException, GameException::insufficientFunds($player, $game));
    }

    public function test_the_insufficient_funds_can_accept_custom_messages()
    {
        $uuid = Uuid::uuid4();
        $gameName = 'game name';
        $game = DefaultGame::setUp($uuid, $gameName, Chips::fromAmount(100));
        $player = Player::fromClient(Client::register('xLink', Chips::fromAmount(0)));
        $expectedMessage = 'xLink cor play "game name", the silly tart ran out of moniez';

        $expectedException = new GameException(sprintf(
            '%s cor play "%s", the silly tart ran out of moniez',
            $player->name(),
            $gameName
        ));

        $this->assertEquals($expectedException, GameException::insufficientFunds($player, $game, $expectedMessage));
    }
}
