<?php

return [
    // 超时时间
    'timeout' => 5,
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Hipig\LaravelTts\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'xfyun',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'xfyun' => [
            'app_id' => '',
            'api_key' => '',
            'api_secret' => '',
        ],
        //...
    ],
];