<?php

namespace Tpc\Payload;

class JobAdd extends Payload
{

    public function __construct($url,$workflow, $callback)
    {
        parent::__construct($url);
        $this->setPostData('callback', $callback);
        $this->setPostData('workflow', $workflow);

    }

}