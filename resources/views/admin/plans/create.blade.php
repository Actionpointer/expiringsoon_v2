@extends('layouts.app')

@push('styles')

@endpush

@section('title') Categories Settings | Expiring Soon @endsection

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
          <li class="active"><a href="#">Settings</a></li>
        </ul>
      </div>
    </div>
</div>
<!-- breedcrumb section end   -->
  
  @if(Session::has('result'))
      <div class="mb-0 @if(Session('result')) notify @else error @endif" >
          <p style="color:#fff">{{Session('message')}}</p>
      </div>
  @endif
  
  <!-- dashboard Secton Start  -->
  <div class="dashboard section">
    <div class="container">
      <div class="row dashboard__content">
        @include('admin.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- Add Category  -->
            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header">
                <h5 class="font-body--xl-500">Add Category / Sub Category</h5>
              </div>
              <div class="dashboard__content-card-body">
                <form method="post" id="editcategory">
                  <div class="contact-form__content">
                    <div class="contact-form-input">
                        <label for="address">Plan Name</label>
                        <input type="text" name="name" placeholder="" />
                    </div>
                    <div class="contact-form-input">
                        <label for="address">Plan Description</label>
                        <input type="text" name="description" placeholder="Short Description" />
                    </div>
                    <div class="contact-form-input">
                        <label for="address">Plan Features</label>
                        <textarea name="features" placeholder="Long description" />
                    </div>
                    <div class="contact-form-input">
                        <label>Plan Type</label>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="radio" name="type" id="typea" value="enterprise">
                            <label class="form-check-label font-body--400" for="existing"> Enterprise</label>
                        </div>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="radio" name="type" id="typeb" value="advert">
                            <label class="form-check-label font-body--400" for="existing"> Adverts</label>
                        </div>
                    </div>
                    <div class="contact-form-input" id="commission">
                        <label for="number1">Commission </label>
                        <div class="input-group d-flex">
                            <div class="prepend">
                                <label for="number1">Percentage</label>
                                <input type="number" name="commission_percentage" class="form-control"/>
                            </div>
                            <div>
                                <label for="number1">Fixed</label>
                            <input type="number" name="commission_fixed" class="form-control"  />
                            </div> 
                        </div>                        
                    </div>
                    <div class="contact-form-input" id="payout">
                        <label for="number1">Payouts </label>
                        <div class="input-group d-flex">
                            <div class="prepend">
                                <label for="number1">Minimum</label>
                                <input type="number" name="minimum_payout" class="form-control"/>
                            </div>
                            <div>
                                <label for="number1">Maximum</label>
                            <input type="number" name="maximum_payout" class="form-control"  />
                            </div> 
                        </div>                        
                    </div>
                    <div class="contact-form-input" id="resources">
                        <label for="number1">Plan Resources </label>
                        <div class="input-group d-flex">
                            <div class="prepend">
                                <label for="number1">No of Shops</label>
                                <input type="number" name="minimum_payout" class="form-control"/>
                            </div>
                            <div>
                                <label for="number1">No of Products</label>
                            <input type="number" name="maximum_payout" class="form-control"  />
                            </div> 
                        </div>                        
                    </div>
                    <div class="contact-form-input" id="resources">
                        <label for="number1">Plan Amount </label>
                        <div class="input-group d-flex">
                            <div class="prepend">
                                <label for="number1">1 month</label>
                                <input type="number" name="months_1" class="form-control"/>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary">1 Months</button>
                            </div> 
                        </div>   
                        <div class="input-group d-flex">
                            <div class="prepend">
                                <label for="number1">3 month</label>
                                <input type="number" name="months_3" class="form-control"/>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary">3 Months</button>
                            </div> 
                        </div>   
                        <div class="input-group d-flex">
                            <div class="prepend">
                                <label for="number1">6 month</label>
                                <input type="number" name="months_6" class="form-control"/>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary">6 Months</button>
                            </div> 
                        </div>   
                        <div class="input-group d-flex">
                            <div class="prepend">
                                <label for="number1">1 month</label>
                                <input type="number" name="months_12" class="form-control"/>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary">12 Months</button>
                            </div> 
                        </div>                        
                    </div>
                    <div class="contact-form-btn">
                        <button class="button button--md" type="submit">
                          + Add Plan
                        </button>
                    </div>
                </form>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
  
@endsection

@push('scripts')
<script>
  
</script>
@endpush
