<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RabbitMQService;

class ConsumeQueues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:consume {queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume rabbitmq queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new RabbitMQService())->consume($this->argument('queue'));
    }
}
