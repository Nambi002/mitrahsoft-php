@extends('admin.dashboard')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 w-100">
        <h3 class="fw-bold"><i class="fa-solid fa-bag-shopping"></i> Product List</h3>
        <a href="/admin/products/create" class="btn btn-secondary">
            + Add Product
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

     <div class="card shadow-sm mb-4">
        <div class="card-body ">

            <table id="example"  class="table table-hover table-striped align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                       

                        <td>
                        <img src="{{ asset('storage/'.$product->image) }}" width="30">
                        </td>

                        <td class="fw-semibold">{{ $product->name }}</td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $product->sku }}
                            </span>
                        </td>

                        <td>₹ {{ number_format($product->price, 2) }}</td>

                        <td>
                            @if($product->stock > 10)
                                <span class="badge bg-success">In Stock</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning text-dark">Low</span>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>

                    <td>
                    <a href="/admin/products/edit/{{ $product->id }}"  class="btn btn-warning btn-sm">Edit</a>


                   <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">Delete</button>

                   <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"  aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">
                               Delete Product Confirmation
                           </h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                         </div>
                         <div class="modal-body">
                           Are you sure you want to delete <strong>{{ $product->name }}</strong>?
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                           <a href="/admin/products/delete/{{ $product->id }}" class="btn btn-danger">Yes, Delete</a>
                         </div>
                       </div>
                     </div>
                   </div>

                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No products found
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