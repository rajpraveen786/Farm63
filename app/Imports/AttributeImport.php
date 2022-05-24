<?php

namespace App\Imports;

use App\Model\Attribute;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

HeadingRowFormatter::default('none');

class AttributeImport  implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cat=Attribute::where('name', $row['Name'])->first();
        if (!$cat) {
            $cat=new Attribute();
            $cat->name=$row['Name'];
            $cat->save();
        }
        return $cat;
    }
}
