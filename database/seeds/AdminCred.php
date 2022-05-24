<?php

use App\Model\Permissions;
use Illuminate\Database\Seeder;
use App\User;
class AdminCred extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=new User;
        $data->name='Admin';
        $data->email='admin@admin.com';
        $data->email_verified_at=date('Y-m-d h:i:s');
        $data->phno='8825867355';
        $data->type=2;
        $data->password=Hash::make('7890poiu');
        $data->save();

        $dataz=new Permissions();
        $permission=[];
        $dataz->uid=$data->id;
        $permission['category']=1;
        $permission['subcategory']=1;
        $permission['brand']=1;
        $permission['packing']=1;
        $permission['uom']=1;
        $permission['attribute']=1;
        $permission['tags']=1;
        $permission['banner']=1;
        $permission['cms']=1;
        $permission['seo']=1;
        $permission['pincode']=1;
        $permission['contactus']=1;
        $permission['newsletter']=1;


        $permission['productsadd']=1;
        $permission['productsedit']=1;
        $permission['productsview']=1;
        $permission['productsdel']=1;

        $permission['employeeadd']=1;
        $permission['employeeedit']=1;
        $permission['employeeview']=1;
        $permission['employeedel']=1;


        $permission['storeadd']=1;
        $permission['storeedit']=1;
        $permission['storeview']=1;
        $permission['storedel']=1;

        $permission['customeradd']=1;
        $permission['customeredit']=1;
        $permission['customerview']=1;
        $permission['customerdel']=1;

        $permission['orderedit']=1;
        $permission['orderview']=1;
        $permission['orderdel']=1;

        $permission['promocodeadd']=1;
        $permission['promocodeedit']=1;
        $permission['promocodeview']=1;
        $permission['promocodedel']=1;

        $permission['discountsadd']=1;
        $permission['discountsedit']=1;
        $permission['discountsview']=1;
        $permission['discountsdel']=1;


        $permission['reviewedit']=1;
        $permission['reviewdel']=1;

        $dataz->general=$permission;
        $dataz->save();



        $data=new User;
        $data->name='Shop Owner';
        $data->email='so@admin.com';
        $data->email_verified_at=date('Y-m-d h:i:s');
        $data->phno='8825867351';
        $data->type=1;
        $data->password=Hash::make('7890poiu');
        $data->save();

        $dataz=new Permissions();
        $permission=[];
        $dataz->uid=$data->id;
        $permission['category']=1;
        $permission['subcategory']=1;
        $permission['brand']=1;
        $permission['packing']=1;
        $permission['uom']=1;
        $permission['attribute']=1;
        $permission['tags']=1;
        $permission['banner']=1;
        $permission['cms']=1;
        $permission['seo']=1;
        $permission['pincode']=1;
        $permission['contactus']=1;
        $permission['newsletter']=1;


        $permission['productsadd']=1;
        $permission['productsedit']=1;
        $permission['productsview']=1;
        $permission['productsdel']=1;

        $permission['employeeadd']=1;
        $permission['employeeedit']=1;
        $permission['employeeview']=1;
        $permission['employeedel']=1;

        $permission['customeradd']=1;
        $permission['customeredit']=1;
        $permission['customerview']=1;
        $permission['customerdel']=1;

        $permission['orderedit']=1;
        $permission['orderview']=1;
        $permission['orderdel']=1;

        $permission['promocodeadd']=1;
        $permission['promocodeedit']=1;
        $permission['promocodeview']=1;
        $permission['promocodedel']=1;

        $permission['storeadd']=1;
        $permission['storeedit']=1;
        $permission['storeview']=1;
        $permission['storedel']=1;

        $permission['discountsadd']=1;
        $permission['discountsedit']=1;
        $permission['discountsview']=1;
        $permission['discountsdel']=1;


        $permission['reviewedit']=1;
        $permission['reviewdel']=1;

        $dataz->general=$permission;
        $dataz->save();

    }
}
