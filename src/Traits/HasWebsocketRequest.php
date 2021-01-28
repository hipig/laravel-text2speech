<?php

namespace Hipig\LaravelTts\Traits;

use WebSocket\Client;

trait HasWebsocketRequest
{
    /**
     * Send websocket request and receive message.
     *
     * @param $endpoint
     * @param $data
     * @return Client
     * @throws \WebSocket\BadOpcodeException
     */
    protected function send($endpoint, $data)
    {
        $client = $this->getClient($endpoint);
        $client->send(json_encode($data));

        return $client;
    }

    /**
     * Get new websocket client.
     *
     * @param $endpoint
     * @return Client
     */
    protected function getClient($endpoint)
    {
        return new Client($endpoint, $this->getBaseOptions());
    }

    /**
     * Get client options.
     *
     * @return array
     */
    protected function getBaseOptions()
    {
        $options = method_exists($this, 'getWebsocketOptions') ? $this->getWebsocketOptions() : [];

        return \array_merge($options, [
            'headers' => method_exists($this, 'getHeader') ? $this->getHeader() : [],
            'timeout' => method_exists($this, 'getTimeout') ? $this->getTimeout() : 5,
        ]);
    }

    /**
     * Receive websocket message.
     *
     * @param Client $client
     * @return mixed|string|\WebSocket\Message\Message|null
     * @throws \Exception
     */
    protected function receive(Client $client)
    {
        while (true) {
            try {
                $result = $client->receive();
                return json_decode($result);
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }
}