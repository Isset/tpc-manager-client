Example
=======

    <?php

    include '../src/Tpc/Autoloader.php';
    $tpc  = new Tpc\Tpc('api_url', 'consumerkey', 'secret');
    $test = $tpc->createJobAddPayload('workflow', 'callback');
    $test->setPostData('file[2]', 'filelocation');
    var_dump($tpc->sendPayload($test));
