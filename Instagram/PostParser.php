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

        $post = new Post(
            $rawPostData['id'],
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
     * @return User[]
     */
    private function parseLikes(array $rawLikeData) {
        $likes = array();

        foreach ($rawLikeData as $like) {
            $likes[] = new User(
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
     * @return Comment[]
     */
    private function parseComments(array $rawCommentData) {
        $comments = array();

        foreach ($rawCommentData as $comment) {
            $user = new User(
                $comment['from']['id'],
                $comment['from']['username'],
                $comment['from']['full_name'],
                $comment['from']['profile_picture']
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
                $image['url'],
                $image['width'],
                $image['height']
            );
        }

        return $images;
    }
}
