@extends('admin.dashboard')
@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header  text-white fw-semibold" style="background:#2c3e50;">
             Add Product
        </div>

        <div class="card-body">
            <form method="POST" action="/admin/products/store" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6 fw-semibold">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control mb-2">
                    </div>
                 
                    <div class="col-md-6 fw-semibold">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>

                    <div class="col-md-6 fw-semibold">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" placeholder="Unique SKU" required>
                    </div>

                    <div class="col-md-4 fw-semibold">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" name="price" class="form-control" placeholder="0.00" required>
                    </div>

                    <div class="col-md-4 fw-semibold">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" placeholder="Available stock">
                    </div>

                    <div class="col-md-4 fw-semibold">
                        <label class="form-label">Saleable Quantity</label>
                        <input type="number" name="saleable_quantity" class="form-control" placeholder="Optional">
                    </div>

                    <div class="col-md-12 fw-semibold">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" rows="2" class="form-control"
                            placeholder="Brief about product"></textarea>
                    </div>

                    <div class="col-md-12 fw-semibold">
                        <label class="form-label">Long Description</label>
                        <textarea name="long_description" rows="4" class="form-control"
                            placeholder="Detailed product description"></textarea>
                    </div>

                    <div class="col-md-12 fw-semibold">
                        <label class="form-label">Categories</label>
                        <select name="category_id" class="form-select">
                         @foreach($categories as $cat)
                         @include('partials.category-option', ['category' => $cat, 'level' => 0])
                         @endforeach
                        </select>                       
                        <small class="text-muted">
                            You can select categories Here
                        </small>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-end">
                    <button class="btn btn-secondary px-4">
                         Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


