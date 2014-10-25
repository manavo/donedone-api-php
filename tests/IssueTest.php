<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\Issue;
use PHPUnit_Framework_TestCase;

class IssueTest extends PHPUnit_Framework_TestCase
{

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

    public function testUserIdsToCcIsACommaSeparatedString()
    {
        $issue = new Issue();
        $issue->setUserIdsToCc([1, 2, 3]);

        $this->assertEquals('1,2,3', $issue->toArray()['user_ids_to_cc']);
    }

}
