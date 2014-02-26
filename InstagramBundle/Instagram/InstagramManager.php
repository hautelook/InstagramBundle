<?php

namespace InstagramBundle\Instagram;

use InstagramBundle\Instagram\InstagramPostBuilder;
use Instaphp\Instaphp;

class InstagramManager
{
    const MAX_RECENT = 20;

    private $instaphp;

    private $userId;

    public function __construct($clientId, $clientIdSecret, $userId)
    {
        $this->instaphp = new Instaphp(
            array(
                'client_id' => $clientId,
                'client_secret' => $clientIdSecret,
            )
        );
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

        $instagramPostBuilder = new InstagramPostBuilder();
        foreach ($rawResponseData as $rawPostData) {
            $posts[] = $instagramPostBuilder->build($rawPostData);
        }

        return $posts;
    }
}
