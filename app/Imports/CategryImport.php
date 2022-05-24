<?php

namespace App\Imports;

use App\Model\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
HeadingRowFormatter::default('none');
class CategryImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cat=Category::where('name', $row['Name'])->first();
        if (!$cat) {
            $cat=new Category();
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
