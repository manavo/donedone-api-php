<?php

namespace Manavo\DoneDone\Test;

use Manavo\DoneDone\Comment;

class CommentTest extends \PHPUnit_Framework_TestCase
{

    public function testRequiredParametersIncludedWhenConvertingToArray()
    {
        $this->assertArrayHasKey('comment', (new Comment())->toArray());
    }

    public function testAttachmentsGetAddedWhenConvertingToArray()
    {
        $comment = new Comment();
        $comment->setMessage('comment');
        $comment->addAttachment(__FILE__);
        $comment->addAttachment(__FILE__);
        $comment->addAttachment(__FILE__);
        $comment->addAttachment(__FILE__);

        $this->assertEquals(5, count($comment->toArray()));
    }

}
