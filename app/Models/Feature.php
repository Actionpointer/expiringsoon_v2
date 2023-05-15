<?php

namespace App\Models;

use App\Models\Adset;
use App\Models\State;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','adset_id','state_id','approved'
    ];
    //status means the state (not status) of the shop/product .e.g availability, approval, accessibility, etc
    protected $appends = ['running'];

    public function adset(){
        return $this->belongsTo(Adset::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function getRunningAttribute(){
        return $this->approved && $this->status && $this->adset->status && $this->adset->start_at < now() && $this->adset->end_at > now();
    }

    public function getStatusAttribute(){
        return $this->product && $this->product->certified();
    }

    public function getUrlAttribute(){
        return route('product.show',$this->product);
    }

    public function getImageAttribute(){
        return $this->photo ? config('app.url')."/storage/$this->photo":null;  
    }

    public function scopeWithinState($query,$state_id=null){
        if(!$state_id){
            $state_id = session('locale')['state_id'];;
        }
        return $query->where('state_id',$state_id);
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('state',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('state',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('state',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }
    
    public function scopeRunning($query){
        return $query->where('approved',true)->whereHas('adset', function (Builder $qry) 
            { $qry->where('status',true)->where('start_at','<',now())->where('end_at','>',now()); })
            ->whereHas('product',function($qpd){
                $qpd->isValid()->isApproved()->isActive()->isVisible()->isAccessible()->isAvailable();
            });
    }

}
