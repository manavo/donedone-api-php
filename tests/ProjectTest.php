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

}
