<?php

namespace Hipig\LaravelTts\Exceptions;

use Exception;
use Throwable;

/**
 * Class NoGatewayAvailableException
 */
class NoGatewayAvailableException extends Exception
{
    /**
     * @var array
     */
    public $results = [];

    /**
     * @var array
     */
    public $exceptions = [];

    /**
     * NoGatewayAvailableException constructor.
     *
     * @param array $results
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $results = [], $code = 0, Throwable $previous = null)
    {
        $this->results = $results;
        $this->exceptions = \array_column($results, 'exception', 'gateway');

        parent::__construct('All the gateways have failed. You can get error details by `$exception->getExceptions()`', $code, $previous);
    }

    /**
     * Get all result.
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Get Exception.
     *
     * @param string $gateway
     * @return mixed|null
     */
    public function getException($gateway)
    {
        return isset($this->exceptions[$gateway]) ? $this->exceptions[$gateway] : null;
    }

    /**
     * Get all exception.
     *
     * @return array
     */
    public function getExceptions()
    {
        return $this->exceptions;
    }

    /**
     * Get last exception.
     *
     * @return mixed
     */
    public function getLastException()
    {
        return end($this->exceptions);
    }
}
