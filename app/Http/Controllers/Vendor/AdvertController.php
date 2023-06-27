<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\Adset;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Advert;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdvertController extends Controller
{
    use GeoLocationTrait,PaymentTrait;

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Adset $adset){
        return view('vendor.adverts.index',compact('adset'));    
    }

    public function create(Adset $adset){
        if($adset->units > $adset->adverts->count()) {
            $user = auth()->user();
            $shops = $user->shops->where('status',true)->where('published',true)->where('approved',true);
            $states = State::within()->get();
            $state_id = session('locale')['state_id'];
            $products = Product::within()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->whereHas("shop",function($query) use($shops){ $query->where("user_id",auth()->id());})->get();
            return view('vendor.adverts.create',compact('adset','shops','states','state_id','products'));
        }
        
        else return back();

    }

    public function store(Request $request){
        $adset = Adset::find($request->adset_id);
        $width = $adset->adplan->width;
        $height = $adset->adplan->height;
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'shop_id' => [Rule::requiredIf(!$request->type == 'shop'),'numeric'],
            'product_id' => [Rule::requiredIf(!$request->type == 'product'),'numeric'],
            'photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048',"dimensions:width=$width,height=$height"],
            'state_id' => 'required|numeric',
            'heading' => 'required|string',
            'heading' => 'required|string',
            'subheading' => 'required|string',
            'offer' => 'required|string',
            'text_color' => 'required|string',
            'button_text' => 'required|string',
            'button_color' => 'required|string',
        ],[
            'photo.dimensions' => "The image dimensions must be $width by width and $height height",
            'photo.max' => 'The image is too heavy. Standard size is 2mb',
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
            redirect()->back()->with(['result'=> 0,'message'=> $validator->errors()->first() ]);
        }
        if($request->hasFile('photo')){
            $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $path = storage_path('app/public/'.$photo);
            $imgFile = Image::make($request->file('photo'));
            $imgFile->fit($width,$height)->save($path);
        } 
        if($adset->units > $adset->adverts->count()){
            $advert = Advert::create(['advertable_id'=> $request->type == 'shop' ? $request->shop_id: $request->product_id,
            'advertable_type'=> $request->type == 'shop' ? 'App\Models\Shop' : 'App\Models\Product',
            'adset_id'=> $adset->id, 'state_id'=> $request->state_id,
            'photo'=> $photo,'heading'=> $request->heading,'subheading'=> $request->subheading,
            'offer'=> $request->offer, 'text_color'=> $request->text_color, 'button_text'=> $request->button_text,
            'button_color'=> $request->button_color,'approved'=> cache('settings')['auto_approve_shop_advert'] ? true:false]);
        } 
        return redirect()->route('vendor.adverts',$adset)->with(['result'=> 1,'message'=>'Ad Created']);
        // return redirect()->back()->with(['result'=> 1,'message'=>'Ad Created']);
    }

    public function edit(Advert $advert){
        $user = auth()->user();
        $shops = $user->shops->where('status',true)->where('published',true)->where('approved',true);
        $states = State::within()->get();
        $products = Product::within()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->whereHas("shop",function($query) use($shops){ $query->where("user_id",auth()->id());})->get();
        return view('vendor.adverts.edit',compact('advert','shops','states','products'));
    }

    public function update(Request $request){
        $adset = Adset::find($request->adset_id);
        $width = $adset->adplan->width;
        $height = $adset->adplan->height;
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'shop_id' => [Rule::requiredIf(!$request->type == 'shop'),'numeric'],
            'product_id' => [Rule::requiredIf(!$request->type == 'product'),'numeric'],
            'photo' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048',"dimensions:width=$width,height=$height"],
            'advert_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'heading' => 'required|string',
            'heading' => 'required|string',
            'subheading' => 'required|string',
            'offer' => 'required|string',
            'text_color' => 'required|string',
            'button_text' => 'required|string',
            'button_color' => 'required|string',
        ],[
            'photo.dimensions' => "The image dimensions must be $width by width and $height height",
            'photo.max' => 'The image is too heavy. Standard size is 2mb',
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
            redirect()->back()->with(['result'=> 0,'message'=> $validator->errors()->first() ]);
        }
        $advert = Advert::find($request->advert_id);
        if($request->hasFile('photo')){
            if($advert->photo) Storage::delete('public/'.$advert->photo);
            $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $path = storage_path('app/public/'.$photo);
            $imgFile = Image::make($request->file('photo'));
            $imgFile->fit($width,$height)->save($path);
        }else{
            $photo = $advert->photo;
        }
        Advert::where('id',$request->advert_id)->update(['advertable_id'=> $request->type == 'shop' ? $request->shop_id: $request->product_id,
        'advertable_type'=> $request->type == 'shop' ? 'App\Models\Shop' : 'App\Models\Product',
        'adset_id'=> $adset->id, 'state_id'=> $request->state_id,
        'photo'=> $photo,'heading'=> $request->heading,'subheading'=> $request->subheading,
        'offer'=> $request->offer, 'text_color'=> $request->text_color, 'button_text'=> $request->button_text,
        'button_color'=> $request->button_color,'approved'=> cache('settings')['auto_approve_shop_advert'] ? true:false]);

        return redirect()->route('vendor.adverts',$advert->adset)->with(['result'=> 1,'message'=>'Ad Updated']);
    }

    public function remove(Request $request){
        $adverts = Advert::destroy($request->adverts);
        return redirect()->back()->with(['result'=> 1,'message'=>'Ad Deleted Successfully']);
    }


}