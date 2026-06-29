    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<style>
    
.dropbtn {
  background-color:#435b72;
  color: white;
  padding: 10px;
  font-size: 18px;
  border: none;
  cursor: pointer;
  border-radius: 10px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color:#435b72;

}
.cart-content {
  background-color:#435b72;
  color: white;
  padding: 14px;
  font-size: 18px;
  border: none;
  cursor: pointer;
  border-radius: 10px;
  position: absolute;
  right: 50px;
  bottom:27px;

}
.cart-content a{
  color:white;
  font-size:19px;
}

</style>


<nav class="navbar navbar-expand-lg  px-4" style="background:#2c3e50;">
    <a class="navbar-brand text-white fw-bold ms-3 me-3 mb-2"><i class="fa-solid fa-dragon"></i> Timeless Trends</a>
    <form method="GET" class="d-flex  w-75 ms-5 me-5 mx-5 mt-4 mb-4 md-5 gap-3">
    <input type="text" name="search" class="form-control" placeholder="Search products...">

</form>

    <div class="d-flex justify-content-end gap-3 text-white">

<div class="dropdown" style="float:right;">
  <button class="dropbtn"> 

    <i class="fa-solid fa-user"></i>    <i class="fa-solid fa-angle-down"></i></button>
          
  <div class="dropdown-content">
  <a href="{{ url('/') }}">Sign-in</a>
  <a href="{{ url('/register') }}">Register</a>
  <a href="{{ url('/logout') }}">Logout</a>
  </div>
</div>

<div class="cart-content mt-3 ms-3 ">

    <a href="{{ url('/cart') }}">
        <i class="fa-solid fa-shopping-cart"></i>
    </a>

    <span id="cart-count"
          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        0
    </span>

</div>


</nav>

  <div  class="content">
       @yield('content')
    </div>



   <script>
$(document).ready(function(){

    loadCartCount();

    $('.add-to-cart').click(function(e){
        e.preventDefault();

        let productId = $(this).data('id');

        $.ajax({
            url: '/add-to-cart/' + productId,
            type: 'GET',
            success: function(res){
                $('#cart-count').text(res.count);
            }
        });
    });

 
    $('.remove-from-cart').click(function(e){
        e.preventDefault();

        let cartId = $(this).data('id');

        $.ajax({
            url: '/cart-remove/' + cartId,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
            },
            success: function(res){
                $('#cart-count').text(res.count);
                $('#cart-item-' + cartId).remove();
            }
        });
    });

});

function loadCartCount() {
    $.ajax({
        url: '/cart-count',
        type: 'GET',
        success: function(res){
            $('#cart-count').text(res.count);
        }
    });
}
</script>
