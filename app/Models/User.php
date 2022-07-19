<?php

namespace App\Models;


use App\Models\Cart;
use App\Models\Like;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Product;
use App\Models\BankInfo;
use App\Models\Discount;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'fname','lname','email', 'password','phone','country_id','role','commission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function bankinfo(){
        return $this->hasOne(BankInfo::class);
    }
    
    public function payouts(){
        return $this->hasMany(Payout::class);
    }
    public function shops(){
        return $this->belongsToMany(Shop::class);
    }
    public function staff(){
        return $this->hasMany(ShopUser::class);
    }

}
