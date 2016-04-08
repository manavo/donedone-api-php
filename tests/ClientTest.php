<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\Client;
use Manavo\DoneDone\Company;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new Client('team', 'username', 'password');
    }

    public function tearDown()
    {
        $this->client = null;
    }

    public function testProjectMethodReturnsIssueObject()
    {
        $this->assertInstanceOf(
            'Manavo\\DoneDone\\Project', $this->client->project(1)
        );
    }

    public function testCompanyMethodReturnsIssueObject()
    {
        $this->assertInstanceOf(
            'Manavo\\DoneDone\\Company', $this->client->company(1)
        );
    }

}
