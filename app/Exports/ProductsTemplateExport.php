<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsTemplateExport implements FromView
{
    public $data;
    public function __construct($data){
        $this->data = $data;
    }
    public function view(): View
    {
        return view('exports.products.template', [
            'shop' => $this->data
        ]);
    }
}
