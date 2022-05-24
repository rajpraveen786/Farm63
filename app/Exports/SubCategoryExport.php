<?php

namespace App\Exports;

use App\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubCategoryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SubCategory::all();
    }
}
