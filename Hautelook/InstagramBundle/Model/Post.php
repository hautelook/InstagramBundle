<?php

namespace Hautelook\InstagramBundle\Model;

use Hautelook\InstagramBundle\Model\User;
use Hautelook\InstagramBundle\Model\Comment;
use Hautelook\InstagramBundle\Model\Image;

class Post
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
     * @var User[]
     */
    private $likes;

    /**
     * @var Comment[]
     */
    private $comments;

    /**
     * @var Image[]
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
     * @return Comment[]
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
     * @return Image[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return User[]
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
