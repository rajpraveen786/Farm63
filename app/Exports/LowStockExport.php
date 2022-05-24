<?php

namespace App\Exports;

use App\Model\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LowStockExport implements FromCollection, WithHeadings, WithMapping
{

    public function collection()
    {
        return Products::whereColumn('stock', '<=', 'minstock')->get();
    }
    public function map($data): array
    {
        $status = '';
        $type = '';
        if ($data->status == 0) {
            $status = 'Draft';
        } else if ($data->status == 1) {
            $status = 'Active';
        } else if ($data->status == 3) {
            $status = 'Draft';
        } else {
            $status = 'Reported';
        }
        return [
            $data->name ?? '',
            $data->minstock,
            $data->stock,
            $status ?? '',
            $data->fpricewtas ?? '',
        ];
    }
    public function headings(): array
    {
        return [
            'Product',
            'Minimum Stock',
            'Stock', 'Status',
            'Sale Rate'
        ];
    }
}
