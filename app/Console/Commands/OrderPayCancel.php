<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OrderPayCancel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:orderpaycancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This changes orders that are not paid in 10 minutes to order cancelled';

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
        $time=Date('Y-m-d H:i:s',strtotime('-10 minutes'));
        $data = Orders::whereIn('paystatus', [0,2])->whereIn('status',[0,1,2,3])->whereTime('created_at', '<', $time)->get();

        for($i=0;$i<$data->count();$i++){
            $datax=Orders::find($data[$i]->id);
            $datax->remarks='Payment cancelled due to non payment in 10 minutes';
            $datax->status=6;
            $datax->save();
            OrderManage::insert($datax->id,7);
        }
        return 0;
    }
}
