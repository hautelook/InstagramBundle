<?php

namespace Hautelook\InstagramBundle\Exception;

class InvalidInstagramResponseException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            "The response from Instagram cannot be parsed."
        );
    }
}
