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

    protected $fillable = ['name','slug','description','products','shops'];
    protected $appends = ['minimum_payout','maximum_payout','commission_percentage','commission_fixed','shipment_percentage','shipment_fixed','months_1','months_3','months_6','months_12'];
    
    public function getRouteKeyName(){
        return 'slug';
    }
    public function getMinimumPayoutAttribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->minimum_payout ?? 0 ;
    }
    public function getMaximumPayoutAttribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->maximum_payout ?? 0 ;
    }    
    public function getCommissionPercentageAttribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->commission_percentage ?? 0 ;
    }
    public function getCommissionFixedAttribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->commission_fixed ?? 0 ;
    }
    public function getShipmentPercentageAttribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->shipment_percentage ?? 0 ;
    }
    public function getShipmentFixedAttribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->shipment_fixed ?? 0 ;
    }
    public function getMonths1Attribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->months_1 ?? 0 ;
    }
    public function getMonths3Attribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->months_3 ?? 0 ;
    }
    public function getMonths6Attribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->months_6 ?? 0 ;
    }
    public function getMonths12Attribute(){
        return $this->prices->firstWhere('currency_id',auth()->user()->country->currency_id)->months_12 ?? 0 ;
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
    // public function activeSubscriptions(){
    //     return $this->hasMany(Subscription::class)->where('end_at', '>', now())->where('status',true);
    // }
    public function prices(){
        return $this->hasMany(Price::class);
    }
    
}
