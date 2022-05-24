<?php

use App\Model\CMS as ModelCMS;
use Illuminate\Database\Seeder;

class CMS extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=new ModelCMS();
        $data->name='footer';//Terms And condition
        $data->desc="Footer";
        $data->save();
        $data=new ModelCMS();
        $data->name='tandc';//Terms And condition
        $data->desc="Terms And Condition";
        $data->save();
        $data=new ModelCMS();
        $data->name='shipping';
        $data->desc="Shipping Policy";
        $data->save();
        $data=new ModelCMS();
        $data->name='refund';
        $data->desc="Refund Policy";
        $data->save();
        $data=new ModelCMS();
        $data->name='privacy';
        $data->desc="Privacy policy";
        $data->save();
        $data=new ModelCMS();
        $data->name='aboutus';
        $data->desc="About Us";
        $data->save();
        $data=new ModelCMS();
        $data->name='faq';
        $data->desc="FAQ";
        $data->save();
        $data=new ModelCMS();
        $data->name='return';
        $data->desc="Return Policy";
        $data->save();
    }
}
