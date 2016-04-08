<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\Client;
use Manavo\DoneDone\Company;
use PHPUnit_Framework_TestCase;

class CompanyTest extends PHPUnit_Framework_TestCase
{

    public function testRequiredParametersIncludedWhenConvertingToArray()
    {
        $this->assertArrayHasKey('company_name', (new Company())->toArray());
    }

    public function testTitleGetsSet()
    {
        $company = new Company();
        $company->setName('my name');

        $this->assertEquals('my name', $company->toArray()['company_name']);
    }

    public function testUpdateNameMakesPutRequest()
    {
        $guzzleClientMock = $this->getMockBuilder('\GuzzleHttp\Client')
            ->disableOriginalConstructor()->getMock();
        $guzzleClientMock->expects($this->once())->method('put');

        $client = new Client('team', 'username', 'password');
        $client->setClient($guzzleClientMock);

        $company = $client->company(3);

        $company->updateName('name');
    }

}
