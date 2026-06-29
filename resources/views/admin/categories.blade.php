@extends('admin.dashboard')
@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
  
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3 w-100">
        <h3 class="fw-bold"><i class="fa-solid fa-list"></i> Category List</h3>
        <a href="/admin/create" class="btn btn-secondary">
            + Add Category
        </a>
    </div>


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alert = document.getElementById('success-alert');
            if(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 3000); // 3 seconds
    </script>
@endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table id="example" class="table table-hover table-striped align-middle">

                <thead class="table">
                    <tr>
                        <th class="col-1">#</th>
                        <th class="col-1">Image</th>
                        <th class="col-4">Description</th>
                        <th class="col-1">Name</th>
                        <th class="col-2">Type</th>
                        <th class="col-1">Parent</th>
                        <th class="col-1">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                         <td>
                         <img src="{{ asset('storage/'.$cat->image) }}" width="30">
                         </td>


                         <td class="fw-semibold">
                            {{ $cat->description }}
                        </td>

                         
                        <td class="fw-semibold">
                            {{ $cat->name }}
                        </td>

                        <td>
                            @if($cat->parent)
                                <span class="badge bg-info text-dark">
                                    Subcategory
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Main
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $cat->parent->name ?? 'N/A' }}
                        </td>


                        <td>
                            <li class="list-group-item d-flex justify-content-between">
                          
                    <div>
                    <a href="/admin/categories/edit/{{ $cat->id }}"  class="btn btn-sm btn-warning">Edit</a>

                    <button type="button" class="btn btn-danger btn-sm"  data-bs-toggle="modal"  data-bs-target="#deleteModal{{ $cat->id }}">Delete</button>

                                                                                            
                    <div class="modal fade" id="deleteModal{{ $cat->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $cat->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $cat->id }}"> Delete category Confirmation </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">  Are you sure you want to delete <strong>{{ $cat->name }}</strong>? </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="/admin/categories/delete/{{ $cat->id }}" class="btn btn-danger">Yes, Delete</a>
                    </div>
                    </div>
                    </div>
                    </div>

                    </div>
                    </li>
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            No categories found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            responsive: true,
            language: {
                search: " Search Users:",
                lengthMenu: "Show _MENU_ users",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                paginate: {
                    next: "Next",
                    previous: "Prev"
                }
            }
        });
    });
</script>
@endpush