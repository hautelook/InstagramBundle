<?php

namespace InstagramBundle\Model;

class InstagramUser
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $profilePicture;

    /**
     * @param int    $id
     * @param string $userName
     * @param string $fullName
     * @param string $profilePicture
     */
    public function __construct($id, $userName, $fullName, $profilePicture)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->profilePicture = $profilePicture;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
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
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }
}
