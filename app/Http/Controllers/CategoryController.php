<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{


public function index()
{
    $categories = Category::all();
    return view('admin.categories', compact('categories'));
}

public function create()
{
    $categories = Category::with('children')
    ->whereNull('parent_id')
    ->get();

    
    return view('admin.create', compact('categories'));
    
}

public function store(Request $request)
{
    $data = [
        'name' => $request->name,
        'parent_id' => $request->parent_id,
        'description' => $request->description,
    ];

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('categories', 'public');
        $data['image'] = $path;
    }

    Category::create($data);

   // return back();
    return redirect('/admin/categories')->with('success', 'Category added successfully!');
}

public function edit($id)
{
    $category = Category::findOrFail($id);
    $categories = Category::whereNull('parent_id')->with('children') ->get();
    return view('admin.edit', compact('category', 'categories'));
}

public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $data = [
       // 'name' => $request->name,
        'parent_id' => $request->parent_id,
        'description' => $request->description,
    ];

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('categories', 'public');
        $data['image'] = $path;
    }

    $category->update($data);

    return redirect('/admin/categories')->with('success', 'Successfully Updated!');
}

public function delete($id)
{
    Category::findOrFail($id)->delete();
    return back()->with('success', 'Successfully Deleted!');
}

}
