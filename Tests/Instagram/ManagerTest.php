<?php

namespace Hautelook\InstagramBundle\Tests\Instagram;

use Hautelook\InstagramBundle\Tests\Fixtures\InstagramTestResponseObject;
use Hautelook\InstagramBundle\Tests\Fixtures\ResponseFixtures;
use Hautelook\InstagramBundle\Instagram\Manager;
use Hautelook\InstagramBundle\Instagram\PostParser;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidResponse()
    {
        $this->setExpectedException('Hautelook\InstagramBundle\Exception\InvalidInstagramResponseException');

        $invalidResponse = new InstagramTestResponseObject(null);
        $manager = $this->getMockedManager($invalidResponse);
        $posts = $manager->getRecent(6);
    }

    public function testEmptyResponse()
    {
        $this->setExpectedException('Hautelook\InstagramBundle\Exception\InvalidInstagramResponseException');

        $invalidResponse = new InstagramTestResponseObject(array());
        $manager = $this->getMockedManager($invalidResponse);
        $posts = $manager->getRecent(6);
    }

    public function testGetRecent()
    {
        $responseObject = ResponseFixtures::getSampleInstagramResponse();

        $manager = $this->getMockedManager($responseObject);
        $posts = $manager->getRecent(6);

        $this->assertTrue(is_array($posts));
        $this->assertCount(6, $posts);

        /**
         * @var $firstPost Hautelook\InstagramBundle\Model\Post
         */
        $firstPost = $posts[0];
        $this->assertEquals(
            'We like to make statements. Bold #baubles start at $14.97. #accessorize',
            $firstPost->getCaption()
        );

        /**
         * @var $firstImage Hautelook\InstagramBundle\Model\Image
         */
        $images = $firstPost->getImages();
        $this->assertArrayHasKey('standard_resolution', $images);
        $standardImage = $images['standard_resolution'];
        $this->assertEquals(
            'http://distilleryimage0.s3.amazonaws.com/9b347072a09f11e3b66a128b5b5a1c60_8.jpg',
            $standardImage->getUrl()
        );

        /**
         * @var $firstLike Hautelook\InstagramBundle\Model\User
         */
        $firstLike = $firstPost->getLikes()[0];
        $this->assertEquals(
            'Jessica Van Tassel',
            $firstLike->getFullName()
        );

        /**
         * @var $firstComment Hautelook\InstagramBundle\Model\Comment
         */
        $firstComment = $firstPost->getComments()[0];
        $this->assertContains(
            'My go to store for the best costume jewelry',
            $firstComment->getText()
        );
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
