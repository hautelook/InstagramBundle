<?php

namespace Hautelook\InstagramBundle\Instagram;

use Hautelook\InstagramBundle\Instagram\PostParser;
use Instaphp\Instaphp;

class Manager
{
    const MAX_RECENT = 20;

    /**
     * @var Instaphp
     */
    private $instaphp;

    /**
     * @var PostParser
     */
    private $postParser;

    /**
     * @var int
     */
    private $userId;

    public function __construct($instaphp, $postParser, $userId)
    {
        $this->instaphp = $instaphp;
        $this->postParser = $postParser;
        $this->userId = $userId;
    }

    public function getRecent($numRecent)
    {
        $data = $this->instaphp->Users->Recent($this->userId)->data;
        $rawResponseData = array_slice($data, 0, min($numRecent, self::MAX_RECENT));

        return $this->buildPosts($rawResponseData);
    }

    private function buildPosts(array $rawResponseData)
    {
        $posts = array();

        $postParser = $this->getPostParser();
        foreach ($rawResponseData as $rawPostData) {
            $posts[] = $postParser->build($rawPostData);
        }

        return $posts;
    }

    /**
     * @return Instaphp
     */
    public function getInstaphp()
    {
        return $this->instaphp;
    }

    /**
     * @return PostParser
     */
    public function getPostParser()
    {
        return $this->postParser;
    }
}
