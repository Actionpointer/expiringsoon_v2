<?php

namespace App\Imports;

use App\Http\Traits\OptimizationTrait;
use Carbon\Carbon;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use \Cviebrock\EloquentSluggable\Services\SlugService;

// class ProductsImport implements ToModel, WithBatchInserts, WithChunkReading, ShouldQueue,SkipsEmptyRows, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
class ProductsImport implements ToModel,SkipsEmptyRows, WithHeadingRow, WithValidation
{
    // use SkipsFailures,SkipsErrors;
    use OptimizationTrait;
    
    public function __construct(public $shop)
    {
        $this->shop = $shop;
    }

    public function model(array $row)
    {
        $banner = null;
        
        if($row['photo']){
            $banner = $this->imageFromUrl($row['photo']);
        }
        return new Product([
            'shop_id'=> $this->shop,
            'name' => $row['name'],
            'slug' => SlugService::createSlug(Product::class, 'slug', $row['name']),
            'description' => $row['description'],
            'price'=> $row['price'],
            'stock'=> $row['stock'],
            'published'=> $row['published'],
            'expire_at'=> $row['expire_at'] ? Carbon::createFromFormat('d-m-Y',$row['expire_at']) : null,
            'tags'=> array_filter(explode(',',$row['tags'])),
            'photo'=> $banner,
            'length'=> $row['length'] ? explode(' ',$row['length'])[0] : null,
            'width'=> $row['width'] ? explode(' ',$row['width'])[0] : null,
            'height'=> $row['height'] ? explode(' ',$row['height'])[0] : null,
            'weight'=> $row['weight'] ? explode(' ',$row['weight'])[0] : null,
            'units' => [
                        $row['length'] && array_key_exists(1,explode(' ',$row['length'])) ? explode(' ',$row['length'])[1]:"",
                        $row['weight'] && array_key_exists(1,explode(' ',$row['weight'])) ? explode(' ',$row['weight'])[1]:""
                    ],
            'discount30'=> $row['discount30'],
            'discount60'=> $row['discount60'],
            'discount90'=> $row['discount90'],
            'discount120'=> $row['discount120'],
            
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'stock' => 'required|numeric|gt:1',
            'price' => 'required|numeric',
            'published' => 'required|numeric',   
        ];
    }
}
