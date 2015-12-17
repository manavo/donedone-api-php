<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\ReleaseBuildInfo;

class ReleaseBuildInfoTest extends \PHPUnit_Framework_TestCase
{

    public function testRequiredParametersIncludedWhenConvertingToArray()
    {
        $releaseBuildArray = (new ReleaseBuildInfo())->toArray();

        $this->assertArrayHasKey('id', $releaseBuildArray);
        $this->assertArrayHasKey('title', $releaseBuildArray);

        $this->assertEquals(3, count($releaseBuildArray));
    }

    public function testFieldsGetPopulated()
    {
        $releaseBuild = new ReleaseBuildInfo([
            'id' => 12,
            'title' => 'my title',
            'order_numbers_ready_for_next_release' => [1, 2, 3]
        ]);

        $this->assertEquals('12', $releaseBuild->getId());
        $this->assertEquals('my title', $releaseBuild->getTitle());
        $this->assertEquals([1, 2, 3], $releaseBuild->getOrderNumbersReadyForNextRelease());
    }

    public function testOrderNumbersIsACommaSeparatedString()
    {
        $releaseBuild = new ReleaseBuildInfo([
            'id' => 12,
            'title' => 'my title',
            'order_numbers_ready_for_next_release' => [1, 2, 3]
        ]);

        $this->assertEquals([1, 2, 3], $releaseBuild->toArray()['order_numbers_ready_for_next_release']);
    }
}
