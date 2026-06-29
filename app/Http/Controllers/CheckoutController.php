<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

public function index($id)
{
    $carts = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();
    $categories = Category::whereNull('parent_id')->get();
    $addresses = Address::where('user_id', Auth::id())->get();
    return view('checkout', compact('addresses', 'carts','categories'));
    
}

public function placeOrder(Request $request)
{
    $carts = Cart::with('product')->where('user_id', Auth::id())->get();

    if ($carts->isEmpty()) {
        return back()->with('error', 'Cart is empty');
    }

    if (!$request->filled('address_id') && !$request->filled('name')) {
        return back()->with('error', 'Please select or add an address');
    }

    $total = 0;

    foreach ($carts as $cart) {
        $total += $cart->product->price * $cart->quantity;
    }

   
    if ($request->filled('address_id')) {

        $address = Address::findOrFail($request->address_id);

    } else {

    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            
        ]);

        $address = Address::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode,
        ]);

        
        return back()
            ->with('success', 'Address added. Please select it.')
            ->with('last_address_id', $address->id);
    }

    
    $finalAddress = $address->name . ', ' .
                    $address->address1 . ', ' .
                    $address->city . ', ' .
                    $address->state . ' - ' .
                    $address->pincode;

   
    $order = Order::create([
        'user_id' => Auth::id(),
        'total_amount' => $total,
        'address' => $finalAddress
    ]);

   
    foreach ($carts as $cart) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cart->product_id,
            'quantity' => $cart->quantity,
            'price' => $cart->product->price
        ]);
    }

    Cart::where('user_id', Auth::id())->delete();
    return redirect('/')->with('success', 'Order Placed!');
}

}