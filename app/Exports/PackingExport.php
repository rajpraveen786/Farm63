<?php

namespace App\Exports;

use App\Packing;
use Maatwebsite\Excel\Concerns\FromCollection;

class PackingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Packing::all();
    }
}
