<?php

namespace App\Console\Commands;

use App\Model\RetCanOrder;
use Illuminate\Console\Command;
use Razorpay\Api\Api;

class RefundStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:refundStatus';

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
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $dxs=RetCanOrder::where('status',0)->pluck('id');
        for($i=0;$i<count($dxs);$i++){
            $dx=RetCanOrder::orderBy('id','desc')-> first();
            $refund = $api->payment->fetch($dx->payrazorpaymentid)->fetchRefund($dx->refundrazorpaymentid);

            $status=0;
            if($refund->status=='pending'){
                $status=0;
            }
            else if($refund->status=='processed'){
                $status=1;
            }
            else if($refund->status=='failed'){
                $status=2;
            }
            $dx->status=$status;
            $dx->save();

        }
        return 0;
    }
}
