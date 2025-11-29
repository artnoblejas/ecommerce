<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap CSS link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
      crossorigin="anonymous">
    <!-- CSS link -->
        <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- navbar -->
     <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Welcome guest</a>
                        </li>
                    </ul>        
                </nav>
            </div>
        </nav>

        <!-- second child -->
         <div class="bg-light">
            <h3 class="text-center p-0">Manage details</h3>
         </div>

         <!-- third child -->
          <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="px-5">
                <a href="#"><img src="../images/logo.png" alt="logo" class="admin_picture"></a>
                <p class="text-light text-center">ADMIN</p>
                </div>
            <div class="button text-center m-10 p-2">
                <button><a href="insert_products.php" class="nav-link text-light bg-secondary my-2 p-2">Insert Products</button></a>
                <button><a href="" class="nav-link text-light bg-secondary my-2 p-2">View Products</button></a>
                <button><a href="index.php?insert_category" class="nav-link text-light bg-secondary my-2 p-2">Insert Categories</button></a>
                <button><a href="" class="nav-link text-light bg-secondary my-2 p-2">View Categories</button></a>
                <button><a href="" class="nav-link text-light bg-secondary my-2 p-2">All Orders</button></a>
                <button><a href="" class="nav-link text-light bg-secondary my-2 p-2">All Payments</button></a>
                <button><a href="" class="nav-link text-light bg-secondary my-2 p-2">List Users</button></a>
                <button><a href="" class="nav-link text-light bg-secondary my-2 p-2">Logout</button></a>
            </div>
            </div>
        </div>
    <!-- fourth child -->
        <div class="container my-5">
            <?php
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            ?>
        </div>
     </div>
    <!-- bootstrap JS link  -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
     crossorigin="anonymous"></script>

</body>
</html>