<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\ReleaseBuild;

class ReleaseBuildTest extends \PHPUnit_Framework_TestCase
{

    public function testRequiredParametersIncludedWhenConvertingToArray()
    {
        $releaseBuildArray = (new ReleaseBuild())->toArray();

        $this->assertArrayHasKey('order_numbers', $releaseBuildArray);
        $this->assertArrayHasKey('title', $releaseBuildArray);

        $this->assertEquals(2, count($releaseBuildArray));
    }

    public function testTitleGetsSet()
    {
        $releaseBuild = new ReleaseBuild();
        $releaseBuild->setTitle('my title');

        $this->assertEquals('my title', $releaseBuild->toArray()['title']);
    }

    public function testOrderNumbersIsACommaSeparatedString()
    {
        $releaseBuild = new ReleaseBuild();
        $releaseBuild->setIssueIds(['1', '2', '3']);

        $this->assertEquals('1,2,3', $releaseBuild->toArray()['order_numbers']);
    }

    public function testDescriptionIsAddedIfNotEmpty()
    {
        $releaseBuild = new ReleaseBuild();
        $releaseBuild->setDescription('desc');

        $this->assertArrayHasKey('description', $releaseBuild->toArray());
    }

    public function testEmailBodyIsAddedIfNotEmpty()
    {
        $releaseBuild = new ReleaseBuild();
        $releaseBuild->setEmailBody('email');

        $this->assertArrayHasKey('email_body', $releaseBuild->toArray());
    }

}
