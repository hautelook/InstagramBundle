<?php

namespace Hautelook\InstagramBundle\Tests\Model;

use Hautelook\InstagramBundle\Tests\Fixtures\InstagramTestResponseObject;
use Hautelook\InstagramBundle\Tests\Fixtures\ResponseFixtures;
use Hautelook\InstagramBundle\Model\User;

class UserTest extends \PHPUnit_Framework_TestCase
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

        $this->assertEquals(
            200,
            $user->getId()
        );

        $this->assertEquals(
            'user name',
            $user->getUserName()
        );

        $this->assertEquals(
            'full name',
            $user->getFullName()
        );

        $this->assertEquals(
            'profile picture',
            $user->getProfilePicture()
        );
    }
}
