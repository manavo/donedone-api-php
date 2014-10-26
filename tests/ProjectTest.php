<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\Project;
use PHPUnit_Framework_TestCase;

class ProjectTest extends PHPUnit_Framework_TestCase
{

    public function testIssueMethodReturnsIssueObject()
    {
        $project = new Project(null, 0);
        $this->assertInstanceOf('Manavo\\DoneDone\\Issue', $project->issue(1));
    }

}
