<?php

namespace InstagramBundle\Model;

class InstagramImage
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @param string $url
     * @param int    $width
     * @param int    $height
     */
    public function __construct($url, $width, $height)
    {
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }
}
