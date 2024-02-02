<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BPOCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bpo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'BPO Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        \Log::info("Huraay! Cron is working");
        //
        $this->info('BPO:Cron Cummand Run successfully!');
    }
}
