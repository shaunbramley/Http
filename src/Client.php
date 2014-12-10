<?php

namespace Bramley\Http;

use Bramley\Http\SubmitableInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use Symfony\Component\DomCrawler\Form;


class Client implements SubmitableInterface, ClientInterface
{
    protected $client;
    
    public function __construct(GuzzleClient $client) {
        $this->client = $client;
    }
    public function submit(Form $form, array $values = [])
    {
        //TODO: set the form values to those of the array.
        return $this->createRequest(
            $form->getMethod(),
            $form->getUri(),
            ['body' => $form->getPhpValues()]
        );
    }

    public function getBaseUrl()
    {
        return $this->client->getBaseUrl();
    }

    public function put($url = null, array $options = [])
    {
        return $this->send($this->createRequest('PUT', $url, $options));
    }

    public function post($url = null, array $options = [])
    {
        return $this->send($this->createRequest('POST', $url, $options));
    }

    public function send(RequestInterface $request)
    {
        return $this->client->send($request);
    }

    public function get($url = null, $options = [])
    {
        return $this->send($this->createRequest('GET', $url, $options));
    }

    public function getDefaultOption($keyOrPath = null)
    {
        return $this->client->getDefaultOption($keyOrPath);
    }

    public function setDefaultOption($keyOrPath, $value)
    {
        return $this->client->setDefaultOption($keyOrPath, $value);
    }

    public function getEmitter()
    {
        return $this->client->getEmitter();
    }

    public function delete($url = null, array $options = [])
    {
        return $this->send($this->createRequest('DELETE', $url, $options));
    }

    public function createRequest($method, $url = null, array $options = [])
    {
        $options['emitter'] = $this->getEmitter();
        return $this->client->createRequest($method, $url, $options);
    }

    public function head($url = null, array $options = [])
    {
        return $this->send($this->createRequest('HEAD', $url, $options));
    }

    public function patch($url = null, array $options = [])
    {
        return $this->send($this->createRequest('PATCH', $url, $options));
    }

    public function options($url = null, array $options = [])
    {
        return $this->send($this->createRequest('OPTIONS', $url, $options));
    }
}

?>