<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

public function index()
{
    $carts = Cart::with('product')->where('user_id', Auth::id())->get();
    $categories = Category::whereNull('parent_id')->get();
    return view('cart', compact('carts','categories'));
}

public function add($id)
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Please login first!');
    }

    
    $product = Product::findOrFail($id);

    $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

    if ($cart) {
        $cart->quantity += 1;
        $cart->save();
    } else {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'quantity' => 1
        ]);
    }

    $count = Cart::where('user_id', Auth::id())->sum('quantity');
    return redirect()->back()->with('success', 'Item added to cart');
    
}

public function remove($id)
{
    Cart::findOrFail($id)->delete();

    $count = Cart::where('user_id', Auth::id())->sum('quantity');

    return redirect()->back()->with('success', 'Item Removed from cart');
}


public function count()
{
    $count = Cart::where('user_id', auth()->id())->sum('quantity');

    return response()->json([
        'count' => $count
    ]);
}

public function increase($id)
{
    $cart = Cart::findOrFail($id);
    $cart->quantity += 1;
    $cart->save();

    return back();
}

public function decrease($id)
{
    $cart = Cart::findOrFail($id);

    if ($cart->quantity > 1) {
        $cart->quantity -= 1;
        $cart->save();
    }

    return back();
}

public function buyNow($id)
{
    $cart = Cart::findOrFail($id);
    return redirect()->route('checkout', ['id' => $cart->id]);
}

}