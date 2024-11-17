<?php

namespace App\Console\Commands;

use App\Services\ConsumerMessageService;
use Illuminate\Console\Command;

class ConsumeMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume messages from a RabbitMQ';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $service =new ConsumerMessageService();
        $service->consumeMessages('hello-queue', function($message) {
            $this->info("Received message: {$message->getBody()}");
        });
    }
}
