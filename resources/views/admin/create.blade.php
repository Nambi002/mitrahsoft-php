@extends('admin.dashboard')
@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-header  text-white fw-semibold" style="background:#2c3e50;">
                     Add Category
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/categories"  enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                   <div class="col-md-6 fw-semibold">
                        <label class="form-label">Category Image</label>
                        <input type="file" name="image" class="form-control">
                   </div>

                   <div class="col-md-12 fw-semibold">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                   </div>
                
                
                    <div class="col-md-6 fw-semibold">
                          <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                    </div>

                    <div class="col-md-6 fw-semibold">
                         <label class="form-label">Select Categories</label>
                    <select name="parent_id" class="form-select"  class="form-select">
                    <option value="">Main Category</option>
                       @foreach($categories as $cat)
                       @include('partials.category-option', ['category' => $cat, 'level' => 0])
                       @endforeach
                    </select>           
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-secondary">
                            + Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection





