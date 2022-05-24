<?php

namespace App\Imports;

use App\Model\Packing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

HeadingRowFormatter::default('none');

class PackingImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cat=Packing::where('name', $row['Name'])->first();
        if (!$cat) {
            $cat=new Packing();
            $cat->name=$row['Name'];
            $cat->save();
        }
        return $cat;
    }
}
