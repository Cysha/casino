<?php

namespace Cysha\Casino\Tests\Cards;

use InvalidArgumentException;
use Cysha\Casino\Cards\Card;
use Cysha\Casino\Cards\Suit;

class CardTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    /**
     * @expectedException InvalidArgumentException
     * @test
     */
    public function cannot_give_card_invalid_value()
    {
        $card = new Card(123, Suit::club());
    }

    /** @test **/
    public function can_get_card_identifier()
    {
        $suit = Suit::club();
        $card = new Card(Card::JACK, $suit);

        $this->assertEquals($card, $card->shortName().$card->suit()->symbol());
    }

    /** @test **/
    public function can_access_suit_data_for_cards()
    {
        $suit = Suit::club();
        $card = new Card(Card::ACE, $suit);

        $this->assertEquals($card->suit()->value(), $suit->value());
        $this->assertEquals($card->suit()->name(), $suit->name());
        $this->assertEquals($card->suit()->symbol(), $suit->symbol());
    }

    /** @test **/
    public function can_recognise_face_cards()
    {
        $card = new Card(Card::KING, Suit::diamond());
        $this->assertTrue($card->isKing());
        $this->assertTrue($card->isFaceCard());
        $this->assertEquals('K', $card->shortName());
        $this->assertEquals('King', $card->longName());
        $this->assertEquals('King of Diamonds', $card->longIdentifier());

        $card = new Card(Card::QUEEN, Suit::diamond());
        $this->assertTrue($card->isQueen());
        $this->assertTrue($card->isFaceCard());
        $this->assertEquals('Q', $card->shortName());
        $this->assertEquals('Queen', $card->longName());
        $this->assertEquals('Queen of Diamonds', $card->longIdentifier());

        $card = new Card(Card::JACK, Suit::diamond());
        $this->assertTrue($card->isJack());
        $this->assertTrue($card->isFaceCard());
        $this->assertEquals('J', $card->shortName());
        $this->assertEquals('Jack', $card->longName());
        $this->assertEquals('Jack of Diamonds', $card->longIdentifier());

        $card = new Card(Card::ACE, Suit::diamond());
        $this->assertTrue($card->isAce());
        $this->assertTrue($card->isFaceCard());
        $this->assertEquals('A', $card->shortName());
        $this->assertEquals('Ace', $card->longName());
        $this->assertEquals('Ace of Diamonds', $card->longIdentifier());

        $card = new Card(Card::ACE_HIGH, Suit::diamond());
        $this->assertTrue($card->isAce());
        $this->assertTrue($card->isFaceCard());
        $this->assertEquals('A', $card->shortName());
        $this->assertEquals('Ace', $card->longName());
        $this->assertEquals('Ace of Diamonds', $card->longIdentifier());
    }

    /** @test **/
    public function is_number_card()
    {
        $card = new Card(10, Suit::diamond());
        $this->assertEquals('T', $card->name());
        $this->assertEquals('Ten', $card->longName());
        $this->assertTrue($card->isNumberCard());

        $card = new Card(Card::ACE, Suit::diamond());
        $this->assertFalse($card->isNumberCard());

        $card = new Card(Card::ACE_HIGH, Suit::diamond());
        $this->assertFalse($card->isNumberCard());
    }

    /** @test **/
    public function is_not_face_card()
    {
        $card = new Card(5, Suit::diamond());

        $this->assertEquals('5', $card->name());
        $this->assertFalse($card->isAce());
        $this->assertFalse($card->isKing());
        $this->assertFalse($card->isQueen());
        $this->assertFalse($card->isJack());
        $this->assertFalse($card->isFaceCard());
        $this->assertEquals('Five', $card->longName());
    }

    /** @test */
    public function it_doesnt_consider_a_class_of_another_type_equal()
    {
        $suit = Suit::club();
        $card = new Card(Card::ACE, $suit);
        $otherCardValue = new Card(Card::KING, $suit);

        $this->assertFalse($card->equals($suit));
        $this->assertFalse($card->equals($otherCardValue));
    }

    /** @test */
    public function it_can_compare_an_equal_card()
    {
        $suit = Suit::club();
        $card = new Card(Card::ACE, $suit);
        $otherCardValue = new Card(Card::ACE, $suit);

        $this->assertTrue($card->equals($otherCardValue));
    }

    /** @test */
    public function can_create_card_from_string()
    {
        $builtCard = Card::fromString('8♦');

        $actualCard = new Card(8, Suit::diamond());

        $this->assertEquals($builtCard, $actualCard);
    }

    /** @test */
    public function can_create_card_from_lowercase_string()
    {
        $builtCard = Card::fromString('k♦');

        $actualCard = new Card(Card::KING, Suit::diamond());

        $this->assertEquals($builtCard, $actualCard);
    }

    /**
     * @expectedException Cysha\Casino\Exceptions\CardException
     * @test
     */
    public function cannot_create_card_from_invalid_suit()
    {
        Card::fromString('45');
    }

    /**
     * @expectedException Cysha\Casino\Exceptions\CardException
     * @test
     */
    public function cannot_create_card_from_invalid_card_number()
    {
        Card::fromString('Ld');
    }
}
