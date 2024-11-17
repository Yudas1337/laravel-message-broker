<?php

namespace App\Services;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Channel\AbstractChannel;
use PhpAmqpLib\Channel\AMQPChannel;

class ConsumerMessageService{
    private AMQPStreamConnection $connection;
    private AbstractChannel|AMQPChannel $channel;

    public function __construct()
    {
        try {
            $this->connection = new AMQPStreamConnection(
                config('rabbit.RABBITMQ_HOST'),
                config('rabbit.RABBITMQ_PORT'),
                config('rabbit.RABBITMQ_USER'),
                config('rabbit.RABBITMQ_PASSWORD')
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (!empty($this->connection)) {
            $this->channel = $this->connection->channel();
        }
    }

    /**
     * Consume messages from a queue
     * @param string $queue
     * @param callable $callback
     */
    public function consumeMessages(string $queue, callable $callback) : void
    {
        $this->channel->queue_declare($queue, false, true, false, false);

        $this->channel->basic_consume($queue, '', false, true, false, false, $callback);

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

    public function __destruct()
    {
        try {
            $this->channel->close();
            $this->connection->close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
