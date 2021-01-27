<?php

namespace Hipig\LaravelTts\Gateways;

use Hipig\LaravelTts\Contracts\SpeechInterface;
use Hipig\LaravelTts\Exceptions\GatewayErrorException;
use Hipig\LaravelTts\Traits\HasWebsocketRequest;

class XfyunGateway extends Gateway
{
    use HasWebsocketRequest;

    const HOST = 'tts-api.xfyun.cn';

    const REQUEST_LINE = 'GET /v2/tts HTTP/1.1';

    const SUCCESS_FLAG = 2;

    /**
     * Text to speech.
     *
     * @param string $text
     * @param SpeechInterface $speech
     * @param array $config
     * @return mixed|\WebSocket\Message\Message|null
     * @throws GatewayErrorException
     * @throws \WebSocket\BadOpcodeException
     */
    public function to(string $text, SpeechInterface $speech, array $config)
    {
        $date = gmstrftime("%a, %d %b %Y %T %Z", time());

        $sign = $this->generateSignature($date, $config['api_secret']);

        $endpointUrl = sprintf("wss://%s/v2/tts?", self::HOST) . http_build_query([
            'host' => self::HOST,
            'date' => $date,
            'authorization' => $this->generateAuthorization($sign, $config['api_key']),
        ]);

        $common = [
            'app_id' => $config['app_id']
        ];

        $business = [
            'speed' => intval($speech->getSpd()) ?? 50,
            'volume' => intval($speech->getVol()) ?? 50,
            'pitch' => intval($speech->getPit()) ?? 50,
            'vcn' => $speech->getPer(), //发音人
            'aue' => $speech->getAue() ?? 'lame',
            'tte' => "UTF8"
        ];
        if ($business['aue'] === 'lame') {
            $business['sfl'] = 1;
        }

        $data = [
            'text' => base64_encode($text),
            'status' => 2
        ];

        $result = $this->send($endpointUrl, compact('common', 'business', 'data'));

        if ($result->data->status !== self::SUCCESS_FLAG) {
            throw new GatewayErrorException($result->message, $result->code, $result);
        }

        return $result;
    }

    /**
     * Generate signature.
     *
     * @param $date
     * @param $apiSecret
     * @return string
     */
    protected function generateSignature($date, $apiSecret)
    {
        $signatureOrigin = sprintf("host: %s\ndate: %s\n%s", self::HOST, $date, self::REQUEST_LINE);
        $signatureSha = hash_hmac('sha256', $signatureOrigin, $apiSecret, true);

        return base64_encode($signatureSha);
    }

    /**
     * Generate authorization.
     *
     * @param $signature
     * @param $apiKey
     * @return string
     */
    protected function generateAuthorization($signature, $apiKey)
    {
        return base64_encode("api_key=\"$apiKey\",algorithm=\"hmac-sha256\",headers=\"host date request-line\",signature=\"$signature\"");
    }
}