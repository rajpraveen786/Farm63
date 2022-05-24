<?php

namespace App\Imports;

use App\Model\PinCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
HeadingRowFormatter::default('none');

class PincodeImport implements ToModel, WithHeadingRow,WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cat=PinCode::
        where('pincode',$row['Pincode'])
        ->first();
        if(!$cat){
            $cat=new PinCode();
            $cat->country=$row['Country'];
            $cat->state=$row['State'];
            $cat->city=$row['City'];
            $cat->pincode=$row['Pincode'];
            $cat->cost=$row['Cost'];
            $cat->deldays=$row['Days'];
            $cat->status=$row['Status']=="Active"?1:0;
            $cat->save();
        }
        return $cat;
    }
}
