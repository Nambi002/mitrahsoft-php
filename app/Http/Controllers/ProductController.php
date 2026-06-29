<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{

public function index()
{
    $products = Product::with('category')->get();
    return view('admin.products.index', compact('products'));
}

public function create()
{
   $categories = Category::with('children')
    ->whereNull('parent_id')
    ->get();
    return view('admin.products.create', compact('categories'));
}


public function store(Request $request)
{
    $data = $request->only([
        'name',
        'sku',
        'price',
        'stock',
        'short_description',
        'long_description',
        'saleable_quantity',
        'category_id'
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $path = $file->store('products', 'public');
        $data['image'] = $path;
    }

    Product::create($data);

    return redirect('/admin/products')->with('success', 'Successfully Added!');
}


public function userProducts(Request $request)
{
   if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }


     $categories = Category::whereNull('parent_id') ->with('children')
     ->get();

        $products = Product::query();

         if ($request->category_id) {
        
        $categoryIds = Category::where('id', $request->category_id)
            ->orWhere('parent_id', $request->category_id)
            ->pluck('id');

        $products->whereIn('category_id', $categoryIds);
    }
   
    if ($request->search) {
        $products->where('name', 'like', '%' . $request->search . '%');
    }

    $products = $products->get();
    return view('products', compact('products', 'categories'));
}





public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::with('children')
    ->whereNull('parent_id')
    ->get();

    return view('admin.products.edit', compact('product', 'categories'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $path = $file->store('products', 'public');
        $data['image'] = $path;
    }

    $product->update($data);

    return redirect('/admin/products')->with('success', 'Successfully Updated!');
}

public function delete($id)
{
    Product::findOrFail($id)->delete();

    return back()->with('success', 'Successfully Deleted!');
}


public function show($id)
{
    $product = Product::findOrFail($id);
     $categories = Category::whereNull('parent_id')->get();
    return view('admin.products.show', compact('product','categories'));
}


}
