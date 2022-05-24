<?php

namespace App\Imports;

use App\Model\Category;
use App\Model\SubCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
HeadingRowFormatter::default('none');
class SubCategryImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cat=null;
        $category=Category::where('name',$row['Category'])->first();
        if($category){
            $cat=SubCategory::where('cid',$category->id)->where('name', $row['Name'])->first();
            if (!$cat) {
                $cat=new SubCategory();
                $cat->cid=$category->id;
                $cat->name=$row['Name'];
                $cat->desc=$row['Description'];
                $cat->seo_title=$row['SeoTitle'];
                $cat->seo_desc=$row['SeoDescription'];
                $cat->status=0;
                $cat->save();
            }
        }
        return $cat;
    }
}
