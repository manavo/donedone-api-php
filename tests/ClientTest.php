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

    public function typeOfRequestProvider()
    {
        return [
            ['priorityLevels', 'get'],
            ['projects', 'get'],
            ['companies', 'get'],
            ['issues', 'get'],
            ['activeIssues', 'get'],
            ['closedAndFixedIssues', 'get'],
            ['issuesWaitingOnYou', 'get'],
            ['issuesWaitingOnThem', 'get'],
            ['globalFilters', 'get'],
            ['issueCreationTypes', 'get'],
            ['issueSortTypes', 'get'],
        ];
    }

    /**
     * @dataProvider typeOfRequestProvider
     */
    public function testMethodsMakeCorrectTypeOfRequest($function, $requestType)
    {
        $responseMock = $this->getMockBuilder('\GuzzleHttp\Message\Response')
            ->disableOriginalConstructor()->getMock();
        $responseMock->expects($this->once())->method('getBody')
            ->willReturn($this->returnValue('{}'));

        $guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->disableOriginalConstructor()->getMock();
        $guzzleClientMock->expects($this->once())->method($requestType)
            ->willReturn($responseMock);

        $this->client->setClient($guzzleClientMock);

        $this->client->$function();
    }

    public function typeOfRequestWithArgumentProvider()
    {
        return [
            ['issuesByFilter', 'get', 'argument'],
            ['createCompany', 'post', new Company()],
        ];
    }

    /**
     * @dataProvider typeOfRequestWithArgumentProvider
     */
    public function testMethodsWithArgumentMakeCorrectTypeOfRequest(
        $function,
        $requestType,
        $argument
    ) {
        $responseMock = $this->getMockBuilder('\GuzzleHttp\Message\Response')
            ->disableOriginalConstructor()->getMock();
        $responseMock->expects($this->once())->method('getBody')
            ->willReturn($this->returnValue('{}'));

        $guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->disableOriginalConstructor()->getMock();
        $guzzleClientMock->expects($this->once())->method($requestType)
            ->willReturn($responseMock);

        $this->client->setClient($guzzleClientMock);

        $this->client->$function($argument);
    }

}
