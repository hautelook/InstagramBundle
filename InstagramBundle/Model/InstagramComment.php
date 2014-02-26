<?php

namespace InstagramBundle\Model;

use InstagramBundle\Model\InstagramUser;

class InstagramComment
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
     * @var InstagramUser
     */
    private $user;

    /**
     * @param $id
     * @param \DateTime $createdTime
     * @param $text
     * @param InstagramUser $user
     */
    public function __construct($id, \DateTime $createdTime, $text, InstagramUser $user)
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
     * @return InstagramUser
     */
    public function getUser()
    {
        return $this->user;
    }
}
