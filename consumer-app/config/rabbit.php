<?php

return [
    'RABBITMQ_HOST' => env('RABBITMQ_HOST', 'rabbitmq'),
    'RABBITMQ_PORT' => env('RABBITMQ_PORT', 5672),
    'RABBITMQ_USER' => env('RABBITMQ_USER', 'user'),
    'RABBITMQ_PASSWORD' => env('RABBITMQ_PASSWORD', 'password'),
    'RABBITMQ_VHOST' => env('RABBITMQ_VHOST', '/'),
];
