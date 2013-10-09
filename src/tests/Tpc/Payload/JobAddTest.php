<?php

namespace Tpc\Payload;

include_once(__DIR__ . '/../../../../vendor/autoload.php');

use Tpc\Payload\JobAdd;
use PHPUnit_Framework_TestCase;

/**
 * Description of PayloadTest
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class JobAddTest extends PHPUnit_Framework_TestCase
{

    public function testJobAdd()
    {

        $client_add = new JobAdd('www.test.nl/api/job/add', 'workflow', 'callback');

        $this->assertInstanceOf('Tpc\Payload\JobAdd', $client_add);

        $this->assertEquals($client_add->getUrl(), 'www.test.nl/api/job/add');

        $post_data = $client_add->getPostData();

        $this->assertEquals($post_data['workflow'], 'workflow');
        $this->assertEquals($post_data['callback'], 'callback');

    }

}

