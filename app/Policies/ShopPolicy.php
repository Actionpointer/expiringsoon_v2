<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
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

    

    
    public function view(User $user, Shop $shop)
    {
        if($shop->user_id == $user->id || $user->shop_id == $shop->id){
            return true;
        }
    }

    public function create(User $user)
    {
        if ($user->isRole('vendor')) {
            return true;
        }
    }

    public function update(User $user, Shop $shop)
    {
        if ($user->isRole('vendor') && $shop->user_id == $user->id) {
            return true;
        }
    }

    public function delete(User $user, Shop $shop)
    {
        if ($user->isRole('vendor')) {
            return true;
        }
    }

    public function restore(User $user, Shop $shop)
    {
        if ($user->isRole('superadmin')) {
            return true;
        }
    }

    public function forceDelete(User $user, Shop $shop){
        if ($user->isRole('superadmin')) {
            return true;
        }
    }
}
