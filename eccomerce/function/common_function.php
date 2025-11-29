<?php

// including connect files
include('./Includes/connect.php');


// -------------------------
// GET ALL PRODUCTS (default)
// -------------------------
function getProducts()
{
    global $con;

    // show products only if NO CATEGORY is selected
    if (!isset($_GET['category'])) {

        $select_query = "SELECT * FROM products ORDER BY RAND()";
        $result_query = mysqli_query($con, $select_query);

        while ($row = mysqli_fetch_assoc($result_query)) {

            $Product_ID = $row['Product_ID'];
            $Product_Name = $row['Product_Name'];
            $Product_Description = $row['Product_Description'];
            $Product_Image = $row['Product_Image'];
            $Product_Price = $row['Product_Price'];

            echo "
            <div class='col-md-4 mb-4'>
                <div class='card'>
                    <img src='./Admin/product_images/$Product_Image' class='card-img-top' alt='$Product_Name'>
                    <div class='card-body'>
                        <h5 class='card-title'>$Product_Name</h5>
                        <p class='card-text'>$Product_Description</p>
                        <h6 class='text-muted'>Price: ₱$Product_Price</h6>
                       <div class='d-flex flex-column flex-sm-row'>
                         <a href='index.php? add_to_cart=$Product_ID' class='btn btn-info w-100 me-sm-2 mb-2 mb-sm-0'>Add to Cart</a>
                          <a href='product_details.php?Product_ID=$Product_ID' class='btn btn-secondary w-100'>More details</a>
                     </div>

                    </div>
                </div>
            </div>
            ";
        }
    }
}

// GET PRODUCTS BY CATEGORY
function getuniqueCategories()
{
    global $con;

    if (isset($_GET['category'])) {

        $Category_ID = $_GET['category'];

        // select products under the clicked category
        $select_query = "SELECT * FROM products WHERE Category_ID = $Category_ID";
        $result_query = mysqli_query($con, $select_query);

        $num_of_rows = mysqli_num_rows($result_query);

        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock</h2>";
            return; // stop function
        }

        // product list container
        echo "<div class='row'>";

        while ($row = mysqli_fetch_assoc($result_query)) {

            $Product_ID = $row['Product_ID'];
            $Product_Name = $row['Product_Name'];
            $Product_Description = $row['Product_Description'];
            $Product_Image = $row['Product_Image'];
            $Product_Price = $row['Product_Price'];

            echo "
<div class='col-md-4 mb-4'>
    <div class='card'>
        <img src='./Admin/product_images/$Product_Image' class='card-img-top' alt='$Product_Name'>
        <div class='card-body'>
            <h5 class='card-title'>$Product_Name</h5>
            <p class='card-text'>$Product_Description</p>
           <h6 class='text-muted'>Price: ₱$Product_Price</h6>

          <div class='d-flex flex-column flex-sm-row gap-2'>
    <a href='index.php? add_to_cart=$Product_ID' class='btn btn-info flex-fill w-100 me-sm-2 mb-2 mb-sm-0'>Add to Cart</a>
    <a href='product_details.php?Product_ID=$Product_ID' class='btn btn-secondary flex-fill w-100'>More details</a>
</div>



        </div>
    </div>
</div>
";

        }

    }
}

// view details
function view_details()
{
    global $con;

    if (isset($_GET['Product_ID'])) {

        $Product_ID = (int) $_GET['Product_ID'];

        $select_query = "SELECT * FROM products WHERE Product_ID = $Product_ID";
        $result_query = mysqli_query($con, $select_query);

        while ($row = mysqli_fetch_assoc($result_query)) {

            $Product_Name = $row['Product_Name'];
            $Product_Description = $row['Product_Description'];
            $Product_Image = $row['Product_Image'];
            $Product_Image2 = $row['Product_Image2'];
            $Product_Image3 = $row['Product_Image3'];
            $Product_Price = $row['Product_Price'];

            echo "
                <div class='row'>
                    <!-- MAIN PRODUCT -->
                    <div class='col-md-4 mb-4'>
                        <div class='card'>
                            <img src='./Admin/product_images/$Product_Image' class='card-img-top' alt='$Product_Name'>
                            <div class='card-body'>
                                <h5 class='card-title'>$Product_Name</h5>
                                <p class='card-text'>$Product_Description</p>
                                <h6 class='text-muted'>Price: ₱$Product_Price</h6>
                                <a href='index.php? add_to_cart=$Product_ID' class='btn btn-info'>Add to Cart</a>
                            </div>
                        </div>
                    </div>
            ";

            // ---------- RELATED PRODUCTS SECTION ---------- //
            if (!empty($Product_Image2) || !empty($Product_Image3)) {

                echo "
                    <div class='col-md-8'>
                       
                        <div class='row'>
                ";

                // Related Image #2
                if (!empty($Product_Image2)) {
                    echo "
                        <div class='col-md-6 mb-3'>
                            <img src='./Admin/product_images/$Product_Image2' class='img-fluid border rounded' alt='Related product 1'>
                        </div>
                    ";
                }

                // Related Image #3
                if (!empty($Product_Image3)) {
                    echo "
                        <div class='col-md-6 mb-3'>
                            <img src='./Admin/product_images/$Product_Image3' class='img-fluid border rounded' alt='Related product 2'>
                        </div>
                    ";
                }

                echo "
                        </div>
                    </div> <!-- End related products -->
                ";
            }

            echo "</div>"; // END ROW
        }
    }
}



// -------------------------
// SIDEBAR CATEGORY LIST
// -------------------------
function getCategories()
{

    global $con;

    $select_categories = "SELECT * FROM categories";
    $result_categories = mysqli_query($con, $select_categories);

    while ($row_data = mysqli_fetch_assoc($result_categories)) {

        $category_name = $row_data['Category_Name'];
        $category_id = $row_data['Category_ID'];

        echo "
        <li class='nav-item text-center bg-light p-2 mb-1'>
            <a href='index.php?category=$category_id' class='nav-link text-dark'>$category_name</a>
        </li>
        ";
    }
}
// get IP FunctioN
function getUserIP()
{

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
        // IP from shared internet
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP passed from proxy
        $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ip[0]); // first IP is the real client IP
    } else {
        // Default remote address
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

// Usage
// $user_ip = getUserIP();
// echo "User IP Address: " . $user_ip;

// cart function
function cart() {
    if (isset($_GET['add_to_cart'])) {
        global $con;

        $get_ip = getUserIP(); 
        $get_product_id = (int)$_GET['add_to_cart'];

        $select_query = "SELECT * FROM cart_details WHERE IP_Address='$get_ip' AND Product_ID=$get_product_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already in the cart');</script>";
            echo "<script>window.open('index.php','_self');</script>";
        } else {
            $insert_query = "INSERT INTO cart_details (Product_ID, IP_Address, quantity) VALUES ($get_product_id,'$get_ip',0)";
            $result_query = mysqli_query($con, $insert_query);

            if ($result_query) {
                echo "<script>alert('Item added to cart successfully!');</script>";
                echo "<script>window.open('index.php','_self');</script>";
            } else {
                echo "MySQL Error: " . mysqli_error($con);
            }
        }
    }
}

// cart number
function cart_item() {
    global $con;
    $get_ip = getUserIP();
    $select_query = "SELECT * FROM cart_details WHERE IP_Address='$get_ip'";
    $result_query = mysqli_query($con, $select_query);
    $num_of_items = mysqli_num_rows($result_query);
    echo $num_of_items;
}

// total price function
function total_cart_price() {
    global $con;

    $get_ip_add = getUserIP();
    $total_price = 0;

    // get all items in cart by IP
    $cart_query = "SELECT * FROM `cart_details` WHERE IP_Address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);

    while ($row = mysqli_fetch_assoc($result)) {

        $product_id = $row['Product_ID'];

        // get price of product
        $select_products = "SELECT Product_Price FROM `products` WHERE Product_ID='$product_id'";
        $result_products = mysqli_query($con, $select_products);

        $row_product = mysqli_fetch_assoc($result_products);
        $total_price += $row_product['Product_Price'];
    }

    echo $total_price;
}

?>

