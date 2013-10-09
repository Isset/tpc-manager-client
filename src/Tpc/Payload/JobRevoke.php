<?php

namespace Tpc\Payload;

class JobRevoke extends Payload
{

    public function __construct($url, $identifier)
    {
        parent::__construct($url . $identifier . '/revoke');

    }

}