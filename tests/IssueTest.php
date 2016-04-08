<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\Client;
use Manavo\DoneDone\Comment;
use Manavo\DoneDone\Issue;
use PHPUnit_Framework_TestCase;

class IssueTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        date_default_timezone_set('UTC');
    }

    public function testRequiredParametersIncludedWhenConvertingToArray()
    {
        $issueArray = (new Issue())->toArray();

        $this->assertArrayHasKey('title', $issueArray);
        $this->assertArrayHasKey('priority_level_id', $issueArray);
        $this->assertArrayHasKey('fixer_id', $issueArray);
        $this->assertArrayHasKey('tester_id', $issueArray);

        $this->assertEquals(4, count($issueArray));
    }

    public function testDescriptionIsAddedIfNotEmpty()
    {
        $issue = new Issue();
        $issue->setDescription('desc');

        $this->assertArrayHasKey('description', $issue->toArray());
    }

    public function testUserIdsToCcIsAddedIfNotEmpty()
    {
        $issue = new Issue();
        $issue->setUserIdsToCc('1,2,3');

        $this->assertArrayHasKey('user_ids_to_cc', $issue->toArray());
    }

    public function testDueDateIsAddedIfNotEmpty()
    {
        $issue = new Issue();
        $issue->setDueDate('2014-01-12 12:01:00');

        $this->assertArrayHasKey('due_date', $issue->toArray());
    }

    public function testTagsIsAddedIfNotEmpty()
    {
        $issue = new Issue();
        $issue->setTags('tag1,tag2');

        $this->assertArrayHasKey('tags', $issue->toArray());
    }

    public function testUserIdsToCcIsACommaSeparatedString()
    {
        $issue = new Issue();
        $issue->setUserIdsToCc([1, 2, 3]);

        $this->assertEquals('1,2,3', $issue->toArray()['user_ids_to_cc']);
    }

    public function testTagsIsACommaSeparatedString()
    {
        $issue = new Issue();
        $issue->setTags(['tag1', 'tag2', 'tag3']);

        $this->assertEquals('tag1,tag2,tag3', $issue->toArray()['tags']);
    }

    public function testAttachmentsGetAddedWhenConvertingToArray()
    {
        $issue = new Issue();
        $issue->addAttachment(__FILE__);
        $issue->addAttachment(__FILE__);
        $issue->addAttachment(__FILE__);
        $issue->addAttachment(__FILE__);

        $this->assertEquals(8, count($issue->toArray()));
    }

    public function testUnixTimestampGetsConvertedForDueDate()
    {
        $time = time();

        $issue = new Issue();
        $issue->setDueDate($time);

        $this->assertEquals(date('Y-m-d H:i:s', $time), $issue->toArray()['due_date']);
    }

    public function testFixerIsSetCorrectly()
    {
        $issue = new Issue();
        $issue->setFixer(123);

        $this->assertEquals(123, $issue->toArray()['fixer_id']);
    }

    public function testPriorityLevelIsSetCorrectly()
    {
        $issue = new Issue();
        $issue->setPriorityLevel(1123);

        $this->assertEquals(1123, $issue->toArray()['priority_level_id']);
    }

    public function testTesterIsSetCorrectly()
    {
        $issue = new Issue();
        $issue->setTester(31);

        $this->assertEquals(31, $issue->toArray()['tester_id']);
    }

    public function testTitleIsSetCorrectly()
    {
        $issue = new Issue();
        $issue->setTitle('setting title!');

        $this->assertEquals('setting title!', $issue->toArray()['title']);
    }

    public function typeOfRequestProvider()
    {
        return [
            ['availableReassignees', 'get'],
            ['availableStatuses', 'get'],
        ];
    }

    /**
     * @dataProvider typeOfRequestProvider
     */
    public function testMethodsMakeCorrectTypeOfRequest($function, $requestType)
    {
        $guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->disableOriginalConstructor()->getMock();
        $guzzleClientMock->expects($this->once())->method($requestType);

        $client = new Client('team', 'username', 'password');
        $client->setClient($guzzleClientMock);

        $client->project(123)->issue(111)->$function();
    }

    public function typeOfRequestWithArgumentProvider()
    {
        return [
            ['addComment', 'post', new Comment()],
            ['updateStatus', 'put', 1],
            ['updatePriorityLevel', 'put', 1],
            ['updateTester', 'put', 1],
            ['updateFixer', 'put', 1],
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
        $guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->disableOriginalConstructor()->getMock();
        $guzzleClientMock->expects($this->once())->method($requestType);

        $client = new Client('team', 'username', 'password');
        $client->setClient($guzzleClientMock);

        $client->project(123)->issue(182)->$function($argument);
    }

    public function testUpdateMethodSendsCommentIfSet()
    {
        $guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->disableOriginalConstructor()->getMock();
        $guzzleClientMock->expects($this->once())->method('put')
            ->with($this->equalTo('https://team.mydonedone.com/issuetracker/api/v2/projects/111/issues/321/fixer.json'), $this->equalTo(['body' => ['new_fixer_id' => 1, 'comment' => 'Comment!']]));

        $client = new Client('team', 'username', 'password');
        $client->setClient($guzzleClientMock);

        $client->project(111)->issue(321)->updateFixer(
            1, 'Comment!'
        );
    }

}
