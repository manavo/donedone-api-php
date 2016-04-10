<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\Client;
use Manavo\DoneDone\Issue;
use Manavo\DoneDone\Project;
use Manavo\DoneDone\ReleaseBuild;
use PHPUnit_Framework_TestCase;

class ProjectTest extends PHPUnit_Framework_TestCase
{

    public function testIssueMethodReturnsIssueObject()
    {
        $project = new Project(new Client('team', 'username', 'password'), 0);
        $this->assertInstanceOf('Manavo\\DoneDone\\Issue', $project->issue(1));
    }

    public function typeOfRequestProvider()
    {
        return [
            ['people', 'get'],
            ['issues', 'get'],
            ['activeIssues', 'get'],
            ['closedAndFixedIssues', 'get'],
            ['issuesWaitingOnYou', 'get'],
            ['issuesWaitingOnThem', 'get'],
            ['releaseBuilds', 'get'],
            //['releaseBuildInfo', 'get'],  // TODO response is object of class ReleaseBuildInfo
            ['filters', 'get'],
        ];
    }

    /**
     * @dataProvider typeOfRequestProvider
     */
    public function testMethodsMakeCorrectTypeOfRequest($function, $requestType)
    {
        $responseMock = $this->getMockBuilder('\GuzzleHttp\Message\Response')
            ->disableOriginalConstructor()->getMock();
        $responseMock->expects($this->once())->method('json')
            ->willReturn($this->returnValue(true));

        $guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->disableOriginalConstructor()->getMock();
        $guzzleClientMock->expects($this->once())->method($requestType)
            ->willReturn($responseMock);

        $client = new Client('team', 'username', 'password');
        $client->setClient($guzzleClientMock);

        $client->project(123)->$function();
    }

    public function typeOfRequestWithArgumentProvider()
    {
        return [
            ['issuesByFilter', 'get', 'argument'],
            ['addIssue', 'post', new Issue()],
            ['createReleaseBuild', 'post', new ReleaseBuild()],
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
        $responseMock->expects($this->once())->method('json')
            ->willReturn($this->returnValue(true));

        $guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->disableOriginalConstructor()->getMock();
        $guzzleClientMock->expects($this->once())->method($requestType)
            ->willReturn($responseMock);

        $client = new Client('team', 'username', 'password');
        $client->setClient($guzzleClientMock);

        $client->project(123)->$function($argument);
    }

}
