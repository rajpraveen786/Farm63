<?php

namespace App\Exports;

use App\Tags;
use Maatwebsite\Excel\Concerns\FromCollection;

class TagsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tags::all();
    }
}
