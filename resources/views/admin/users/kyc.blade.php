@extends('layouts.app')
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/> --}}

@endpush
@section('title') Admin KYC Verification | Expiring Soon @endsection
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
                <path   d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#">
              Admin
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="{{route('admin.dashboard')}}">KYC Verification</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
                <div class="dashboard__order-history">
                  <div class="dashboard__order-history-title">
                    <h2 class="font-body--xxl-500">KYC Documents</h2>
                   
                  </div>
                  <div class="dashboard__order-history-table">
                        <div class="m-4">
                            <div class="accordion mb-3" id="faq-accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Manage
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq-accordion">
                                <div class="accordion-body">
                                    <form action="{{route('admin.verifications')}}" method="get">
                                    <div class="row">
                                        @if(auth()->user()->role->name == 'superadmin')                                  
                                        <div class="col-md-3">
                                            <label>Select Country</label>
                                            <select name="country_id" id="country_id" class="select2">
                                                <option></option>
                                                <option value="0" @if($country_id == 0) selected @endif>All Countries - {{$documents->total()}}</option>
                                                @foreach ($countries->sortBy('category') as $country)
                                                    <option value="{{$country->id}}" @if($country_id == $country->id) selected @endif>{{$country->name}} - {{$country->kycs->count()}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                        
                                        <div class="col-md-3">
                                            <label>Select Type</label>
                                            <select name="type" id="type" class="form-control like_select2" style="height:50px">
                                                <option value="all" @if($status == 'all') selected @endif>All</option>
                                                <option value="App\Models\User" @if($type == 'App\Models\User') selected @endif>User</option>
                                                <option value="App\Models\Shop" @if($type == 'App\Models\Shop') selected @endif>Shop</option>  
                                                  
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Select Status</label>
                                            <select name="status" id="status" class="form-control like_select2" style="height:50px">
                                                <option value="approved" @if($status == 'approved') selected @endif>Approved</option>
                                                <option value="rejected" @if($status == 'rejected') selected @endif>Rejected</option>  
                                                <option value="pending" @if($status == 'pending') selected @endif>Pending</option>  
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="">Daterange</label>
                                            <div class="input-group d-flex">
                                                <div class="prepend">
                                                    <input type="date" min="{{$min_date}}" name="from_date" class="form-control-sm border text-secondary" style="height:50px;" />
                                                </div>
                                                <div>
                                                    <input type="date" max="{{$max_date}}" name="to_date" class="form-control-sm border text-secondary" style="height:50px;"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Sort</label>
                                            <select name="sortBy" id="sort-byd" class="form-control like_select2" style="height:50px">
                                                <option value="date_asc" @if($sortBy == 'date_asc') selected @endif>Sort by: Date Asc</option>
                                                <option value="date_desc" @if($sortBy == 'date_desc') selected @endif>Sort by: Date Desc</option>  
                                            </select>
                                        </div>
                                        <div class="row mt-3 justify-content-center">
                                            <div class="col-md-2">
                                                <button class="button button--md" name="download" value="0">Filter</button>
                                            </div>
                                            @can('download','App\Models\Payout')
                                                <div class="col-md-2">
                                                    <button class="button button--md" name="download" value="1">Download</button>
                                                </div>
                                            @endcan
                                        </div>
                                        
                                    </div> 
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col" class="dashboard__order-history-table-title"> Date</th>
                            <th scope="col" class="dashboard__order-history-table-title"> Type </th>
                            <th scope="col" class="dashboard__order-history-table-title"> Applicant</th>
                            <th scope="col" class="dashboard__order-history-table-title"> Status</th>
                            <th scope="col" class="dashboard__order-history-table-title"></th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @forelse ($documents as $document)
                                <tr>

                                  <td class="dashboard__order-history-table-item order-total " >
                                    {{$document->created_at->format('l, M jS, Y')}}
                                  </td>
                                  <!-- Status -->
                                  <td class="dashboard__order-history-table-item order-status">
                                      {{ucwords($document->type)}}
                                  </td>

                                    <td class="dashboard__order-history-table-item order-date">
                                      <div class="d-flex">
                                        @if($document->verifiable_type == 'App\Models\Shop')
                                          <img @if(!$document->verifiable->banner) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($document->verifiable->banner)}}" @endif alt="{{$document->verifiable->name}}" style="width:50px;height:50px;border-radius:50px;border:1px solid #ddd;padding:3px" />
                                        @else
                                          <img @if(!$document->verifiable->photo) src="{{asset('src/images/site/avatar.png')}}" @else src="{{Storage::url($document->verifiable->photo)}}" @endif alt="{{$document->verifiable->name}}" style="width:50px;height:50px;border-radius:50px;border:1px solid #ddd;padding:3px" />
                                        @endif
                                        <p class="order-total-price ps-2">
                        
                                            {{$document->verifiable->name}}
                                            <br />
                                            <span style="font-size:12px;color:#888">
                                                {{$document->verifiable->email}}
                                            </span>
                                        
                                        </p>
                                      </div>
                                      
                                    </td>
                                    <!-- Total  -->
                                    <td class="dashboard__order-history-table-item order-status">
                                        @if($document->reason)
                                            Rejected:  {{$document->reason}}
                                        @elseif($document->status)
                                            Approved
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <!-- Details page  -->
                                    <td class=" dashboard__order-history-table-item order-details ">
                                      @if($document->verifiable_type == 'App\Models\Shop')
                                        <a href="{{route('admin.shop.show',$document->verifiable)}}"> View Shop</a>
                                      @else
                                        <a href="{{route('admin.user.show',$document->verifiable)}}"> View User</a>
                                      @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                  <td colspan="5">
                                    <div style="margin:auto;padding:1%;text-align:center;margin-bottom:5%">
                                      <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}"><br />No pending KYC at this time.
                                    </div>
                                  </td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                    </div>
                    @include('layouts.pagination',['data'=> $documents])
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')

@endpush