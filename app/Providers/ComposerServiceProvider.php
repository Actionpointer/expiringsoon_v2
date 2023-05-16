<?php

namespace App\Providers;

use App\Models\Advert;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.adverts.card_vertical', function ($view) {
            $ads = Advert::running()->whereHas('adset',function($query){$query->active()->where('adplan_id',3);})->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
            $view->with('ads',$ads);
        });
    }
}
