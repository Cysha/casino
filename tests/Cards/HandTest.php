<?php

namespace Cysha\Casino\Tests\Cards;

use Cysha\Casino\Cards\Card;
use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Hand;
use Cysha\Casino\Game\Chips;
use Cysha\Casino\Game\Client;
use Cysha\Casino\Game\Player;

class HandTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    /** @test **/
    public function can_create_hands()
    {
        $player = Player::fromClient(Client::register('xLink', Chips::zero()), Chips::zero());

        $hand = Hand::createUsingString('5h 5d', $player);

        $expected = CardCollection::fromString('5h 5d');

        $this->assertCount(2, $hand);
        $this->assertEquals($expected, $hand->cards());
        $this->assertEquals($player, $hand->player());
    }

    /** @test **/
    public function can_add_card_to_a_hand()
    {
        $player = Player::fromClient(Client::register('xLink', Chips::zero()), Chips::zero());

        $hand = Hand::createUsingString('5h', $player);
        $hand->addCard(Card::fromString('5d'));

        $this->assertCount(2, $hand);
    }
}
