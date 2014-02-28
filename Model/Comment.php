<?php

namespace Hautelook\InstagramBundle\Model;

use Hautelook\InstagramBundle\Model\InstagramUser;

class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdTime;

    /**
     * @var string
     */
    private $text;

    /**
     * @var User
     */
    private $user;

    /**
     * @param $id
     * @param \DateTime $createdTime
     * @param $text
     * @param User $user
     */
    public function __construct($id, \DateTime $createdTime, $text, User $user)
    {
        $this->id = $id;
        $this->createdTime = $createdTime;
        $this->text = $text;
        $this->user = $user;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
