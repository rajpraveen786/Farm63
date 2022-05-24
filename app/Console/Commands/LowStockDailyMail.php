<?php

namespace App\Console\Commands;

use App\Mail\LowStockDaily;
use Illuminate\Console\Command;
use Mail;

class LowStockDailyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:lowstockdaily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        Mail::to('rajpraveen786@gmail.com')->send(new LowStockDaily());
    }
}
