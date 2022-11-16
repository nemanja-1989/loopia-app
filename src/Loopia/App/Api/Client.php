<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

use Closure;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;

class Client implements CredentialsConsumerInterface {

	protected Credentials $credentials;

	protected string $endpoint;

	protected GuzzleClient $client;

	public function __construct(Credentials $credentials, string $endpoint) {
		$this->credentials = $credentials;
		$this->endpoint = $endpoint;
		$this->client = new GuzzleClient([
			'base_uri' => $this->endpoint,
			'timeout' => 0,
			'allow_redirects' => false,
		]);
	}

	public function getConsumerClosure(): Closure {
		return function() {
			/* @var $this Credentials */
			if (false !== $hash = password_hash($this->password, PASSWORD_DEFAULT)) {
				return $this->username . ':' . base64_encode($hash);
			}

			throw new Exception('Failed creating authentication hash');
		};
	}

	public function getRequest(string $uri): Request {
		return new Request('GET', $uri, [
			'X-Authorization' => 'Bearer ' . $this->credentials->visit($this),
			'Accept'          => 'application/json'
		]);
	}

	public function send(Request $request) {
		return $this->client->send($request);
	}

}
