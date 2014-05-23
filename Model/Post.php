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
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $numLikes;

    /**
     * @var int
     */
    private $numComments;

    /**
     * @param int    $id
     * @param string $caption
     * @param int    $createdTime
     * @param string $link
     * @param User   $user
     * @param array  $likes
     * @param array  $comments
     * @param array  $images
     * @param int    $numLikes
     * @param int    $numComments
     */
    public function __construct(
        $id,
        $caption,
        $createdTime,
        $link,
        $user,
        array $likes,
        array $comments,
        array $images,
        $numLikes,
        $numComments
    ) {
        $this->id = $id;
        $this->caption = $caption;
        $this->createdTime = $createdTime;
        $this->link = $link;
        $this->user = $user;
        $this->likes = $likes;
        $this->comments = $comments;
        $this->images = $images;
        $this->numLikes = $numLikes;
        $this->numComments = $numComments;
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
        return $this->numComments;
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
        return $this->numLikes;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
