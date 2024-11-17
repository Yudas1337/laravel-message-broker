<?php

namespace App\Services;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

use PhpAmqpLib\Channel\AbstractChannel;
use PhpAmqpLib\Channel\AMQPChannel;

class ProducerMessageService{

    private AMQPStreamConnection $connection;
    private AbstractChannel|AMQPChannel $channel;

    public function __construct(){

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
     * Send a message to a queue
     * @param string $queue
     * @param string $message
     */
    public function sendMessage(string $queue, string $message): void
    {
        $this->channel->queue_declare($queue, false, true, false, false);
        $this->channel->basic_publish(new AMQPMessage($message), '', $queue);
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
