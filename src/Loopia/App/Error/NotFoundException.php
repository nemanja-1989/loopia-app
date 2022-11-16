<?php

/*
 * © Loopia. All rights reserved.
 */
namespace Loopia\App\Error;

class NotFoundException extends \Exception {
	public function __construct(string $url, string $message = "", int $code = 0, \Throwable $previous = null) {
		parent::__construct('Route not found: ' . $url . '; ' .$message, $code, $previous);
	}
}
