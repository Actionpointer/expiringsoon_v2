@extends('layouts.app')
@push('styles')
<style>
  
</style>

@endpush
@section('title') Feature | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('src/images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
          <li>
            <a href="{{route('index')}}">
              <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" >
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"
                  stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#"> Vendor <span> > </span> </a>
          </li>
          <li class="active"><a href="{{route('home')}}">Dashboard</a></li>
        </ul>
      </div>
    </div>
  </div>
    <!-- breedcrumb section end   -->
    @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('vendor.navigation')
        <div class="col-lg-9 section--xl pt-0">
            <div class="container">
                <section class="section sales-banner--two">
                    <div class="">
                        <div class="row">
                            
                            @foreach ($adplans as $adplan)
                            <div class="col-lg-4 col-md-6">
                                <div class="cards-ss cards-ss--md cards-ss--md-one">
                                    <div class="cards-ss--md__img-wrapper bg-primary">
                                        {{-- <img src="{{asset('src/images/banner/banner-sm-09.png')}}" alt="banner-sale" /> --}}
                                        <div class="cards-ss--md__text-content">
                                            <h2 class="font-title--sm">{{$feature->name}}</h2>
                                            <p>This plan makes your life better. It is even the plan of the week</p>
                                            @if(auth()->user()->features->where('adplan_id',$feature->id)->first())
                                            <a href="{{route('vendor.adverts',$feature)}}" class="button button--md bg-success text-white">
                                                Click to Enter
                                                <span>
                                                    <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M16 7.50049H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M9.95001 1.47559L16 7.49959L9.95001 13.5246" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                            @else
                                            <a href="{{route('vendor.feature.description',$feature)}}" class="button button--md">
                                                Starts at {!!cache('settings')['currency_symbol']!!}{{number_format($feature->price_per_day)}}
                                                <span>
                                                    <svg width="17" height="15" viewBox="-1.14 0 30 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="_19_-_Lock" data-name="19 - Lock" >
                                                        <path id="Path_201" data-name="Path 201" d="M29.857,28V14a3,3,0,0,0-3-3H5.143a3,3,0,0,0-3,3V28a3,3,0,0,0,3,3H26.857A3,3,0,0,0,29.857,28Zm-2-14V28a1,1,0,0,1-1,1H5.143a1,1,0,0,1-1-1V14a1,1,0,0,1,1-1H26.857A1,1,0,0,1,27.857,14Z" transform="translate(-2.143 -1)" fill-rule="evenodd"/>
                                                        <path id="Path_202" data-name="Path 202" d="M16,17.428A3.571,3.571,0,1,0,19.571,21,3.573,3.573,0,0,0,16,17.428Zm0,2A1.571,1.571,0,1,1,14.429,21,1.573,1.573,0,0,1,16,19.428Z" transform="translate(-2.143 -1)" fill-rule="evenodd"/>
                                                        <path id="Path_203" data-name="Path 203" d="M6.949,13,7,13l.043-.005A1.023,1.023,0,0,0,8,11.988V11a8,8,0,0,1,8-8h0a8,8,0,0,1,8,8v1c0,.023,0,.047,0,.07V12.1l0,.024a.89.89,0,0,0,.229.52A1,1,0,0,0,25,13a1.047,1.047,0,0,0,1-1.012V11A10,10,0,0,0,16,1h0A10,10,0,0,0,6,11v1c0,.023,0,.047,0,.07V12.1l0,.024a.89.89,0,0,0,.229.52A1,1,0,0,0,6.949,13Z" transform="translate(-2.143 -1)" fill-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </section>
            
            </div>
            
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')

@endpush