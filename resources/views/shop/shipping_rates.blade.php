@extends('layouts.app')

@push('styles')

@endpush
@section('title') Shipping Rates | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="#">
              Shop
              <span> > </span>
            </a>
          </li>
          <li class="active"><a href="#">Shipping Rates</a></li>
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
        @include('shop.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <!-- Add Category  -->
            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header">
                <h5 class="font-body--xl-500">Add Destination</h5>
              </div>
              <div class="dashboard__content-card-body">
                <form method="post" id="editcategory">
                  <div class="contact-form__content">

                    <div class="contact-form__content-group">
                      <div class="contact-form-input">
                        <label for="states">State </label>
                        <select id="states" name="state_id" class="contact-form-input__dropdown">
                            @foreach ($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="contact-form-input">
                      <label for="hours">Hours</label>
                      <input type="number" name="hours" placeholder="hours" />
                    </div>
                    <div class="contact-form-input">
                        <label for="amounts">Amount</label>
                        <input type="number" name="amount" placeholder="delivery cost" />
                      </div>
                    
                    <div class="contact-form-btn">
                      <button class="button button--md" type="submit">
                        + Add Shipping Rate
                      </button>
                    </div>
                    
                  </div>
                </form>
              </div>
            </div>

            

            <!-- Manage Categories  -->
            <div class="dashboard__content-card">
              <div class="dashboard__content-card-header">
                <h5 class="font-body--xl-500">Manage Shipping Rates</h5>
              </div>
              <div class="dashboard__content-card-body">
                <div id="process3">
                  <table class="table display" style="width:100%;font-size:13px">
                    <thead>
                        <tr>
                          <th scope="col" class="">Origin</th>
                          <th scope="col" class="">Destination</th>
                          <th scope="col" class="">Hours</th>
                          <th scope="col" class="">Amount</th>
                          <th scope="col" class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rates as $rate)
                          <tr>
                            <td>{{$rate->origin->name}}</td>
                            <td>{{$rate->destination->name}}</td>
                            <td>{{$rate->hours}}</td>
                            <td>{{$rate->amount}}</td>
                            <td> <a href="javascript:void(0)" data-target="#editcategorymodal" data-toggle="modal">Edit</a> | Delete</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- dashboard Secton  End  -->
  <div class="modal fade" id="editcategorymodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
              <form method="post" id="editcategory">
                <div class="contact-form__content">

                  <div class="contact-form__content-group">
                    <div class="contact-form-input">
                      <label for="states">Parent <small class="text-muted">(optional: only use when adding subcategory)</small></label>
                      <select id="states" name="cat_id" class="contact-form-input__dropdown">
                          @foreach ($states as $state)
                              <option value="{{$state->id}}">{{$state->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="contact-form-input">
                    <label for="address">Category/Subcategory Name</label>
                    <input type="text" name="category" placeholder="" />
                  </div>
                  
                  <div class="contact-form-btn">
                    <button class="button button--md" type="submit">
                      + Add Category
                    </button>
                  </div>
                  <div id="process" style="font-size:13px;margin-top:10px"></div>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>
@endsection
@push('scripts')
<script>
 
</script>
@endpush
