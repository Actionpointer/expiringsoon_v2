<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    
    public function before($user, $ability){
        if ($user->isRole('superadmin')) {
            return true;
        }
    }

    public function viewAny(User $user){
        if($user->isAnyRole(['superadmin','admin','manager','customercare'])) {
            return true;
        }
    }

    
    public function view(User $user, Product $product)
    {
        if($product->shop_id == $user->shop_id || in_array($product->shop_id,$user->shops->pluck('id')->toArray()) ){
            return true;
        }
    }

    public function create(User $user)
    {
        if($user->isAnyRole(['vendor','staff'])) {
            return true;
        }
    }

    public function update(User $user, Product $product)
    {
        if($product->shop_id == $user->shop_id || in_array($product->shop_id,$user->shops->pluck('id')->toArray()) ){
            return true;
        }
    }

    public function delete(User $user, Product $product)
    {
        if($user->isRole('vendor') && in_array($product->shop_id,$user->shops->pluck('id')->toArray()) ){
            return true;
        }
    }

    public function restore(User $user, Product $product)
    {
        if ($user->isRole('superadmin')) {
            return true;
        }
    }

    public function forceDelete(User $user, Product $product){
        if ($user->isRole('superadmin')) {
            return true;
        }
    }
}
