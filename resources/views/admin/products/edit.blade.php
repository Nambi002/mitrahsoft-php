@extends('admin.dashboard')
@section('content')

<div class="card">
    <div class="card-header text-white fw-semibold" style="background:#2c3e50;">Edit Product</div>

    <div class="card-body">

        <form method="POST" 
              action="/admin/products/update/{{ $product->id }}" 
              enctype="multipart/form-data">

<div class="row g-4">
            @csrf

            <div class="col-md-6 fw-semibold">
           
            <label class="form-label">Current Image</label>
            <img src="{{ asset('storage/'.$product->image) }}" width="100" class="mb-2">
            <br>
            <label class="form-label">Product Image</label>
            <input type="file" name="image" class="form-control mb-2">
            </div>

            <div class="col-md-6 fw-semibold">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" value="{{ $product->name }}"  class="form-control mb-2">
            </div>

            <div class="col-md-6 fw-semibold">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" value="{{ $product->sku }}" class="form-control mb-2">
            </div>   

            <div class="col-md-6 fw-semibold">
            <label class="form-label">Price (₹)</label>
            <input type="number" name="price" value="{{ $product->price }}" class="form-control mb-2">
            </div>

            <div class="col-md-6 fw-semibold">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control mb-2">
            </div>

            <div class="col-md-12 fw-semibold">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" class="form-control mb-2">{{ $product->short_description }}</textarea>
            </div>

            <div class="col-md-12 fw-semibold">
            <label class="form-label">Long Description</label>
            <textarea name="long_description" 
                      class="form-control mb-2">{{ $product->long_description }}</textarea>
           </div>

            <div class="col-md-12 fw-semibold">
            <label class="form-label">Categories</label>
           <!--select name="category_id" class="form-select mb-2">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select-->
        

            <!--select name="category_id" class="form-select">
                <option  value="" ></option>
              @foreach($categories as $cat)
              @include('partials.category-option', ['category' => $cat, 'level' => 0])
              @endforeach

            </select-->

    <select name="category_id" class="form-select">
    <option value="">Main Category</option>
@foreach($categories as $cat)
    @include('partials.categorys-option', [
        'category' => $cat,
        'level' => 0,
        'category_edit' => $product->category_id

    ])
@endforeach
</select>

            </div>
             
            <div class="mt-4 d-flex justify-content-end">
            <button class="btn btn-secondary px-4">Update</button>
            </div>
           
        </form>

    </div>
</div>

@endsection
