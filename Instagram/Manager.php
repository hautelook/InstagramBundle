<?php

namespace Hautelook\InstagramBundle\Instagram;

use Hautelook\InstagramBundle\Exception\InvalidInstagramResponseException;
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

    /**
     * @param Instaphp $instaphp
     * @param PostParser $postParser
     * @param int $userId
     */
    public function __construct(Instaphp $instaphp, PostParser $postParser, $userId)
    {
        $this->instaphp = $instaphp;
        $this->postParser = $postParser;
        $this->userId = $userId;
    }

    /**
     * @param int $numRecent
     * @return array
     * @throws InvalidInstagramResponseException
     */
    public function getRecent($numRecent)
    {
        $data = $this->instaphp->Users->Recent($this->userId)->data;

        if (empty($data)) {
            throw new InvalidInstagramResponseException();
        }

        $rawResponseData = array_slice($data, 0, min($numRecent, self::MAX_RECENT));

        return $this->buildPosts($rawResponseData);
    }

    /**
     * @param array $rawResponseData
     * @return array
     */
    private function buildPosts(array $rawResponseData)
    {
        $posts = array();

        $postParser = $this->getPostParser();
        foreach ($rawResponseData as $rawPostData) {
            $posts[] = $postParser->parse($rawPostData);
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
