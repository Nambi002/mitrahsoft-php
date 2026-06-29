@extends('admin.dashboard')

@section('content')

<div class="card">
       <div class="card-header text-white fw-semibold" style="background:#2c3e50;">Edit Category</div>


    <div class="card-body">

        <form method="POST" action="/admin/categories/update/{{ $category->id }}" enctype="multipart/form-data">
            @csrf

                             
<div class="col-md-6">
    <label class="form-label mt-3"><b> Category Image</b></label>
    <img src="{{ asset('storage/'.$category->image) }}" width="100" class="mb-2"><br>
    <label class="form-label mt-3"><b>Edit Category Image</b></label>
    <input type="file" name="image" class="form-control" value="{{ $category->image }}" >
</div>

<div class="col-md-12">
    <label class="form-label mt-3"><b>Description</b></label>
    <textarea name="description" class="form-control " rows="3" value="{{ $category->description }}" >{{ $category->description }}
    </textarea>
</div>
       
           <!-- <label class="form-label mt-3"><b>Child Category Name</b></label>
            input type="text" name="name" 
                   value="{{ $category->name }}" 
                   class="form-control mb-3"-->
                 



            <label class="form-label mt-3"><b> Category Name </b></label>

            <select name="parent_id" class="form-select">
    <option value="">Main Category</option>
@foreach($categories as $cat)
    @include('partials.category-option', [
        'category' => $cat,
        'level' => 0,
        'category_edit' => $category
    ])
@endforeach
</select>

        <!--select name="parent_id">
        <option value="">Main Category</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select-->

            <!--select name="parent_id" class="form-select"  class="form-select">
                    <option value="">Main Category</option>
                       @foreach($categories as $cat)
                       @include('partials.category-option', ['category' => $cat, 'level' => 0])
                       @endforeach
                    </select-->   

            <button class="btn btn-secondary mt-2">Update</button>
        </form>

    </div>
</div>

@endsection
