@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/assets/css/jquery.dataTables.min.css')}}" /> 

<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatable/custom.css')}}"/>
@endpush
@section('title') Admin Plan Settings | Expiring Soon @endsection
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
            <a href="{{route('home')}}">
              Account
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Plan Settings</a></li>
        </ul>
      </div>
    </div>
</div>
  <!-- breedcrumb section end   -->
  
  @include('layouts.session')
<!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('layouts.admin_navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="products-tab__btn">
              <div class="container">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach ($currencies as $currency)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($loop->first) active @endif" id="pills-{{$currency->iso}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$currency->iso}}" type="button" role="tab" aria-controls="pills-{{$currency->iso}}" @if($loop->first) aria-selected="true" @else aria-selected="false" @endif >
                                {{$currency->name}}
                            </button>
                        </li>
                    @endforeach  
                      
                  </ul>
              </div>
            </div>
            <div class="products-tab__content">
              <div class="container">
                  <div class="tab-content" id="pills-tabContent">
                    @foreach ($currencies as $currency)
                      <div class="tab-pane fade @if($loop->first) show active @endif" id="pills-{{$currency->iso}}" role="tabpanel" aria-labelledby="pills-{{$currency->iso}}-tab">
                        <div class="products-tab__information">
                            <!-- Manage Plan  -->
                            <div class="dashboard__content-card">
                                <div class="dashboard__content-card-header">
                                    <h5 class="font-body--xl-500">Manage {{$currency->name}} Price</h5>
                                </div>
                                <div class="dashboard__content-card-body"> 
                                    <form action="{{route('admin.settings.plan.pricing')}}" method="post" id="global">@csrf
                                        <input type="hidden" name="currency_id" value="{{$currency->id}}">
                                        <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                        <div class="contact-form__content">
                                            <div class="contact-form-input row ">
                                                <div class="col-md-2">
                                                    <label for="number1" class="pt-3">Payout</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group d-flex">
                                                        <div class="prepend">
                                                            <i class="small text-sm text-muted">Minimum</i>
                                                            <input type="number" name="minimum_payout" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->minimum_payout ?? 0}}" class="form-control" />
                                                        </div>
                                                        <div>
                                                            <i class="small text-sm text-muted">Maximum</i>
                                                            <input type="number" name="maximum_payout" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->maximum_payout ?? 0}}" class="form-control"   />
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="contact-form-input row ">
                                                <div class="col-md-2">
                                                    <label for="number1" class="pt-3">Commission</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group d-flex">
                                                        <div class="prepend">
                                                            <i class="small text-sm text-muted">Percentage</i>
                                                            <input type="number" name="commission_percentage" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->commission_percentage ?? 0}}" class="form-control" />
                                                            
                                                        </div>
                                                        <div>
                                                            <i class="small text-sm text-muted">Fixed</i>
                                                            <input type="number" name="commission_fixed" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->commission_fixed ?? 0}}" class="form-control"   />
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="contact-form-input row ">
                                                <div class="col-md-2">
                                                    <label for="number1" class="pt-3">Shipment Charges</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group d-flex">
                                                        <div class="prepend">
                                                            <i class="small text-sm text-muted">Percentage</i>
                                                            <input type="number" name="shipment_percentage" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->shipment_percentage ?? 0}}" class="form-control" />
                                                            
                                                        </div>
                                                        <div>
                                                            <i class="small text-sm text-muted">Fixed</i>
                                                            <input type="number" name="shipment_fixed" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->shipment_fixed ?? 0}}" class="form-control"   />
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="contact-form-input row ">
                                                <div class="col-md-2">
                                                    <label for="number1" class="pt-3">Prices</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group d-flex">
                                                        <div class="prepend">
                                                            <i class="small text-sm text-muted">1 month</i>
                                                            <input type="number" name="months_1" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->months_1 ?? 0}}" class="form-control" />
                                                            
                                                        </div>
                                                        <div>
                                                            <i class="small text-sm text-muted">3 months</i>
                                                            <input type="number" name="months_3" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->months_3 ?? 0}}" class="form-control"    />
                                                        </div>
                                                    </div>
                                                    <div class="input-group d-flex">
                                                        <div class="prepend">
                                                            <i class="small text-sm text-muted">6 months</i>
                                                            <input type="number" name="months_6" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->months_6 ?? 0}}" class="form-control" />
                                                            
                                                        </div>
                                                        <div>
                                                            <i class="small text-sm text-muted">12 months</i>
                                                            <input type="number" name="months_12" value="{{$plan->prices->firstWhere('currency_id',$currency->id)->months_12 ?? 0}}" class="form-control"   />
                                                            
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="row my-4">
                                                <div class="col-md-2">
                                                    <label for="number1" class="pt-3">Access Pin</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="contact-form-input">
                                                        <input type="text" name="pin" id="pin_pricing{{$currency->id}}" value="" placeholder="Access pin">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="contact-form-btn">
                                                <button class="button button--md" type="submit"> Save </button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    
                                </div>
                            </div>
                                
                        </div>
                        
                      </div>
                    @endforeach
                      
                  </div>
              </div>
            </div>
            <!-- Set VAT -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
  
@endsection
@push('scripts')
<script src="{{asset('src/plugins/datatable/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('src/plugins/datatable/assets/buttons/demo.js')}}"></script>
<script>
    var modal_select = false;
    // var submittedform;
    $(document).ready(function() {
        $('.datatable').DataTable({
            "pagingType": "full_numbers",
            dom: 'lBfrtip',
            "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Search",
            }
        });
    });
    

    $('.modal').on('show.bs.modal', function () {
        $(this).find('.select2').select2({
            dropdownParent: $(this).find('.modal-content')
        });
        // $('.select2').select2();
        console.log($(this).html())
    });
</script>
@endpush
