<?php

namespace Cysha\Casino\Tests\Game;

use Cysha\Casino\Game\Chips;
use Cysha\Casino\Game\Client;
use Ramsey\Uuid\Uuid;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @test **/
    public function a_new_client_can_register()
    {
        $id = Uuid::uuid4();
        $client = Client::register($id, 'xLink');
        $this->assertInstanceOf(Client::class, $client);
    }

    /** @test */
    public function i_can_read_the_client_name()
    {
        $id = Uuid::uuid4();
        $client = Client::register($id, 'xLink');
        $this->assertEquals('xLink', $client->name());
    }

    /** @test */
    public function it_returns_the_client_name_when_forced_to_string()
    {
        $id = Uuid::uuid4();
        $client = Client::register($id, 'xLink');
        $this->assertEquals('xLink', $client->__toString());
    }

    /** @test */
    public function client_has_no_chips_in_wallet()
    {
        $id = Uuid::uuid4();
        $client = Client::register($id, 'xLink');

        $this->assertInstanceOf(Chips::class, $client->wallet());
        $this->assertEquals(0, $client->wallet()->amount());
    }

    /** @test */
    public function client_has_defined_chips_in_wallet()
    {
        $id = Uuid::uuid4();
        $chipCount = Chips::fromAmount(5000);
        $client = Client::register($id, 'xLink', $chipCount);

        $this->assertInstanceOf(Chips::class, $client->wallet());
        $this->assertEquals($chipCount->amount(), $client->wallet()->amount());
    }

    /** @test */
    public function client_chips_can_be_added()
    {
        $id = Uuid::uuid4();
        $chipCount = Chips::fromAmount(5000);
        $client = Client::register($id, 'xLink', $chipCount);
        $client->wallet()->add(Chips::fromAmount(100));

        $this->assertEquals(5100, $client->wallet()->amount());
    }

    /** @test */
    public function client_chips_can_be_subtracted()
    {
        $id = Uuid::uuid4();
        $chipCount = Chips::fromAmount(5000);
        $client = Client::register($id, 'xLink', $chipCount);
        $client->wallet()->subtract(Chips::fromAmount(100));

        $this->assertEquals(4900, $client->wallet()->amount());
    }
}
