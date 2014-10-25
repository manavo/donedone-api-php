<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\Company;
use PHPUnit_Framework_TestCase;

class CompanyTest extends PHPUnit_Framework_TestCase
{

    public function testRequiredParametersIncludedWhenConvertingToArray()
    {
        $this->assertArrayHasKey('company_name', (new Company())->toArray());
    }

}
