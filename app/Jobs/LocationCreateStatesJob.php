<?php

namespace App\Jobs;

use App\Models\State;
use App\Models\Country;
use Illuminate\Bus\Queueable;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class LocationCreateStatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $country_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($country_id)
    {
        $this->country_id = $country_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $country = Country::find($this->country_id);
        $responses = Curl::to("https://api.countrystatecity.in/v1/countries/$country->iso/states")
        ->withHeader('X-CSCAPI-KEY: '.config('services.countrystatecity'))
        ->asJson()
        ->get();
        foreach($responses as $response){
            $state = State::updateOrCreate(['iso'=> $response->iso2,'country_id'=> $country->id],['name'=> $response->name]);
        }
    }
}
