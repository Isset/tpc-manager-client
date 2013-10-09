<?php

namespace Tpc\Payload;

include_once(__DIR__ . '/../../../../vendor/autoload.php');

use Tpc\Payload\JobStatus;
use PHPUnit_Framework_TestCase;

/**
 * Description of PayloadTest
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class JobStatusTest extends PHPUnit_Framework_TestCase
{

    public function testJobStatus()
    {

        $client = new JobStatus('www.test.nl/api/status/', '12345');

        $this->assertInstanceOf('Tpc\Payload\JobStatus', $client);

        $this->assertEquals($client->getUrl(), 'www.test.nl/api/status/12345');


    }

}

