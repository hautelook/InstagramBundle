<?php

namespace Hautelook\InstagramBundle\Tests\Model;

use Hautelook\InstagramBundle\Tests\Fixtures\InstagramTestResponseObject;
use Hautelook\InstagramBundle\Tests\Fixtures\ResponseFixtures;
use Hautelook\InstagramBundle\Model\Image;

class ImageTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $image = new Image(
            'some url',
            500,
            300
        );

        $this->assertEquals(
            'some url',
            $image->getUrl()
        );

        $this->assertEquals(
            500,
            $image->getWidth()
        );

        $this->assertEquals(
            300,
            $image->getHeight()
        );
    }
}
