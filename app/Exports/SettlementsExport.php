<?php

namespace App\Exports;

use App\Models\Settlement;
use Maatwebsite\Excel\Concerns\FromCollection;

class SettlementsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Settlement::where('status',true)->get();
    }
}
