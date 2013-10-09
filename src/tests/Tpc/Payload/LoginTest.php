<?php

namespace Tpc\Payload;

include_once(__DIR__ . '/../../../../vendor/autoload.php');

use Tpc\Payload\Login;
use PHPUnit_Framework_TestCase;

/**
 * Description of PayloadTest
 *
 * @author Bart Malestein <bart@isset.nl>
 */
class LoginTest extends PHPUnit_Framework_TestCase
{

    public function testLogin()
    {

        $client = new Login('www.test.nl/login', 'consumer_key', 'private_key');

        $this->assertInstanceOf('Tpc\Payload\Login', $client);

        $this->assertEquals($client->getUrl(), 'www.test.nl/login');

        $post_data = $client->getPostData();

        $this->assertEquals($post_data['consumer_key'], 'consumer_key');

        $this->assertEquals($post_data['time'], time());

        $this->assertContains('$6$rounds=9001$', $post_data['hash']);
        $this->assertContains('$consumer_key$', $post_data['hash']);

    }

}

