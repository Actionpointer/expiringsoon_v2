<?php

namespace App\Exports;

use App\Models\Settlement;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SettlementsExport implements FromCollection
{

    public function __construct(Settlement $invoices)
    {
        $this->invoices = $invoices;
    }

    public function collection()
    {
        return $this->settlements->all();
    }
    // public $settlement;
    // public function __construct(array $settlement)
    // {
    //     $this->settlement = $settlement;
    // }

    // public function array(): array
    // {
    //     return $this->settlement;
    // }

    // public function headings(): array
    // {
    //     return [
    //         'medicine_a',
    //         'medicine_aName',
    //         'medicine_b',
    //         'medicine_bName',
    //         'remark',
    //         'mechanism'
    //     ];
    // }
}


