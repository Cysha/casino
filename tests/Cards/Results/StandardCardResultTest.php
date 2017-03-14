<?php

namespace Cysha\Casino\Tests\Cards\Results;

use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Hand;
use Cysha\Casino\Cards\Results\StandardCardResult;
use Cysha\Casino\Game\Chips;
use Cysha\Casino\Game\Client;
use Cysha\Casino\Game\Player;
use Ramsey\Uuid\Uuid;

class StandardCardResultTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    /** @test */
    public function can_create_a_standard_card_result()
    {
        $player = Player::fromClient(Client::register(Uuid::uuid4(), 'xLink', Chips::fromAmount(650)), Chips::fromAmount(2000));
        $cardCollection = CardCollection::make();
        $hand = Hand::fromString('5h 5s', $player);

        $result = new StandardCardResult(1, [], $cardCollection, 'Card Definition', $hand);

        $this->assertEquals(1, $result->rank());
        $this->assertEquals([], $result->value());
        $this->assertInstanceOf(CardCollection::class, $result->cards());
        $this->assertEquals('Card Definition', $result->definition());
        $this->assertInstanceOf(Hand::class, $result->hand());
    }
}
