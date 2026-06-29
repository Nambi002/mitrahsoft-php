<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    
 <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">




<style>
    
.sidebar{
width:220px;
height:100%;
background:#2c3e50;
position:fixed;
color:white;
}

.sidebar a{
display:block;
padding:18px;
color:white;
text-decoration:none;
margin-bottom:40px;
}

.sidebar i{
margin-left:20px;
margin-right:6px;
}

.sidebar a:hover{
background:#435b72;
}

.content{
margin-left:230px;
padding:20px;
}

.title{
display:flex;
justify-content:space-between;
align-items:center;
background:#2c3e50;
padding:40px;
color:#fff;
height:10vh;  
position:sticky;  
top: 0;
z-index: 999;
}

.title a{
color:#fff;
text-decoration:none;
}

.logout{
display:flex;
justify-content:space-between;
align-items:center;
gap:30px;
}

.head{
display:flex;
justify-content:space-between;
align-items:center;
gap:30px;
}

.navbar{
    gap:120px;
}

#example thead th {
    background-color: #2c3e50;
    color: white;
}


</style>
</head>
<body>

<div class="title">
    <div class="head"><b>ADMIN PANEL</b></div>
    <div><a href="{{ url('/logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></div>
    
</div>

<div class="sidebar">
<h4 class="text-center mt-5"></h4>

        <a href="/admin/unverified"><i class="fa-solid fa-user-lock"></i> Unverified Users</a>
        <a href="/admin/verified"><i class="fa-solid fa-user-check"></i> Verified Users</a>
        <a href="/admin/inactive"><i class="fa-solid fa-user-xmark"></i> Inactive Users</a>
        <a href="/admin/categories"><i class="fa fa-list"></i>Category</a>                                               
        <a href="/admin/products"><i class="fa-solid fa-bag-shopping"></i>Product</a>                                  
        <a href="/admin/orders/index"><i class="fa-solid fa-cart-shopping"></i>Order</a>
        
    </div>
    </div>

    <div  class="content">
       @yield('content')
    </div>
     
</div>
@stack('scripts')
</body>
</html>