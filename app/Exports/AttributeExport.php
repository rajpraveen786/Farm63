<?php

namespace App\Exports;

use App\Model\Attribute;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttributeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attribute::all();
    }
}
