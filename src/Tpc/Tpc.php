<?php

namespace Tpc;

use Tpc\Connection\Curl\CurlPost;
use Tpc\Payload\Payload as PayloadItem;
use Tpc\Payload\Login;

class Tpc
{

    private $tokenPath;
    private $baseLink;

    /**
     *
     * @var \Tpc\Connection\TypeInterface
     */
    private $interface;
    private $token = false;
    private $loginPayload;

    public function __construct($api, $consumerKey, $privateKey, $tokenCacheLocation = false)
    {
        if (!$tokenCacheLocation) {
            $tokenCacheLocation = __DIR__ . '/../Cache/';
        }

        $tokenCacheLocation = rtrim($tokenCacheLocation, '/') . '/';
        if (!is_writable($tokenCacheLocation)) {
            throw new \Exception('token cache location isn\'t writeable: ' . $tokenCacheLocation);
        }

        $this->tokenPath    = $tokenCacheLocation . $consumerKey . '-token';
        $this->baseLink     = rtrim($api, '/') . '/';
        $this->interface    = new CurlPost();
        $this->loginPayload = new Login($this->baseLink . 'login', $consumerKey, $privateKey);
    }

    public function createJobAddPayload($workflow, $callback)
    {
        return new Payload\JobAdd($this->baseLink . 'job/add', $workflow, $callback);
    }

    public function createJobStatusPayload($identifier)
    {
        return new Payload\JobStatus($this->baseLink . 'job/', $identifier);
    }

    public function createJobRevokePayload($identifier)
    {
        return new Payload\JobRevoke($this->baseLink . 'job/', $identifier);
    }

    /**
     *
     * @param \Tpc\Payload\Payload $payload
     * @param boolean $addHeader
     * @param string $header
     * @return \Tpc\Connection\ResponseInterface
     * @throws \Exception
     */
    public function sendPayload(PayloadItem $payload, $addHeader = true, $header = 'tpc-auth-token')
    {
        if ($addHeader) {
            $payload->setHeader($header, $this->getToken());
        }
        $response = $this->interface->sendPayload($payload);
        /* @var $response \Tpc\Connection\ResponseInterface */
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return $response->getJsonResponse();
        } else {
            if ($response->getStatusCode() == 401 || $response->getStatusCode() == 403) {
                if (file_exists($this->tokenPath)) {
                    unlink($this->tokenPath);
                }
                $this->token = false;
            }

            $ex = new Connection\ResponseException('Send failed');
            $ex->setResponse($response);
            throw $ex;
        }
    }

    public function getToken()
    {
        if ($this->token) {
            return $this->token;
        }

        if (file_exists($this->tokenPath)) {
            return file_get_contents($this->tokenPath);
        }
        $data = $this->sendPayload($this->loginPayload, false);

        $this->token = $data->token;
        file_put_contents($this->tokenPath, $data->token);

        return $data->token;
    }

}
