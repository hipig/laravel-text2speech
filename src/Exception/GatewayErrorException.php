<?php

namespace Hipig\LaravelTts\Exceptions;

use Exception;
use Throwable;

/**
 * Class GatewayErrorException
 */
class GatewayErrorException extends Exception
{
    /**
     * @var mixed
     */
    public $raw;

    /**
     * GatewayErrorException constructor.
     *
     * @param string $message
     * @param int $code
     * @param array $raw
     */
    public function __construct($message = "", $code = 0, $raw = null)
    {
        $this->raw = $raw;
        parent::__construct($message, $code);
    }
}
