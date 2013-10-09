<?php

namespace Tpc\Payload;

include_once(__DIR__ . '/../../../../vendor/autoload.php');

use Tpc\Payload\JobRevoke;
use PHPUnit_Framework_TestCase;

/**
 * Description of PayloadTest
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class JobRevokeTest extends PHPUnit_Framework_TestCase
{

    public function testJobRevoke()
    {

        $client_add = new JobRevoke('www.test.nl/api/job/', '12345');

        $this->assertInstanceOf('Tpc\Payload\JobRevoke', $client_add);

        $this->assertEquals($client_add->getUrl(), 'www.test.nl/api/job/12345/revoke');


    }

}

