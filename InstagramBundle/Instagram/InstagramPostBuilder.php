<?php

namespace InstagramBundle\Instagram;

use InstagramBundle\Instagram\InstagramPostBuilderInterface;
use InstagramBundle\Model\InstagramPost;
use InstagramBundle\Model\InstagramUser;
use InstagramBundle\Model\InstagramComment;
use InstagramBundle\Model\InstagramImage;

class InstagramPostBuilder
{
    /**
     * @param array $rawPostData
     * @return InstagramPost
     */
    public function build(array $rawPostData)
    {
        $likes = $this->buildLikes($rawPostData['likes']['data']);
        $comments = $this->buildComments($rawPostData['comments']['data']);
        $images = $this->buildImages($rawPostData['images']);

        $post = new InstagramPost(
            $rawPostData['caption']['text'],
            new \DateTime(date(\DateTime::W3C, $rawPostData['created_time'])),
            $rawPostData['link'],
            $likes,
            $comments,
            $images
        );

        return $post;
    }

    /**
     * @param array $rawLikeData
     * @return InstagramUser[]
     */
    private function buildLikes(array $rawLikeData) {
        $likes = array();

        foreach ($rawLikeData as $like) {
            $likes[] = new InstagramUser(
                $like['id'],
                $like['username'],
                $like['full_name'],
                $like['profile_picture']
            );
        }

        return $likes;
    }

    /**
     * @param array $rawCommentData
     * @return InstagramComment[]
     */
    private function buildComments(array $rawCommentData) {
        $comments = array();

        foreach ($rawCommentData as $comment) {
            $user = new InstagramUser(
                $comment['from']['id'],
                $comment['from']['username'],
                $comment['from']['full_name'],
                $comment['from']['profile_picture']
            );

            $comments[] = new InstagramComment(
                $comment['id'],
                new \DateTime(date(\DateTime::W3C, $comment['created_time'])),
                $comment['text'],
                $user
            );
        }

        return $comments;
    }

    /**
     * @param array $rawImageData
     * @return InstagramImage[]
     */
    private function buildImages(array $rawImageData) {
        $images = array();

        foreach ($rawImageData as $key => $image) {
            $images[$key] = new InstagramImage(
                $image['url'],
                $image['width'],
                $image['height']
            );
        }

        return $images;
    }
}
