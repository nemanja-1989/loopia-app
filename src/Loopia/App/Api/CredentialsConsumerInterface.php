<?php

/*
 * © Loopia. All rights reserved.
 */

namespace Loopia\App\Api;

interface CredentialsConsumerInterface {

	/**
	 * Returns closure that converts Credential object's data into authentication hash or token
	 * @return \Closure
	 */
	public function getConsumerClosure(): \Closure;
}
