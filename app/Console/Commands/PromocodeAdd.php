<?php

namespace App\Console\Commands;

use App\Model\PromoCode;
use Illuminate\Console\Command;

class PromocodeAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:promocodeAdd';

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

        $promocode=PromoCode::where('status',0)->where('startdate','<=',date('d/m/Y h:i a'))->where('enddate','>',date('d/m/Y h:i a'))->get();;
        for($i=0;$i<$promocode->count();$i++){
            $data=PromoCode::find($promocode[$i]->id);
            $data->status=1;
            $data->save();
        }
        return 0;
    }
}
