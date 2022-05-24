<?php

namespace App\Console\Commands;

use App\Model\Category;
use Illuminate\Console\Command;
use App\Model\Discounts;
use App\Model\Products;
class DiscountAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:discountAdd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adding Discount to Product';

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
        $discounts=Discounts::where('status',0)->where('startdate','<=',date('d/m/Y h:i a'))->where('enddate','>',date('d/m/Y h:i a'))->get();

        for($i=0;$i<$discounts->count();$i++){
            $prodid=[];
            $discountdata=Discounts::find($discounts[$i]->id);

            if($discountdata->appliesfor==0){
                $prodid=Products::where('disid',0)->pluck('id');
            }
            else if($discountdata->appliesfor==1){
                $ids=explode(',',$discountdata->optid);
                $category=Category::whereIn('id',$ids)->pluck('id');
                $prodid=Products::whereIn('cid',$category)->where('disid',0)->pluck('id');
            }
            else if($discountdata->appliesfor==2){
                $ids=explode(',',$discountdata->optid);
                $prodid=Products::whereIn('id',$ids)->where('disid',0)->pluck('id');
            }

            if(count($prodid)>0){
                for($j=0;$j<count($prodid);$j++){
                    $data=Products::find($prodid[$j]);
                    $data->disid=$discountdata->id;
                    $data->actualprice=$data->fpricewtas;

                    $data->da=1;
                    $percent=0;
                    $value=0;

                    if($discountdata->type==0){
                        $value=($data->fprice*$discountdata->value)/100;
                        $percent=$discountdata->value;
                    }
                    else if($discountdata->type==1){
                        $value=($data->fprice*100)/$discountdata->value;
                        $percent=$discountdata->value;
                    }


                    $data->disp=$percent;
                    $data->disa=$value;

                    $difvalue=$data->fprice-$data->disa;
                    $profit=$data->fprice-$data->cpi;
                    if($difvalue==0){
                        $margin=0;
                    }
                    else{
                        $margin=round($profit/$difvalue,2);
                    }
                    $data->margin=$margin;
                    $data->profit=$profit;
                    $data->taxa=round(($difvalue*$data->taxp)/100,2);
                    $data->fpricebefdis=$data->taxa+$data->fprice;
                    $data->fpricewtas=$data->taxa+$data->fprice-$data->disa;
                    $data->save();
                }
            }
            $discountdata->status=1;
            $discountdata->save();
        }
        return 0;
    }
}
