<?php

namespace Tpc\Connection;

use Tpc\Payload\Payload;

interface TypeInterface
{

    public function sendPayload(Payload $payload);
}