@extends('admin.dashboard')
@section('content')

<h2>Inactive Users</h2>

<table id="example" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr id="user-row-{{ $user->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            <td>
                <button class="btn btn-secondary activate-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-bs-toggle="modal" data-bs-target="#activateModal{{ $user->id }}">
                    Activate
                </button>

                <div class="modal fade" id="activateModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Activate User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to activate <strong>{{ $user->name }}</strong>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-success confirm-activate" data-id="{{ $user->id }}">Yes, Activate</button>
                      </div>
                    </div>
                  </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection

@push('scripts')
<script>
$(document).ready(function(){

  
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

    $('.confirm-activate').click(function(){
        let userId = $(this).data('id');

        $.ajax({
            url: "{{ route('admin.activate-user-ajax') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: userId
            },
            success: function(res){
                if(res.success){
              
                    let table = $('#example').DataTable();
                    table.row($('#user-row-' + userId)).remove().draw();

                   
                    $('#activateModal' + userId).modal('hide');

                    // Success message
                    //alert(res.user.name + ' has been activated!');
                }
            },
            error: function(){
                alert('Something went wrong!');
            }
        });
    });

});
</script>
@endpush