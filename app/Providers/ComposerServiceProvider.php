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
            $ads = Advert::running()->withinState()->whereHas('adset',function($query){$query->active()->where('adplan_id',3);})->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
            $view->with('ads',$ads);
        });

        View::composer('frontend.adverts.card_horizontal', function ($view) {
            $ads = Advert::running()->withinState()->whereHas('adset',function($query){$query->active()->where('adplan_id',4);})->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
            $view->with('ads',$ads);
        });

        View::composer('frontend.adverts.fullwidth_horizontal', function ($view) {
            $ads = Advert::running()->withinState()->whereHas('adset',function($query){$query->active()->where('adplan_id',2);})->orderBy('views','asc')->first();
            if($ads){
                $ads->views += 1;
                $ads->save();
            }
            $view->with('ads',$ads);
        });

        View::composer('frontend.adverts.mini_cards_3', function ($view) {
            $ads = Advert::running()->withinState()->whereHas('adset',function($query){$query->active()->where('adplan_id',5);})->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
            $view->with('ads',$ads);
        });

        View::composer('frontend.adverts.slider_with_mini', function ($view) {
            $sliders = Advert::running()->withinState()->whereHas('adset',function($query){$query->active()->where('adplan_id',1);})->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
            $minis = Advert::running()->withinState()->whereHas('adset',function($query){$query->active()->where('adplan_id',5);})->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
            $view->with(['sliders'=> $sliders,'minis'=> $minis]);
        });
    }
}
