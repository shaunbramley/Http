<?php

namespace Bramley\Http;

use Bramley\Http\SubmitableInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use Symfony\Component\DomCrawler\Form;

/*
 * 
 */
class Client implements SubmitableInterface, ClientInterface
{
	/**
	 * 
	 */
	protected $client;

	/**
	 * 
	 * @param GuzzleClient $client
	 */
	public function __construct(GuzzleClient $client) {
        $this->client = $client;
        $this->client->setDefaultOption('headers/User-Agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:33.0) Gecko/20100101 Firefox/33.0');
	}

	/**
     * (non-PHPdoc)
     * @see \Bramley\Http\SubmitableInterface::submit()
     */
	public function submit(Form $form, array $values = []) {
        $form->setValues($values);
        $request = $this->createRequest(
            $form->getMethod(),
            $form->getUri(),
            ['body' => $form->getPhpValues()]
        );
        return $this->send($request);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::getBaseUrl()
	 */
	public function getBaseUrl() {
		return $this->client->getBaseUrl();
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::put()
	 */
	public function put($url = null, array $options = []) {
		return $this->send($this->createRequest('PUT', $url, $options));
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::post()
	 */
	public function post($url = null, array $options = []) {
		return $this->send($this->createRequest('POST', $url, $options));
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::send()
	 */
	public function send(RequestInterface $request) {
		return $this->client->send($request);
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::get()
	 */
	public function get($url = null, $options = []) {
		return $this->send($this->createRequest('GET', $url, $options));
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::getDefaultOption()
	 */
	public function getDefaultOption($keyOrPath = null) {
		return $this->client->getDefaultOption($keyOrPath);
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::setDefaultOption()
	 */
	public function setDefaultOption($keyOrPath, $value) {
		return $this->client->setDefaultOption($keyOrPath, $value);
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\Event\HasEmitterInterface::getEmitter()
	 */
	public function getEmitter() {
		return $this->client->getEmitter();
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::delete()
	 */
	public function delete($url = null, array $options = []) {
		return $this->send($this->createRequest('DELETE', $url, $options));
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::createRequest()
	 */
	public function createRequest($method, $url = null, array $options = []) {
		return $this->client->createRequest($method, $url, $options);
	}
	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::head()
	 */
    public function head($url = null, array $options = []) {
		return $this->send($this->createRequest('HEAD', $url, $options));
    }

    /**
     * (non-PHPdoc)
     * @see \GuzzleHttp\ClientInterface::patch()
     */
	public function patch($url = null, array $options = []) {
		return $this->send($this->createRequest('PATCH', $url, $options));
	}

	/**
	 * (non-PHPdoc)
	 * @see \GuzzleHttp\ClientInterface::options()
	 */
	public function options($url = null, array $options = []) {
		return $this->send($this->createRequest('OPTIONS', $url, $options));
	}

	/**
	 * 
	 * @see \GuzzleHttp\Client::getDefaultUserAgent()
	 */
	public static function getDefaultUserAgent() {
		return GuzzleClient::getDefaultUserAgent();
	}

	/**
	 *
	 * @see \GuzzleHttp\Client::getDefaultUserAgent()
	 */
	 public static function getDefaultHandler() {
		return GuzzleClient::getDefaultHandler();
	}
}