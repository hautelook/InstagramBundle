<?php

namespace Hautelook\InstagramBundle\Tests\Integration;

use Hautelook\InstagramBundle\Tests\Fixtures\InstagramTestResponseObject;
use Hautelook\InstagramBundle\Tests\Fixtures\ResponseFixtures;
use Hautelook\InstagramBundle\Instagram\Manager;
use Hautelook\InstagramBundle\Instagram\PostParser;

class InstaphpIntegrationTest extends \PHPUnit_Framework_TestCase
{
    const DESIRED_POST_COUNT = 6;

    public function testInvalidResponse()
    {
        $this->setExpectedException('Hautelook\InstagramBundle\Exception\InvalidInstagramResponseException');

        $invalidResponse = new InstagramTestResponseObject(null);
        $manager = $this->getMockedManager($invalidResponse);
        $posts = $manager->getRecent(self::DESIRED_POST_COUNT);
    }

    public function testEmptyResponse()
    {
        $this->setExpectedException('Hautelook\InstagramBundle\Exception\InvalidInstagramResponseException');

        $invalidResponse = new InstagramTestResponseObject(array());
        $manager = $this->getMockedManager($invalidResponse);
        $posts = $manager->getRecent(self::DESIRED_POST_COUNT);
    }

    public function testGetRecent()
    {
        $responseObject = ResponseFixtures::getSampleInstagramResponse();

        $manager = $this->getMockedManager($responseObject);
        $posts = $manager->getRecent(self::DESIRED_POST_COUNT);

        $this->assertTrue(is_array($posts));
        $this->assertCount(self::DESIRED_POST_COUNT, $posts);
    }

    public function testGetRecentOverMax()
    {
        $responseObject = ResponseFixtures::getSampleInstagramResponse();

        $manager = $this->getMockedManager($responseObject);
        $posts = $manager->getRecent(Manager::MAX_RECENT+10);

        $this->assertTrue(is_array($posts));
        $this->assertCount(Manager::MAX_RECENT, $posts);
    }

    private function getMockedManager($responseObject)
    {
        $instaUser = $this->getMockBuilder('Instaphp\Instagram\Users')
            ->disableOriginalConstructor()
            ->setMethods(array('Recent'))
            ->getMock();
        ;

        $instaUser
            ->expects($this->any())
            ->method('Recent')
            ->withAnyParameters()
            ->will($this->returnValue($responseObject))
        ;

        $instaphp = $this->getMockBuilder('Instaphp\Instaphp')
            ->disableOriginalConstructor()
            ->setMethods(array('__get'))
            ->getMock()
        ;

        $instaphp
            ->expects($this->any())
            ->method('__get')
            ->with('Users')
            ->will($this->returnValue($instaUser))
        ;

        return new Manager($instaphp, new PostParser(), 5);
    }
}
