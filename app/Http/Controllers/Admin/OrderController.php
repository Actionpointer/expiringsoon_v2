<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use App\Models\User;
use App\Models\Order;
use App\Models\Country;
use App\Models\OrderStatus;
use App\Models\OrderDispute;
use App\Models\OrderMessage;
use Illuminate\Http\Request;
use App\Http\Traits\SecurityTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Notifications\OrderMessageNotification;

class OrderController extends Controller
{
    use SecurityTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $category = null;
        $status = 'all';
        $shipment = 'all';
        $sortBy = null;
        $countries = Country::has('orders')->get();
        $statuses = ['processing','cancelled','ready','shipped','delivered','rejected','completed','disputed','returned','closed'];       
        $orders = Order::whereHas('statuses')->within();
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $orders = $orders->within($country_id);
        }else{
            $country_id = 0;
        }

        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            $orders = $orders->statusFilter($status);
        }

        if(request()->query() && request()->query('shipment') && request()->query('shipment') != 'all'){
            $shipment = request()->query('shipment');
            $orders = $orders->where('deliverer',$shipment);
        }
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $orders = $orders->orderBy('created_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $orders = $orders->orderBy('created_at','desc');
            }
            if(request()->query('sortBy') == 'amount_asc'){
                $orders = $orders->orderBy('total','asc');
            }
            if(request()->query('sortBy') == 'amount_desc'){
                $orders = $orders->orderBy('total','desc');
            }
        }
        // dd($orders->get());
        $orders = $orders->paginate(16);
        return view('admin.orders.list',compact('orders','countries','country_id','status','shipment','sortBy','statuses'));
    }

    public function disputes(){
        $sortBy = null;
        $status = 'all';
        $countries = Country::has('orders')->get();
        $disputes = OrderStatus::withTrashed()->where('name','disputed');
        if(request()->query() && request()->query('status')){
            $status = request()->query('status');
            if($status == 'ongoing'){
                $disputes = $disputes->whereNull('deleted_at');
            }
            if($status == 'closed'){
                $disputes = $disputes->whereNotNull('deleted_at');
            }
            
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $disputes = $disputes->whereHas('order',function($query) use($country_id){ $query->within($country_id);});
        }else{
            $disputes = $disputes->whereHas('order',function($query){ $query->within();});
            $country_id = 0;
        }
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $disputes = $disputes->orderBy('created_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $disputes = $disputes->orderBy('created_at','desc');
            }
            
        }

        $disputes = $disputes->paginate(16);
        return view('admin.orders.disputes',compact('disputes','countries','country_id','status','sortBy'));
    }


    public function show(Order $order){
        $user = auth()->user();
        DB::table('notifications')->whereNull('read_at')->where('notifiable_id',auth()->id())->where('notifiable_type','App\Models\User')->whereJsonContains('data->related_to','order')->whereJsonContains('data->id',$order->id)->update(['read_at'=> now()]);
        return view('admin.orders.view',compact('order'));
    }

    
    public function update(Request $request){
        OrderStatus::create(['order_id'=> $request->order_id,'user_id'=> auth()->id(),'name'=> strtolower($request->status),'description'=> $request->description]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Updated Successfully',
        ], 200) :
         redirect()->back()->with(['result'=> 1,'message'=> 'Order Updated Successfully']);
    }

    public function resolution(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $order = Order::find($request->order_id);
        OrderDispute::create(['order_id'=> $request->order_id,'arbitrator_id'=> auth()->id(),'seller'=> $request->seller,'buyer'=> $request->buyer,'remark'=> $request->remark]);
        OrderStatus::create(['order_id'=> $order->id,'user_id'=> auth()->id(),'name'=> 'closed','description'=> $request->remark]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Order Dispute Successfully Resolved']);
    }
    
    public function message(Request $request){
        $order = Order::find($request->order_id);
        $receiver_id = $request->receiver == 'buyer'? $order->user_id : $order->shop_id;
        $receiver_type = $request->receiver == 'buyer'? 'App\Models\User' : 'App\Models\Store';
        if($request->hasFile('file')){
            $document = 'uploads/'.time().'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('public/',$document);
        }
        $message = OrderMessage::create(['order_id'=> $order->id,'sender_id'=> $request->sender_id,'sender_type'=>'App\Models\User','receiver_id'=> $receiver_id ,'receiver_type'=> $receiver_type, 'body'=> $request->body,'attachment'=> $document ?? '']);
        if($message->receiver_type == 'App\Models\User'){
            $receiver = User::find($message->receiver_id);
        }else{
            $receiver = Shop::find($message->receiver_id);
        }
        $receiver->notify(new OrderMessageNotification($message));
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Message Sent Successfully',
        ], 200) :
         redirect()->back()->with(['result'=> 1,'message'=> 'Message sent Successfully']);
    }
    
}
