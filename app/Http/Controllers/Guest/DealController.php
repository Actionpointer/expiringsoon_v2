<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\ProductBundleVariant;
use App\Models\ProductGiveaway;

class DealController extends Controller
{
    public function preorder(){
        $preorder = ProductVariant::whereHas('product',function($query){
            $query->where('preorder',1);
        })->get();
        return response()->json($preorder,200);
    }

    public function bundles(){
        //get all bundles where status is 1 and variant quantity is more than 0
        $bundles = ProductBundleVariant::whereHas('variant',function($query){
            $query->where('status',1)->where('quantity','>',0);
        })->get();
        return response()->json($bundles,200);
    }

    public function giveaway(){
        //get all giveaways where status is 1 and variant quantity is more than 0
        //and start date is less than current date and end date is either null or greater than current date
        $giveaways = ProductGiveaway::where('status',1)->where(function($query){
            $query->where('start_date','<',now())->where(function($query){
                $query->where('end_date',null)->orWhere('end_date','>',now());
            });
        })->get();
        return response()->json($giveaways,200);
    }

    public function coupons(){
        //get all coupons where status is 1 and start date is less than current date and end date is either null or greater than current date
        $coupons = Coupon::where('status',1)->where(function($query){
            $query->where('start_date','<',now())->where(function($query){
                $query->where('end_date',null)->orWhere('end_date','>',now());
            });
        })->get();
        return response()->json($coupons,200);
    }

    public function flashsales(){
        //get all flashsales where status is 1 and start date is less than current date and end date is either null or greater than current date
        $flashsales = Flashsale::where('status',1)->where(function($query){
            $query->where('start_date','<',now())->where(function($query){
                $query->where('end_date',null)->orWhere('end_date','>',now());
            });
        })->get();
        return response()->json($flashsales,200);
    }


    

    

}
