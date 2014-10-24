<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\ReleaseBuild;

class ReleaseBuildTest extends \PHPUnit_Framework_TestCase
{

    public function testRequiredParametersIncludedWhenConvertingToArray() {
        $releaseBuildArray = (new ReleaseBuild())->toArray();

        $this->assertArrayHasKey('order_numbers', $releaseBuildArray);
        $this->assertArrayHasKey('title', $releaseBuildArray);

        $this->assertEquals(2, count($releaseBuildArray));
    }

}
