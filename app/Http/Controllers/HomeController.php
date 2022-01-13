<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $products = json_decode(file_get_contents(asset('product.json')), true);
        return view('index',compact('products'));
    }

    public function details($id)
    {
        $product = json_decode(file_get_contents(asset('product.json')), true);
        $product = array_filter($product);
        $product = (object)collect($product)->where('product_id',$id)->first();
        return view('details',compact('product'));
    }

    public function addTocart(Request $request)
    {
        if (Session::has('cart')) {
            $CartData = Session::get('cart')->where('id',$request->id)->first();
            if($CartData){
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', ' This Item already added in your card!');
                return redirect()->route('index');
            }
        }

        $product = json_decode(file_get_contents(asset('product.json')), true);
        $product = array_filter($product);
        $product = (object)collect($product)->where('product_id',$request->id)->first();

        $datas = array();
        $datas['id'] = $product->product_id;
        $datas['name'] = $product->title;
        $datas['image'] = $product->image_url;
        $datas['description'] = $product->description;
        $datas['price'] = $product->price;

        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart', collect([]));
            $cart->push($datas);
        }
        else{
            $cart = collect([$datas]);
            $request->session()->put('cart', $cart);
        }

        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'Item added to your cart!');
        return redirect()->route('index');

    }

    public function cart()
    {
        return view('cart');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function confurm_order(Request $request)
    {
        $order = New Order;
        $order->name = $request->name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->price = 0;
        $order->save();

        $total = 0;
        foreach (Session::get('cart') as $key => $cartItem){
            $total += $cartItem['price'];
            $order_detail = new OrderDetails;
            $order_detail->order_id = $order->id;
            $order_detail->product = json_encode($cartItem);
            $order_detail->price = $cartItem['price'];
            $order_detail->save();
        }

        $order->price = $total;
        $order->save();

        Session::flash('alert-class', 'alert-success');
        Session::flash('message', 'order successfully complete!');
        Session::forget('cart');
        return redirect()->route('your_orders');

    }

    public function your_orders()
    {
        $orders = Order::latest()->get();
        return view('your_orders',compact('orders'));
    }

}
