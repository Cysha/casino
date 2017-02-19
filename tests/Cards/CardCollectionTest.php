<?php

namespace Cysha\Casino\Tests\Cards;

use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Card;
use Cysha\Casino\Cards\Suit;

class CardCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    /**
     * @expectedException \BadMethodCallException
     * @test
     */
    public function call()
    {
        $cards = CardCollection::make();

        $this->assertFalse($cards->potato());
    }

    /** @test */
    public function can_get_suit_counts_from_cards_given()
    {
        $cards = CardCollection::make([
            new Card(8, Suit::diamond()),
            new Card(10, Suit::club()),
            new Card(Card::ACE, Suit::club()),
            new Card(8, Suit::heart()),
            new Card(Card::QUEEN, Suit::club()),
        ]);

        $this->assertCount(1, $cards->diamonds());
        $this->assertCount(3, $cards->clubs());
        $this->assertCount(0, $cards->spades());
        $this->assertCount(1, $cards->hearts());

        $this->assertCount(1, $cards->whereSuit('diamonds'));
        $this->assertCount(3, $cards->whereSuit('clubs'));
        $this->assertCount(0, $cards->whereSuit('spades'));
        $this->assertCount(1, $cards->whereSuit('hearts'));
    }

    /** @test */
    public function can_get_value_counts_from_cards_given()
    {
        $cards = CardCollection::make([
            new Card(8, Suit::diamond()),
            new Card(10, Suit::club()),
            new Card(Card::ACE, Suit::club()),
            new Card(8, Suit::heart()),
            new Card(Card::QUEEN, Suit::club()),
        ]);

        $this->assertCount(2, $cards->whereValue(8));
        $this->assertCount(1, $cards->whereValue(10));
        $this->assertCount(1, $cards->whereValue(Card::ACE));
        $this->assertCount(1, $cards->whereValue(Card::QUEEN));
    }

    /** @test */
    public function can_reconstiute_cards_from_string_with_ascii_suits()
    {
        $result = CardCollection::fromString('8♦ T♣ A♠ 8♥ Q♣');

        $expected = new CardCollection([
            new Card(8, Suit::diamond()),
            new Card(10, Suit::club()),
            new Card(Card::ACE, Suit::spade()),
            new Card(8, Suit::heart()),
            new Card(Card::QUEEN, Suit::club()),
        ]);

        $this->assertInstanceOf(CardCollection::class, $result);
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function can_reconstiute_cards_from_string_with_plaintext_suits()
    {
        $result = CardCollection::fromString('8d Qc');

        $expected = new CardCollection([
            new Card(8, Suit::diamond()),
            new Card(Card::QUEEN, Suit::club()),
        ]);

        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function can_group_cards_by_values()
    {
        $result = CardCollection::fromString('Ad Qc 5s 5h Ac');

        $expected = new CardCollection([
            new CardCollection([
                new Card(Card::ACE, Suit::diamond()),
                new Card(Card::ACE, Suit::club()),
            ]),
            new CardCollection([
                new Card(5, Suit::spade()),
                new Card(5, Suit::heart()),
            ]),
            new CardCollection([
                new Card(Card::QUEEN, Suit::club()),
            ]),
        ]);

        $this->assertEquals($expected, $result->groupByValue());
    }

    /** @test */
    public function can_sum_cards_by_values()
    {
        $result = CardCollection::fromString('Ad Qc 5s 5h Ac');

        $this->assertEquals(24, $result->sumByValue());
    }

    /** @test */
    public function can_sort_cards_by_values()
    {
        $result = CardCollection::fromString('Ad Qc 5s 5h Ac');

        $expected = new CardCollection([
            new Card(Card::ACE, Suit::club()),
            new Card(Card::ACE, Suit::diamond()),
            new Card(5, Suit::heart()),
            new Card(5, Suit::spade()),
            new Card(Card::QUEEN, Suit::club()),
        ]);

        $this->assertInstanceOf(CardCollection::class, $result);
        $this->assertEquals($expected, $result->sortByValue());
    }

    /** @test */
    public function can_switch_value_of_ace_from_high_to_low_or_viceversa()
    {
        $result = CardCollection::fromString('Ad Qc');

        $expected = new CardCollection([
            new Card(14, Suit::diamond()),
            new Card(Card::QUEEN, Suit::club()),
        ]);

        $this->assertInstanceOf(CardCollection::class, $result);
        $this->assertEquals($expected, $result->switchAceValue());
    }

    /** @test */
    public function cardCollection_tostring_gives_card_and_suit_combos_back()
    {
        $result = CardCollection::fromString('8♦ T♣ A♠ 8♥ Q♣');

        $this->assertInstanceOf(CardCollection::class, $result);
        $this->assertEquals('8♦ T♣ A♠ 8♥ Q♣', $result->__toString());
    }
}
