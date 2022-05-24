<?php

namespace App\Imports;

use App\Model\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

HeadingRowFormatter::default('none');

class BrandImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    public function model(array $row)
    {

        $cat=Brand::where('name', $row['Name'])->first();
        if (!$cat) {
            $cat=new Brand();
            $cat->name=$row['Name'];
            $cat->desc=$row['Description'];
            $cat->seo_title=$row['SeoTitle'];
            $cat->seo_desc=$row['SeoDescription'];
            $cat->status=0;
            $cat->save();
        }
        return $cat;
    }
}
