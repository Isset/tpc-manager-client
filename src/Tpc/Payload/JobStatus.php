<?php

namespace Tpc\Payload;

class JobStatus extends Payload
{

    public function __construct($url, $identifier)
    {
        parent::__construct($url . $identifier);
    }

}