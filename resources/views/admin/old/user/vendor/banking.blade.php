@extends('layouts.app')

@push('styles')

@endpush
@section('title') Bank Settings | Expiring Soon @endsection
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
                <path d="M1 8L9 1L17 8V18H12V14C12 13.2044 11.6839 12.4413 11.1213 11.8787C10.5587 11.3161 9.79565 11 9 11C8.20435 11 7.44129 11.3161 6.87868 11.8787C6.31607 12.4413 6 13.2044 6 14V18H1V8Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"  />
              </svg>
              <span> > </span>
            </a>
          </li>
          <li>
            <a href="{{route('home')}}"> Account <span> > </span> </a>
          </li>
          <li class="active"><a href="#">Banking</a></li>
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
        @include('layouts.navigation')
        <div class="col-lg-9 section--xl pt-0">
          <div class="container">
            <div class="dashboard__content-card">
                
                @switch($user->country->payout_gateway)
                    @case('paypal')
                        <div class="dashboard__content-card-header">
                            <h5 class="font-body--xl-500">Paypal Payout</h5>
                        </div>
                        <div class="dashboard__content-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>We use paypal to pay earnings to you via your registered email address <span class="h6"><i>{{$user->email}}</i></span> . Once you request payout from any of your shop balances, we will
                                        process the payout and deposit funds to your paypal wallet. </p>
                                    <p class="my-3">If you have a paypal account, but the account is not with your registered email address on expirinsoon, you may <a href="https://www.paypal.com/us/cshelp/article/how-do-i-add-remove-or-update-an-email-address-on-my-paypal-account-help135" target="_blank">click here to learn how to add an another email to your paypal account.</a></p>
                                    
                                    </p> If you do not have a paypal account, you may <a href="https://www.paypal.com/us/webapps/mpp/account-selection" target="_blank">click here to register one. </a></p>
                                        
                                </div>
                            </div>
                        </div>
                    @break
                    @case('stripe') 
                        <div class="dashboard__content-card-header">
                            <h5 class="font-body--xl-500">Stripe Setup</h5>
                        </div>
                        <div class="dashboard__content-card-body">
                            
                        </div>
                    @break
                    @default
                        <div class="dashboard__content-card-header">
                            <h5 class="font-body--xl-500">Bank Account</h5>
                        </div>
                        <div class="dashboard__content-card-body">
                            
                            <div class="pb-3">
                                @if($user->bankaccount)
                                <div  style="font-size:15px;margin-bottom:20px">                       
                                    <div style="padding-bottom:10px;margin-top:10px">
                                        <table class="table w-auto">
                                            <tr>
                                                <th>Bank Name</th>
                                                <td>{{$user->bankaccount->bank->name}} </td>
                                            </tr>
                                            <tr>
                                                <th>Account Number</th>
                                                <td>{{$user->bankaccount->account_number}}</td>
                                            </tr>
                                            @if($user->branch_id)
                                            <tr>
                                                <th>Branch</th>
                                                <td>{{$user->bankaccount->branch->name}}</td>
                                            </tr>
                                            @endif
                                        </table>
                                        
                                        <a href="#" onclick="event.preventDefault();document.getElementById('bankedit').style.display='block'">Edit</a>
                                    </div>
                                </div>
                                @endif
                                <form method="post" id="bankedit" action="{{route('vendor.bank-info')}}" 
                                    @if($user->bankaccount) style="display: none" @endif>@csrf
                                    @if(!$user->bankaccount) <h4>Add New Bank Account</h4> @endif
                                    <div class="contact-form__content-group">
                                        <div class="contact-form-input">
                                            <label for="bank">Your Bank</label>
                                            <select id="bank" name="bank_id" class="select2">
                                                    @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}" data-code="{{$bank->code}}" >{{$bank->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        @if(session('locale')['country_iso'] == 'GH' && $branches->isNotEmpty())
                                            <div class="contact-form-input">
                                                <label for="branch">Branch *</label>
                                                <select id="branch" name="branch_id" class="form-control-lg w-100 contact-form-input__dropdown border text-muted">
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}" >{{$branch->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="contact-form-input">
                                            <label for="address">Account No. *</label>
                                            <input type="text" name="account_number" id="account_number" value=""   autocomplete="off"   maxlength="10"   required />
                                        </div>
                                        
                                    </div>
                                    <div class="contact-form-input col-md-6">
                                        <label for="address">Enter your access pin. *</label>
                                        <input type="text" name="pin" id="pin" value="" placeholder="Access pin" required />
                                    </div>
                                    <div class="contact-form-btn">
                                        <button class="button button--md" id="submit_bankaccount" type="button" > Save Details</button>
                                        @if($user->bankaccount)
                                        <button class="button button--md bg-danger" type="button" onclick="event.preventDefault();document.getElementById('bankedit').style.display='none'"> Cancel</button>
                                        @endif
                                    </div>
                                    <div class="modal fade" id="confirm" aria-labelledby="confirmLabel" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="reviewLabel">Confirmation</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <h6 class="">Are you sure that the details provided are correct</h6>
                                              <table class="table table-bordered my-3">
                                                    <tr>
                                                        <td>Bank : </td>
                                                        <td><span id="show_bank"></span> </td>
                                                    </tr>
                                                    <tr class="show_branch" style="display:none">
                                                        <td>Bank Branch : </td>
                                                        <td><span id="show_branch"></span> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Account Number : </td>
                                                        <td> <span id="show_account_number"></span> </td>
                                                    </tr>
                                                    <tr class="show_account_name">
                                                        <td>Account Name : </td>
                                                        <td> <span id="show_account_name"></span> </td>
                                                    </tr>
                                              </table>
                                              <div class="form-button">
                                                <button type="submit" id="correct" class="button button--md w-100">Correct</button>
                                              </div>
                                            </div>
                                            
                                          </div>
                                        </div>
                                      </div>
                                </form>
                                
                            </div>
                        </div>
                    @break
                @endswitch

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
  
 
  $('#submit_bankaccount').click(function(){
      var bank_name = $('#bank').find(':selected').text()
      var bank_id = $('#bank').val()
      var bank_code = $('#bank').find(':selected').attr('data-code')
      var branch = $('#branch').find(':selected').text()
      var account_number = $('#account_number').val()
      var account_name = getAccountName(bank_code,account_number)
      console.log(account_name);
      if(bank_id && account_number){
        $('#show_bank').text(bank_name)
        $('#show_account_number').text(account_number)
        $('#show_account_name').text(account_name)
        if(branch){
            $('.show_branch').show()
            $('#show_branch').text(branch)
        } 
        $('#confirm').modal('show');
      }else{
        document.forms['bankedit'].reportValidity();
      }
    
      
  })
    function getAccountName(bank_code,account_number){
      let name;
      $.ajax({
        type:'POST',
        async: false,
        dataType: 'json',
        url: "{{route('vendor.account_number_verification')}}",
        data:{
            '_token' : $('meta[name="csrf-token"]').attr('content'),
            'bank_code': bank_code,
            'account_number': account_number,
        },
        success:function(data) {
            if(data.data){
                name = data.data;
                $('#correct').attr('disabled',false)
            }
            
            else if(!data.status){
                name = data.message;
                $('#correct').attr('disabled',true)
            }
        },
        error: function (data, textStatus, errorThrown) {
            return false
        },
      })
      return name;
  }
</script>
@endpush
