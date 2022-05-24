<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Discounts;
use App\Model\Products;
class DiscountDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:discountDelete';

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
        $discounts=Discounts::where('status',1)->where('enddate','<',date('d/m/Y h:i a'))->get();
        // return $discounts;
        for($i=0;$i<$discounts->count();$i++){
            $prodid=[];
            $discountdata=Discounts::find($discounts[$i]->id);
            $prodid=Products::where('disid',$discountdata->id)->pluck('id');

            if(count($prodid)>0){
                for($j=0;$j<count($prodid);$j++){
                    $data=Products::find($prodid[$j]);

                    $finalprice=$data->actualprice;
                    $taxp=$data->taxp;

                    $price=round($finalprice*100/((100+$taxp)),2);
                    $taxa=round($price*$data->taxp/100,2);

                    $data->fpricebefdis=$price;
                    $data->fpricewtas=$finalprice;
                    $data->profit = $price - $data->cpi;
                    $data->margin = round(($data->profit / $price) * 1000) / 10;

                    $data->disid=0;
                    $data->da=0;
                    $data->disp=0;
                    $data->disa=0;
                    $data->taxa=$taxa;
                    $data->save();
                }
            }
            $discountdata->status=0;
            $discountdata->save();
        }


        return 0;
    }
}
