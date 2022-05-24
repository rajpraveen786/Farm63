<?php

namespace App\Imports;

use App\Model\UOM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

HeadingRowFormatter::default('none');

class UOMImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cat=UOM::where('name', $row['Name'])->first();
        if (!$cat) {
            $cat=new UOM();
            $cat->name=$row['Name'];
            $cat->save();
        }
        return $cat;
    }
}
