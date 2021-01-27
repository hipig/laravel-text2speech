<?php

namespace Hipig\LaravelTts\Gateways;

use Hipig\LaravelTts\Contracts\GatewayInterface;

abstract class Gateway implements GatewayInterface
{
    const DEFAULT_TIMEOUT = 5;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var array
     */
    protected $options;

    /**
     * Get timeout.
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|int|mixed
     */
    public function getTimeout()
    {
        return $this->timeout ?? config('tts.timeout', self::DEFAULT_TIMEOUT);
    }


    /**
     * Set timeout.
     *
     * @param int $timeout
     * @return $this
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @param $options
     *
     * @return $this
     */
    public function setWebsocketOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return array
     */
    public function getWebsocketOptions()
    {
        return $this->options ?? config('tts.options', []);
    }

    /**
     * Get gateway name.
     *
     * @return string
     */
    public function getName() :string
    {
        return \strtolower(str_replace([__NAMESPACE__.'\\', 'Gateway'], '', \get_class($this)));
    }
}