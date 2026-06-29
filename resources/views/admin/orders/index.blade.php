@extends('admin.dashboard')
@section('content')

    <h3 style="margin-bottom:40px;">User Orders Details</h3>
 
    <div class="card-body">

        <table id="example" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
             </thead>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop -> iteration }}</td>
                <td>{{ $order->user->name }}</td>
                <td>₹{{ $order->total_amount }}</td>
                <td>
                    <a href="/order-details/{{ $order->id }}" class="btn btn-secondary btn-sm">
                        View
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
      
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