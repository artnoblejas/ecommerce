<?php
include('Includes/connect.php');
include('function/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- bootstrap CSS link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
      crossorigin="anonymous">
    <!-- font awesome link -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" 
       integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" 
       crossorigin="anonymous" 
       referrerpolicy="no-referrer" />
    <!-- CSS link -->
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- navbar -->
     <div class="container-fluid p-0">
    <!-- first child -->
       <nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">

   
    <a href="index.php">
      <img src="./images/logo.png" alt="" class="logo">
    </a>

    <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user_register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <sup><?php cart_item(); ?></sup>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_cart_price();?></a>
        </li>
      </ul>

      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>

    </div>
  </div>
</nav>
<!-- second child -->
 <nav class="navbar navbar-expand-lg navbar-light bg-secondary"> 
  <ul class="navbar-nav me-auto">
    <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
        </li>
    <li class="nav-item">
          <a class="nav-link" href="user_login.php">Login</a>
        </li>
    
  </ul>
 </nav>
 <!-- third child -->
  <div class="bg-light">
    <h3 class="text-center">Apparel Store</h3>
    <p class="text-center">Wear all you want</p>
  </div>
<!-- fourth child -->
<div class="container-fluid">
  <div class="row">
 <!-- left sidebar -->
    <div class="col-md-2 bg-secondary text-white p-3">
      <h4 class="text-center">Categories</h4>
     <ul class="navbar-nav me-auto">
      <?php
    getCategories();
?>
    </div>

    <!-- products section -->
<div class="col-md-10">

    <div class="row">

        <!-- fetching products -->
        <?php
        //calling function
      getProducts();
      getuniqueCategories();
        ?>

    </div>
</div>
<!-- last child -->
 <?php
 include("./Includes/footer.php");
 ?>

<!-- bootstrap JS link -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
     crossorigin="anonymous"></script>

</body>

</html>