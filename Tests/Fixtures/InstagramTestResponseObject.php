<?php

namespace Hautelook\InstagramBundle\Tests\Fixtures;

class InstagramTestResponseObject
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}
