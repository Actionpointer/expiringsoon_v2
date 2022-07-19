<?php

namespace App\Models;

use App\Models\Kyc;
use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Payout;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use Cviebrock\EloquentSluggable\Sluggable;

class Shop extends Model
{
    use Notifiable;
    // Sluggable;
    
    protected $fillable = ['name','slug','email','phone','banner','address','state_id','city_id'];
    protected $casts = ['categories'=> 'array'];

    // public static function boot()
    // {
    //     parent::boot();
    //     parent::observe(new \App\Observers\ShopObserver);
    // }

    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name',
    //             'separator' => '_'
    //         ]
    //     ];
    // }
    public function routeNotificationForNexmo($notification)
    {
        return $this->mobile;
    }
    public function getRouteKeyName(){
        return 'slug';
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('role','status');
    }
    public function kyc(){
        return $this->hasMany(Kyc::class);
    }
    public function staff(){
        return $this->hasMany(ShopUser::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function categories(){
        $categories = collect([]);
        foreach($this->categories as $category_id){
            $categories->push(Category::find($category_id));
        }
        return $categories;
    }

    public function discounts(){
        return $this->hasMany(Discount::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function payouts(){
        return $this->hasMany(Payout::class);
    }
    
}
