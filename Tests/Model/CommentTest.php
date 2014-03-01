<?php

namespace Hautelook\InstagramBundle\Tests\Model;

use Hautelook\InstagramBundle\Tests\Fixtures\InstagramTestResponseObject;
use Hautelook\InstagramBundle\Tests\Fixtures\ResponseFixtures;
use Hautelook\InstagramBundle\Model\Comment;
use Hautelook\InstagramBundle\Model\User;

class CommentTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $createdTime = new \DateTime();

        $user = new User(
            200,
            'user name',
            'full name',
            'profile picture'
        );

        $comment = new Comment(
            100,
            $createdTime,
            'some text',
            $user
        );

        $this->assertEquals(
            100,
            $comment->getId()
        );

        $this->assertEquals(
            $createdTime,
            $comment->getCreatedTime()
        );

        $this->assertEquals(
            'some text',
            $comment->getText()
        );

        $this->assertSame(
            $user,
            $comment->getUser()
        );
    }
}
