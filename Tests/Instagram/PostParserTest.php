<?php

namespace Hautelook\InstagramBundle\Tests\Instagram;

use Hautelook\InstagramBundle\Tests\Fixtures\InstagramTestResponseObject;
use Hautelook\InstagramBundle\Tests\Fixtures\ResponseFixtures;
use Hautelook\InstagramBundle\Instagram\PostParser;

class PostParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $postParser = new PostParser();
        $instagramPost = $postParser->parse($this->getOneInstagramPostRawData());

        $this->assertEquals(
            'Hautelook\InstagramBundle\Model\Post',
            get_class($instagramPost)
        );

        $this->assertEquals(
            'We like to make statements. Bold #baubles start at $14.97. #accessorize',
            $instagramPost->getCaption()
        );

        /**
         * @var $firstImage Hautelook\InstagramBundle\Model\Image
         */
        $images = $instagramPost->getImages();
        $this->assertArrayHasKey('standard_resolution', $images);
        $standardImage = $images['standard_resolution'];
        $this->assertEquals(
            'http://distilleryimage0.s3.amazonaws.com/9b347072a09f11e3b66a128b5b5a1c60_8.jpg',
            $standardImage->getUrl()
        );

        /**
         * @var $firstLike Hautelook\InstagramBundle\Model\User
         */
        $firstLike = $instagramPost->getLikes()[0];
        $this->assertEquals(
            'Jessica Van Tassel',
            $firstLike->getFullName()
        );

        /**
         * @var $firstComment Hautelook\InstagramBundle\Model\Comment
         */
        $firstComment = $instagramPost->getComments()[0];
        $this->assertContains(
            'My go to store for the best costume jewelry',
            $firstComment->getText()
        );
    }

    public function getOneInstagramPostRawData()
    {
        return ResponseFixtures::getSampleInstagramResponse()->data[0];
    }
}
