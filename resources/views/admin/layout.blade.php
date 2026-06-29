<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

<h2>Admin Panel</h2>

<div style="display:flex">

    <!-- Sidebar -->
    <div style="width:200px; background:#ddd; padding:10px;">
        <a href="/admin/customers/unverified">Unverified Users</a><br><br>
        <a href="/admin/customers/verified">Verified Users</a><br><br>
        <a href="/admin/customers/inactive">Inactive Users</a><br><br>
    </div>

    <!-- Content -->
    <div style="margin-left:20px;">
        @yield('content')
    </div>

</div>

</body>
</html>
