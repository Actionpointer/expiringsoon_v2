@extends('layouts.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" />
{{-- <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/buttons/demo.css')}}"/> --}}
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>

@endpush
@section('title') Sync Products | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
      <div class="container">
        <ul class="breedcrumb__content">
            <li>
              <a href="{{route('index')}}">
                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z"   stroke="#808080"   stroke-width="1.5"   stroke-linecap="round"   stroke-linejoin="round" />
                </svg>
                <span> > </span>
              </a>
            </li>
            <li>
              <a href="{{route('home')}}">
                Account
                <span> > </span>
              </a>
            </li>
            <li>
                <a href="{{route('vendor.shop.show',$shop)}}">
                  {{$shop->name}}
                  <span> > </span>
                </a>
            </li>
            <li class="active"><a href="#">Sync Products</a></li>
          </ul>
      </div>
    </div>
  </div>
  <!-- breedcrumb section end   -->
  @include('layouts.session')
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.shop_navigation')
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
            <div class="dashboard__order-history">
                <div class="dashboard__order-history-title">
                    <h2 class="font-body--xl-500">Sync Products</h2>  
                </div>
                
                <div class="products-tab__btn">
                  <div class="container">
                      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-live-tab" data-bs-toggle="pill" data-bs-target="#pills-live" type="button" role="tab" aria-controls="pills-live" aria-selected="true">
                                Wordpress
                              </button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-approval-tab" data-bs-toggle="pill" data-bs-target="#pills-approval" type="button" role="tab" aria-controls="pills-approval" aria-selected="false">
                                Ebay
                            </button>
                          </li>
                          
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-inactive-tab" data-bs-toggle="pill" data-bs-target="#pills-inactive" type="button" role="tab" aria-controls="pills-inactive" aria-selected="false">
                                Amazon
                              </button>
                          </li>
                            
                      </ul>
                  </div>
                </div>

                <div class="products-tab__content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-live" role="tabpanel" aria-labelledby="pills-live-tab">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="mb-2">Wordpress</h6>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam rem at ut tenetur amet quas, dolores quo ullam qui sunt impedit vero commodi odit animi nemo sequi dolorem velit accusantium.
                                    </p>
                                </div>
                                
                                <div class="mb-3">
                                    <form action="{{route('vendor.shop.product.sync.wordpress',$shop)}}" method="post" enctype="multipart/form-data">@csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <h6 class="mb-2">API GET: </h6>
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias, cum eius facere assumenda eveniet omnis magnam consectetur nostrum iusto fugiat minima voluptatibus ex tenetur quisquam veritatis aliquam at accusamus quaerat!</p>
                                            </div>
                                            
                                            <div class="col-md-12 form-group mb-3">
                                                <label for="">Wordpress Shop Site URL</label>
                                                <input type="text" name="url" value="{{old('url')}}" id="wordpress_url" class="form-control" placeholder="e.g https://example.com">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Consumer Key</label>
                                                    <input type="text" name="key" value="{{old('key')}}"  id="wordpress_key" class="form-control">
                                                    <small>Your key will not be saved</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Consumer Secret</label>
                                                    <input type="text" name="secret" value="{{old('secret')}}"  id="wordpress_secret" class="form-control">
                                                    <small>Your secret will not be kept</small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-sm btn-primary mt-2">Sync</button>
                                            </div>
                                            
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="my-5">
                                    <h6 class="">Wordpress Export CSV: </h6>
                                    <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt, dolorum vel. Eos nihil voluptate accusantium obcaecati et atque officiis eligendi ab numquam officia vel amet deserunt, magni asperiores excepturi beatae.</small>
                                </div>
                            </div>
                        </div>
                        <!-- Countries -->
                        <div class="tab-pane fade" id="pills-approval" role="tabpanel" aria-labelledby="pills-approval-tab">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="mb-2">Ebay</h6>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam rem at ut tenetur amet quas, dolores quo ullam qui sunt impedit vero commodi odit animi nemo sequi dolorem velit accusantium.
                                    </p>
                                    

                                </div>
                            </div>
                        </div>
                        
                        <!-- Plan  -->
                        <div class="tab-pane fade" id="pills-inactive" role="tabpanel" aria-labelledby="pills-inactive-tab">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="mb-2">Amazon</h6>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam rem at ut tenetur amet quas, dolores quo ullam qui sunt impedit vero commodi odit animi nemo sequi dolorem velit accusantium.
                                    </p>
                                    

                                </div>
                            </div>
                        </div>
                        
                        
      
                    </div>
                </div>
            </div> 
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
    <script>
    
    </script>
@endpush