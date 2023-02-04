<?php

namespace App\Models;

use App\Models\Price;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory,Sluggable,SoftDeletes;
    
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }

    protected $fillable = ['name','description','products','shops','months_1','months_3','months_6','months_12'];
    protected $appends = ['minimum_payout','maximum_payout','commission_percentage','commission_fixed','months_1','months_3','months_6','months_12'];
    
    public function getRouteKeyName(){
        return 'slug';
    }
    public function getMinimumPayoutAttribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','minimum_payout')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','minimum_payout')->amount : 0 ;
    }
    public function getMaximumPayoutAttribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','maximum_payout')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','maximum_payout')->amount : 0 ;
    }
    public function getCommissionPercentageAttribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','commission_percentage')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','commission_percentage')->amount : 0 ;
    }
    public function getCommissionFixedAttribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','commission_fixed')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','commission_fixed')->amount : 0 ;
    }
    public function getMonths1Attribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','months_1')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','months_1')->amount : 0 ;
    }
    public function getMonths3Attribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','months_3')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','months_3')->amount : 0 ;
    }
    public function getMonths6Attribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','months_6')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','months_6')->amount : 0 ;
    }
    public function getMonths12Attribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','months_12')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','months_12')->amount : 0 ;
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
    public function activeSubscriptions(){
        return $this->hasMany(Subscription::class)->where('end_at', '>', now())->where('status',true);
    }
    public function prices(){
        return $this->morphMany(Price::class,'priceable');
    }
    
}
