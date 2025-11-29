<?php

include('../Includes/connect.php');

if (isset($_POST['insert_product'])) {

    $Product_Name        = $_POST['Product_Name'];
    $Product_Description = $_POST['Product_Description'];
    $Product_Keyword     = $_POST['Product_Keyword'];
    $Category_ID         = $_POST['Category_Name'];  
    $Product_Price       = $_POST['Product_Price'];
    $Product_Status      = 'true';

    // image
    $Product_Image = $_FILES['Product_Image']['name'];
    $Temp_Image    = $_FILES['Product_Image']['tmp_name'];
      $Product_Image2 = $_FILES['Product_Image2']['name'];
    $Temp_Image2    = $_FILES['Product_Image2']['tmp_name'];
      $Product_Image3 = $_FILES['Product_Image3']['name'];
    $Temp_Image3    = $_FILES['Product_Image3']['tmp_name'];

    // ---------------- VALIDATION ----------------

    // empty fields
    if (
        empty($Product_Name) || empty($Product_Description) || empty($Product_Keyword) ||
        empty($Category_ID) || empty($Product_Price) || empty($Product_Image)
    ) {
        echo "<script>
            alert('Please fill all fields!');
            window.location.href='insert_products.php';
        </script>";
        exit();
    }

    // price must be a number
    if (!is_numeric($Product_Price)) {
        echo "<script>
            alert('Price must be numbers only!');
            window.location.href='insert_products.php';
        </script>";
        exit();
    }

    // upload image
    move_uploaded_file($Temp_Image, "./product_images/$Product_Image");
      if (!empty($Product_Image2)) {
        move_uploaded_file($Temp_Image2, "./product_images/$Product_Image2");
    }

    if (!empty($Product_Image3)) {
        move_uploaded_file($Temp_Image3, "./product_images/$Product_Image3");
    }

    // ---------------- INSERT QUERY (FIXED) ----------------
   $insert_products = "
        INSERT INTO products 
        (Product_Name, Product_Description, Product_Keyword, Category_ID,
         Product_Image, Product_Image2, Product_Image3, Product_Price, Date, Status)
        VALUES
        ('$Product_Name', '$Product_Description', '$Product_Keyword', '$Category_ID',
         '$Product_Image', '$Product_Image2', '$Product_Image3', '$Product_Price', NOW(), '$Product_Status')
    ";

    $result_query = mysqli_query($con, $insert_products);

    if ($result_query) {
        echo "<script>alert('Product successfully inserted!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-3">
    <h1 class="text-center">Insert Product</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <!-- Product Name -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Product Name</label>
            <input type="text" name="Product_Name" class="form-control" placeholder="Enter product name" required>
        </div>

        <!-- Product Description -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Product Description</label>
            <input type="text" name="Product_Description" class="form-control" placeholder="Enter description" required>
        </div>

        <!-- Product Keyword -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Product Keyword</label>
            <input type="text" name="Product_Keyword" class="form-control" placeholder="Enter keyword" required>
        </div>

        <!-- Category -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Select Category</label>

            <select name="Category_Name" class="form-select" required>
                <option value="" disabled selected>Select a category</option>

                <?php
                $select_query = "SELECT * FROM categories";
                $result_query = mysqli_query($con, $select_query);

                while ($row = mysqli_fetch_assoc($result_query)) {
                    $category_title = $row['Category_Name'];
                    $category_id    = $row['Category_ID'];

                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>

        <!-- Image -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Product Image</label>
            <input type="file" name="Product_Image" class="form-control" required>
        </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Product Image2</label>
            <input type="file" name="Product_Image2" class="form-control" >
        </div>
         <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Product Image3</label>
            <input type="file" name="Product_Image3" class="form-control" >
        </div>

        <!-- Price -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Product Price (₱)</label>
            <input type="number" name="Product_Price" class="form-control"
                   placeholder="Enter product price"
                   min="1" step="0.01" required>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" name="insert_product" class="btn btn-dark px-4">Insert Product</button>
        </div>

    </form>
</div>

</body>
</html>


