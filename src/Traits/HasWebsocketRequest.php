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
     * @return mixed|\WebSocket\Message\Message|null
     * @throws \WebSocket\BadOpcodeException
     */
    protected function send($endpoint, $data)
    {
        $client = $this->getClient($endpoint);
        $client->send(json_encode($data));

        return $this->receive($client);
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
        $result = '';
        while (true) {
            try {
                $result = $client->receive();
            } catch (\Exception $e) {
                throw $e;
            }
        }
        $client->close();
        return json_decode($result);
    }
}