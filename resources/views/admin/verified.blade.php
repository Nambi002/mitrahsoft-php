@extends('admin.dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verified_users</title>
 
</head>
<style>
h2{
    font-size:30px;
    font-weight:600;
    margin-top:60px;
    margin-bottom:60px;
}

td a{
    text-decoration:none;
    color:white;
}
.button{
    display:inline;
    background:#3a7bbc;
    border-radius:6px;
    padding:7px;
}

</style>
<body>
 
<form action="/admin/verified-users" method="POST">
    @csrf
<h2><i class="fa-solid fa-user-check"></i> Verified Users</h2>
  <div class="card shadow-sm">
        <div class="card-body">

<table id="example" class="table table-striped  table-hover">
  <thead class="table">
<tr>
    
    <th>S.No</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Action</th>
</tr>
</thead>

@foreach($users as $user)
<tr>
       <td>{{ $loop->iteration }}</td>
 
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->mobile }}</td>
    <td>
 
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#inactiveModal{{ $user->id }}">
          Inactive
        </button>

        <div class="modal fade" id="inactiveModal{{ $user->id }}" tabindex="-1" aria-labelledby="inactiveModalLabel{{ $user->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="inactiveModalLabel{{ $user->id }}">Inactive User Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                Do you want to mark {{ $user->name }} as inactive?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="/admin/inactivate-user/{{ $user->id }}" class="btn btn-danger">Yes, Inactive</a>
              </div>
            </div>
          </div>
        </div>
    </td>
</tr>
@endforeach
</table>
@endsection
</form>

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


</body>
</html>




