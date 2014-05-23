<?php

namespace Hautelook\InstagramBundle\Instagram;

use Hautelook\InstagramBundle\Model\Post;
use Hautelook\InstagramBundle\Model\User;
use Hautelook\InstagramBundle\Model\Comment;
use Hautelook\InstagramBundle\Model\Image;

class PostParser
{
    /**
     * @param array $rawPostData
     * @return Post
     */
    public function parse(array $rawPostData)
    {
        $likes = $this->parseLikes($rawPostData['likes']['data']);
        $comments = $this->parseComments($rawPostData['comments']['data']);
        $images = $this->parseImages($rawPostData['images']);
        $user = $this->parseUser($rawPostData['user']);

        $post = new Post(
            $rawPostData['id'],
            $rawPostData['caption']['text'],
            new \DateTime(date(\DateTime::W3C, $rawPostData['created_time'])),
            $this->stripProtocolFromUrl($rawPostData['link']),
            $user,
            $likes,
            $comments,
            $images,
            intval($rawPostData['likes']['count']),
            intval($rawPostData['comments']['count'])
        );

        return $post;
    }

    /**
     * @param array $rawLikeData
     * @return User[]
     */
    private function parseLikes(array $rawLikeData) {
        $likes = array();

        foreach ($rawLikeData as $like) {
            $likes[] = new User(
                $like['id'],
                $like['username'],
                $like['full_name'],
                $this->stripProtocolFromUrl($like['profile_picture'])
            );
        }

        return $likes;
    }

    /**
     * @param array $rawCommentData
     * @return Comment[]
     */
    private function parseComments(array $rawCommentData) {
        $comments = array();

        foreach ($rawCommentData as $comment) {
            $user = new User(
                $comment['from']['id'],
                $comment['from']['username'],
                $comment['from']['full_name'],
                $this->stripProtocolFromUrl($comment['from']['profile_picture'])
            );

            $comments[] = new Comment(
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
     * @return Image[]
     */
    private function parseImages(array $rawImageData) {
        $images = array();

        foreach ($rawImageData as $key => $image) {
            $images[$key] = new Image(
                $this->stripProtocolFromUrl($image['url']),
                $image['width'],
                $image['height']
            );
        }

        return $images;
    }

    private function parseUser(array $rawUserData) {
        return new User(
            $rawUserData['id'],
            $rawUserData['username'],
            $rawUserData['full_name'],
            $this->stripProtocolFromUrl($rawUserData['profile_picture'])
        );
    }

    /**
     * @param string $url
     * @return string
     */
    private function stripProtocolFromUrl($url)
    {
        return preg_replace('/^http\:/', '', $url);
    }
}
