<?php

namespace Hautelook\InstagramBundle\Model;

use Hautelook\InstagramBundle\Model\User;
use Hautelook\InstagramBundle\Model\Comment;
use Hautelook\InstagramBundle\Model\Image;

class Post
{
    /**
     * @var $id
     */
    private $id;

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

    /**
     * @param int    $id
     * @param string $caption
     * @param int    $createdTime
     * @param string $link
     * @param array  $likes
     * @param array  $comments
     * @param array  $images
     */
    public function __construct(
        $id,
        $caption,
        $createdTime,
        $link,
        array $likes,
        array $comments,
        array $images
    ) {
        $this->id = $id;
        $this->caption = $caption;
        $this->createdTime = $createdTime;
        $this->link = $link;
        $this->likes = $likes;
        $this->comments = $comments;
        $this->images = $images;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return int
     */
    public function getNumComments()
    {
        return count($this->comments);
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
     * @return string[]
     */
    public function getImageKeys()
    {
        return array_keys($this->images);
    }

    /**
     * @return User[]
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @return int
     */
    public function getNumLikes()
    {
        return count($this->getLikes());
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}
