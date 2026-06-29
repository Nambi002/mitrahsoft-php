@extends('admin.dashboard')
@section('content')

   <title>Unverified_users</title>
 
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

  border-radius:6px;
  padding:7px;
}
</style>


<body>
<form action="/admin/unverified-users" method="POST">
    @csrf
<h2><i class="fa-solid fa-user-lock"></i>  Unverified Users</h2>

  <div class="card shadow-sm">
        <div class="card-body">

<table id="example" class="table table-striped  table-hover">
<thead >
<tr>

    <th>S.No</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->mobile }}</td>
    <td>

        <div class="button">
            <a href="#" data-bs-toggle="modal"  class="btn btn-secondary"  data-bs-target="#verifyModal{{ $user->id }}">Verify</a>
        </div>

          <div class="modal fade" id="verifyModal{{ $user->id }}" tabindex="-1" aria-labelledby="verifyModalLabel{{ $user->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="verifyModalLabel{{ $user->id }}">Verify User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Do you want to verify {{ $user->name }}?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="/admin/approve-user/{{ $user->id }}" class="btn btn-success">Yes, Verify</a>
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






