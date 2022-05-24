<?php

use App\Model\Settings as ModelSettings;
use Illuminate\Database\Seeder;

class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Name
        $data=new ModelSettings();
        $data->key='Name';
        $data->value='Name';
        $data->save();


        //AD1
        $data=new ModelSettings();
        $data->key='AD1';
        $data->value='AD1';
        $data->save();

        //AD2
        $data=new ModelSettings();
        $data->key='AD2';
        $data->value='AD2';
        $data->save();

        //AD3
        $data=new ModelSettings();
        $data->key='AD3';
        $data->value='AD3';
        $data->save();

        //City
        $data=new ModelSettings();
        $data->key='City';
        $data->value='City';
        $data->save();

        //State
        $data=new ModelSettings();
        $data->key='State';
        $data->value='State';
        $data->save();

        //Pincode
        $data=new ModelSettings();
        $data->key='Pincode';
        $data->value='Pincode';
        $data->save();

        //Country
        $data=new ModelSettings();
        $data->key='Country';
        $data->value='Country';
        $data->save();

        //PANNO
        $data=new ModelSettings();
        $data->key='PANNO';
        $data->value='PANNO';
        $data->save();

        //GSTNO
        $data=new ModelSettings();
        $data->key='GSTNO';
        $data->value='GSTNO';
        $data->save();
    }
}
