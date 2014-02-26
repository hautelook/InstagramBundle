<?php

namespace InstagramBundle\Model;

use InstagramBundle\Model\InstagramUser;
use InstagramBundle\Model\InstagramComment;
use InstagramBundle\Model\InstagramImage;

class InstagramPost
{
    /**
     * @var string
     */
    private $caption;

    /**
     * @var \DateTime
     */
    private $createdTime;

    /**
     * @var string
     */
    private $link;

    /**
     * @var InstagramUser[]
     */
    private $likes;

    /**
     * @var InstagramComment[]
     */
    private $comments;

    /**
     * @var InstagramImage[]
     */
    private $images;

    public function __construct(
        $caption,
        $createdTime,
        $link,
        array $likes,
        array $comments,
        array $images
    ) {
        $this->caption = $caption;
        $this->createdTime = $createdTime;
        $this->link = $link;
        $this->likes = $likes;
        $this->comments = $comments;
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @return InstagramComment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * @return string
     */
    public function getCreatedTimeW3C()
    {
        return $this->createdTime->format(\DateTime::W3C);
    }

    /**
     * @return InstagramImage[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return InstagramUser[]
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}
