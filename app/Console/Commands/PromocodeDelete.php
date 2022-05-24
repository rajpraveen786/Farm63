<?php

namespace App\Console\Commands;

use App\Model\Orders;
use App\Model\OrdersSub;
use App\Model\PromoCode;
use Illuminate\Console\Command;

class PromocodeDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:promocodeDelete';

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
        // ->where('enddate','<=',date('d/m/Y h:i a'))
        $promocode=PromoCode::where('status',1)->where('startdate','<=',date('d/m/Y h:i a'))->get();
        for($i=0;$i<$promocode->count();$i++){
            $data=PromoCode::find($promocode[$i]->id);
            $temp=1;
            if($data->noofuse>0){
                if(Orders::where('pid',$data->id)->count()>=$data->noofuse){
                    $temp=0;
                }
            }
            if($temp==1 && date('Y-m-d h:i:s',strtotime($promocode->enddate))<=date('Y-m-d H:i:s')){
                $temp=0;
            }

            $data->status=$temp;
            $data->save();
        }
        return 0;
    }
}
