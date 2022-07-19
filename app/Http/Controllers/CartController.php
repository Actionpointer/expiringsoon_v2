<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\WishlistTrait;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use CartTrait,WishlistTrait;
    
    public function __construct(){
        $this->middleware('auth')->only(['checkout','orders','orderDetails']);
    }

    public function wishlist(){
        $user = auth()->user();
        return view('customer.wishlist',compact('user'));
    }

    public function cart(){
        $cart = request()->session()->get('cart');
        $order = $this->getOrder();
        return view('frontend.cart',compact('cart','order'));
    }

    public function addtocart(Request $request){
        // $request->session()->flush();
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $cart = $this->addToCartSession($product);
        if(auth()->check())
        $this->addToCartDb($product);
        return response()->json(['cart_count'=> count((array)$cart),'cart'=> $cart],200);
    }

    public function removefromcart(Request $request){
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $cart = $this->removeFromCartSession($product);
        if(auth()->check())
        $this->removeFromCartDb($product);
        return response()->json(['cart_count'=> count((array)$cart),'cart'=> $cart],200);
    }

    public function addtowish(Request $request){
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $wish = $this->addWishlist($product);
        return response()->json(['wish_count'=> $wish],200);
    }

    public function removefromwish(Request $request){
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $wish = $this->removeWishlist($product);
        return response()->json(['wish_count'=> $wish],200);
    }
    
    public function checkout(){
        // dd(request()->all());
        // $subtotal = 0;
        // $checkout = [];
        // dd($request->input('items'));
        if(request()->input('items')){
            foreach(request()->items as $items){
                $item = json_decode($items);
                $product = Product::find($item->id);
                $cart = $this->addToCartSession($product,$item->quantity,true);
                if(Auth::check())
                $this->addToCartDb($product,$item->quantity,true);
                // $checkout[] = array('product'=> $product,"quantity" => $item->quantity,'price'=> $product->amount);
                // $subtotal+= $product->amount * $item->quantity; 
            }
        }
        else{
            $cart = request()->session()->get('cart');
        }
        $subtotal = $this->getSubtotal($cart);
        $vat = ['value'=> $this->getVat() * $subtotal / 100,'percent'=> $this->getVat()];
        $states = State::where('status',true)->get();
        $cities = City::whereIn('state_id',$states->pluck('id')->toArray())->get();
        $currency = Cache::get(request()->ip())['currency_symbol'];
        return view('frontend.outside.sale.checkout',compact('cart','subtotal','vat','currency','states','cities'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
