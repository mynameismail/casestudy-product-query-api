<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    public function consume(string $queue): void
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_USER'),
            env('RABBITMQ_PASS'),
        );
        $channel = $connection->channel();

        $callback = function ($msg) use ($queue) {
            echo ' [x] Received ', $msg->body, "\n";

            $payload = json_decode($msg->body, true);

            switch ($queue) {
                case 'add_category':
                    (new CategoryService())->add($payload);
                    break;
                    
                case 'add_product':
                    (new ProductService())->add($payload);
                    break;
            }
        };

        $channel->queue_declare($queue, false, false, false, false);
        $channel->basic_consume($queue, '', false, true, false, false, $callback);

        echo "Waiting for messages \n";
        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
