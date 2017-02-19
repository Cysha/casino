<?php

namespace Cysha\Casino\Tests\Game;

use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Contracts\CardEvaluator;
use Cysha\Casino\Cards\Deck;
use Cysha\Casino\Cards\Hand;
use Cysha\Casino\Cards\HandCollection;
use Cysha\Casino\Cards\ResultCollection;
use Cysha\Casino\Game\Chips;
use Cysha\Casino\Game\Client;
use Cysha\Casino\Game\Dealer;
use Cysha\Casino\Game\Player;

class DealerTest extends BaseGameTestCase
{
    public function setUp()
    {
    }

    /** @test */
    public function dealer_can_start_work_with_a_deck_and_a_ruleset()
    {
        $evaluator = $this->createEvaluatorMock();
        $dealer = Dealer::startWork(new Deck(), $evaluator);

        $this->assertInstanceOf(Dealer::class, $dealer);
    }

    /** @test */
    public function dealer_has_a_deck_of_cards()
    {
        $evaluator = $this->createEvaluatorMock();
        $dealer = Dealer::startWork(new Deck(), $evaluator);

        $this->assertInstanceOf(Deck::class, $dealer->deck());
    }

    /** @test */
    public function dealer_can_deal_a_card()
    {
        $evaluator = $this->createEvaluatorMock();
        $dealer = Dealer::startWork(new Deck(), $evaluator);

        $this->assertEquals(52, $dealer->deck()->count());

        $dealer->dealCard();

        $this->assertEquals(51, $dealer->deck()->count());
    }

    /** @test */
    public function dealer_can_shuffle_deck()
    {
        $evaluator = $this->createEvaluatorMock();
        $dealer = Dealer::startWork(new Deck(), $evaluator);

        $this->assertEquals($dealer->shuffleDeck(), $dealer->shuffleDeck(), '', 0.0, 10, true);
    }

    /** @test */
    public function dealer_can_evaluate_hands()
    {
        $evaluator = $this->createEvaluatorMock();
        $dealer = Dealer::startWork(new Deck(), $evaluator);

        $player = Player::fromClient(Client::register('xLink', Chips::fromAmount(650)));

        $cardCollection = CardCollection::make();
        $handCollection = HandCollection::make([
            Hand::fromString('Ad Ah', $player),
        ]);

        $evaluator->expects($this->exactly(1))
            ->method('evaluateHands')
            ->with($cardCollection, $handCollection);

        $dealer->evaluateHands($cardCollection, $handCollection);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function createEvaluatorMock(): \PHPUnit_Framework_MockObject_MockObject
    {
        $evaluator = $this->createMock(CardEvaluator::class);
        $evaluator->method('evaluateHands')
                  ->withAnyParameters()
                  ->willReturn(ResultCollection::make())
        ;

        return $evaluator;
    }
}
