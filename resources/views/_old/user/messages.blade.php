@extends('layouts.app')
@push('styles')
<style>
  .user-img{
    margin-right:5px;
    width:40px;
    height:40px;
    
  }
  /* *::-webkit-scrollbar {
    width: 12px;
  } */
 
</style>

@endpush
@section('title') Support | Expiring Soon @endsection
@section('main')
    <!-- breedcrumb section start  -->
  <div class="section breedcrumb">
    <div class="breedcrumb__img-wrapper">
      <img src="{{asset('images/banner/breedcrumb.jpg')}}" alt="breedcrumb" />
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
            <a href="{{route('home')}}"> {{auth()->user()->role}} <span> > </span> </a>
          </li>
          <li class="active"><a href="#">Support</a></li>
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
            

            <div class="conversation">
              <h5 class="font-body--xxxl d-flex justify-content-between">
                <span>Support</span> 
                @if( !in_array(auth()->user()->role,['shopper','vendor']) ) <a href="{{route('admin.messages')}}" class="btn btn-dark"> Back to Messages</a> @endif
              </h5>
              <div class="user-comments__list" style="overflow-y:scroll; height:50vh;">
                @foreach ($messages as $message)
                  <div class="d-flex py-4 border-bottom  @if((in_array(auth()->user()->role,['vendor','shopper']) && $message->receiver_id ) || (!in_array(auth()->user()->role,['vendor','shopper']) && blank($message->receiver_id) )) justify-content-end @endif ">
                    <div class="d-flex w-50">
                      <div class="user-img">
                          <img class="rounded-circle" alt="user-photo" @if($message->sender->pic) src="{{Storage::url($message->sender->pic)}}" @else src="{{asset('images/site/avatar.png')}}" @endif>
                      </div>

                      <div class="user-message-info">
                          <div class="d-flex ">
                            <h5 class="font-body--md-500">
                                
                                @if( in_array($message->sender->role,['shopper','vendor']) )
                                  {{$message->sender->name}}
                                @else 
                                  Admin 
                                @endif
                            </h5>
                            <ul class="inside"><li class="text-muted border-top border-white">{{$message->created_at->format('d M,Y h:i A')}}</li></ul>
                          </div>

                          <p class="font-body--sm-400">
                            {{$message->body}}
                          </p>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <form action="#" method="POST">@csrf
                <div class="d-flex py-4">
                  <textarea name="body" class="form-control" placeholder="Write Message"></textarea>
                      <input type="hidden" name="sender_id"  value="{{auth()->id()}}">
                    @if(isset($user))
                      <input type="hidden" name="receiver_id"  value="{{$user->id}}">
                    @endif
                  <button class="button button--outline rounded-0 my-0">Send</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('scripts')
<script>
    $('.amessage').on('click',function(){
       $('.messages').hide();
       $('.conversation').show();
    })
</script>
@endpush