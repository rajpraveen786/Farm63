<?php

namespace App\Imports;

use App\Model\Permissions;
use App\Model\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Hash;
HeadingRowFormatter::default('none');
class EmployeeImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user=User::where('email',$row['Email'])->first();
        if(!$user){
            $user=new User;
            $user->name=$row['Name'];
            $user->phno=$row['PhoneNumber'];
            $user->email=$row['Email'];
            $user->password=Hash::make($row['Password']);
            $user->type = 3;
            $user->email_verified_at=date('Y-m-d h:i:s');
            $user->save();

            $datax = new Permissions();
            $permission=[];
            $datax->uid =$user->id;
            $permission['category'] =$row['Category']??0;
            $permission['subcategory'] =$row['SubCategory']??0;
            $permission['brand'] =$row['Brand']??0;
            $permission['packing'] =$row['Packing']??0;
            $permission['uom'] =$row['UOM']??0;
            $permission['attribute'] =$row['Attribute']??0;
            $permission['tags'] =$row['Tags']??0;
            $permission['banner'] =$row['Banner']??0;
            $permission['cms'] =$row['CMS']??0;
            $permission['seo'] =$row['SEO']??0;
            $permission['pincode'] =$row['Pincode']??0;
            $permission['contactus'] =$row['ContactUs']??0;
            $permission['newsletter'] = $row['NewsLetter']?? 0;
            //Products
            $permission['productsadd'] =$row['ProductAdd']??0;
            $permission['productsedit'] =$row['ProductEdit']??0;
            $permission['productsview'] =$row['ProductView']??0;
            $permission['productsdel'] =$row['ProductDelete']??0;
            //Employee
            $permission['employeeadd'] =$row['EmployeeAdd']??0;
            $permission['employeeedit'] =$row['EmployeeEdit']??0;
            $permission['employeeview'] =$row['EmployeeView']??0;
            $permission['employeedel'] =$row['EmployeeDelete']??0;

            $permission['storeadd'] =$row['StoreAdd']??0;
            $permission['storeedit'] =$row['StoreEdit']??0;
            $permission['storeview'] =$row['StoreView']??0;
            $permission['storedel'] =$row['StoreDelete']??0;


            //Discounts
            $permission['discountsadd'] =$row['DiscountAdd']??0;
            $permission['discountsedit'] =$row['DiscountEdit']??0;
            $permission['discountsview'] =$row['DiscountView']??0;
            $permission['discountsdel'] =$row['DiscountDelete']??0;
            //Promocode
            $permission['promocodeadd'] =$row['PromocodeAdd']??0;
            $permission['promocodeedit'] =$row['PromocodeEdit']??0;
            $permission['promocodeview'] =$row['PromocodeView']??0;
            $permission['promocodedel'] =$row['PromocodeDelete']??0;
            //Customer
            $permission['customeradd'] =$row['CustomerAdd']??0;
            $permission['customeredit'] =$row['CustomerEdit']??0;
            $permission['customerview'] =$row['CustomerView']??0;
            $permission['customerdel'] =$row['CustomerDelete']??0;
            //Order
            $permission['orderedit'] = $row['OrderEdit']??0;
            $permission['orderview'] = $row['OrderView']??0;
            $permission['orderdel'] = $row['OrderDelete']??0;
            //review
            $permission['reviewedit'] = $row['ReviewEdit']??0;
            $permission['reviewdel'] = $row['ReviewDelete']??0;
            $datax->general=$permission;
            $datax->save();

        }
        return $user;
    }
}
