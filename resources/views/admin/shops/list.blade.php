@extends('layouts.app')
@push('styles')

@endpush
@section('title') Manage Shops | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                />
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
          <li class="active"><a href="{{route('admin.products')}}">Products</a></li>
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
        <div class="col-lg-9 section--xl pt-0" style="padding:10px;font-size:13px">
            <div class="dashboard__order-history-title" style="margin:auto;width:95%;border-bottom:1px solid #ddd;margin-bottom:10px">
              <p class="font-body--xl-500">Manage Shops</p>
              <a href="#" class="font-body--lg-500">{{number_format($shops->count(), 0)}} Shops</a>
            </div>
            <div class="container">
              <!-- Products -->
              <div class="table-responsive">
                <table id="datatable" class="table display" style="width:100%;font-size:13px">
                    <thead>
                        <tr>
                        <th scope="col" class="cart-table-title">Shop</th>
                        <th scope="col" class="cart-table-title">Products</th>
                        <th scope="col" class="cart-table-title">Revenue</th>
                        <th scope="col" class="cart-table-title">Balance</th>
                        <th scope="col" class="cart-table-title">Status</th>
                        </tr>
                    </thead>
                    <tbody style="width:100%;font-size:13px">
                        @forelse ($shops as $shop)
                            <tr class="likeditem" style="border-bottom:1px solid #f1f1f1">
                                <!-- Product item  -->
                                <td class="px-4 order-date align-middle">
                                    <a href="{{route('admin.shop.show',$shop)}}" class="cart-table__product-item text-dark" >
                                         <h5>
                                          {{ $shop->name}}
                                          @if($shop->verified())
                                          <svg width="16" height="16" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.5213 2.62368C11.3147 1.75255 12.6853 1.75255 13.4787 2.62368L14.4989 3.74391C14.8998 4.18418 15.4761 4.42288 16.071 4.39508L17.5845 4.32435C18.7614 4.26934 19.7307 5.23857 19.6757 6.41554L19.6049 7.92905C19.5771 8.52388 19.8158 9.10016 20.2561 9.50111L21.3763 10.5213C22.2475 11.3147 22.2475 12.6853 21.3763 13.4787L20.2561 14.4989C19.8158 14.8998 19.5771 15.4761 19.6049 16.071L19.6757 17.5845C19.7307 18.7614 18.7614 19.7307 17.5845 19.6757L16.071 19.6049C15.4761 19.5771 14.8998 19.8158 14.4989 20.2561L13.4787 21.3763C12.6853 22.2475 11.3147 22.2475 10.5213 21.3763L9.50111 20.2561C9.10016 19.8158 8.52388 19.5771 7.92905 19.6049L6.41553 19.6757C5.23857 19.7307 4.26934 18.7614 4.32435 17.5845L4.39508 16.071C4.42288 15.4761 4.18418 14.8998 3.74391 14.4989L2.62368 13.4787C1.75255 12.6853 1.75255 11.3147 2.62368 10.5213L3.74391 9.50111C4.18418 9.10016 4.42288 8.52388 4.39508 7.92905L4.32435 6.41553C4.26934 5.23857 5.23857 4.26934 6.41554 4.32435L7.92905 4.39508C8.52388 4.42288 9.10016 4.18418 9.50111 3.74391L10.5213 2.62368Z" stroke="#00b207" stroke-width="1.5"/> <path d="M9 12L11 14L15 10" stroke="#00b207" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                                          @endif
                                        </h4>
                                    </a>
                                    <small>{{($shop->city ? $shop->city->name : '').' '.$shop->state->name}}</small>
                                </td>
                                <!-- Price  -->
                                <td class="cart-table-item order-date align-middle">
                                    {{$shop->user->name}}
                                </td>
                                <td class="cart-table-item order-date align-middle">
                                  <p class="">{!!$shop->country->currency->symbol!!}{{ number_format($shop->orders->sum('subtotal'), 2)}}</p>
                                </td>
                                <td class="cart-table-item add-cart align-middle">
                                  <p class="">{!!$shop->country->currency->symbol!!}{{ number_format($shop->wallet, 2)}}</p>
                                 
                                </td>
                                <!-- Stock Status  -->
                                <td class="cart-table-item stock-status order-date align-middle">
                                  
                                  <span class="font-body--md-400  @if($shop->approved) in @else out @endif"> {{ $shop->approved ? 'Approved':'Pending Approval'}}</span>        
                                </td>
                                
                            </tr>
                        @empty
                            <div style="margin:auto;padding:1%;text-align:center">
                                <img style="padding:10px;width:100px" src="{{asset('src/images/site/exclamation.png')}}">
                                <br />There are no shops at this time.</span>
                            </div>
                        @endforelse
                        
                    </tbody>
                </table>
              </div>
              @include('layouts.pagination',['data'=> $shops])
            </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')

@endpush