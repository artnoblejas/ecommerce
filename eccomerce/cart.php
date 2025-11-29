<?php
include('Includes/connect.php');
include('function/common_function.php');

// ---------- UPDATE CART ----------
if (isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] as $product_id => $quantity) {
        $product_id = (int)$product_id;
        $quantity = (int)$quantity;

        if ($quantity > 0) {
            mysqli_query($con, "UPDATE cart_details SET quantity=$quantity WHERE Product_ID=$product_id AND IP_Address='".getUserIP()."'");
        }
    }
    echo "<script>alert('Cart updated successfully!');</script>";
    echo "<script>window.open('cart.php','_self');</script>";
}

// ---------- REMOVE SINGLE ITEM ----------
if (isset($_POST['remove_cart_single'])) {
    $remove_id = (int)$_POST['remove_cart_single'];
    mysqli_query($con, "DELETE FROM cart_details WHERE Product_ID=$remove_id AND IP_Address='".getUserIP()."'");
    echo "<script>alert('Item removed successfully!');</script>";
    echo "<script>window.open('cart.php','_self');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a href="index.php"><img src="./images/logo.png" class="logo" alt="Logo"></a>
            <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="user_register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Total Price: ₱<?php total_cart_price(); ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Page Title -->
<div class="bg-light py-3 text-center">
    <h3>Apparel Store</h3>
    <p>Your Cart</p>
</div>

<!-- Cart Table -->
<div class="container my-4">
    <form action="" method="POST">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_ip = getUserIP();
                $cart_query = "SELECT * FROM cart_details WHERE IP_Address='$user_ip'";
                $cart_result = mysqli_query($con, $cart_query);

                $total_price = 0;
                $cart_empty = true;

                if (mysqli_num_rows($cart_result) > 0) {
                    $cart_empty = false; // cart has items
                    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
                        $product_id = $cart_row['Product_ID'];
                        $quantity = $cart_row['quantity'];

                        $product_query = "SELECT * FROM products WHERE Product_ID='$product_id'";
                        $product_result = mysqli_query($con, $product_query);
                        $product = mysqli_fetch_assoc($product_result);

                        $product_name  = $product['Product_Name'];
                        $product_image = $product['Product_Image'];
                        $product_price = $product['Product_Price'];

                        $subtotal = $product_price * $quantity;
                        $total_price += $subtotal;

                        // prevent broken image
                        $image_path = "./Admin/product_images/".$product_image;
                        if (!file_exists($image_path) || empty($product_image)) {
                            $image_path = "./images/no-image.png"; // default placeholder
                        }
                ?>
                <tr>
                    <td><?php echo $product_name; ?></td>
                    <td>
                        <img src="<?php echo $image_path; ?>" width="80" height="80">
                    </td>
                    <td>
                        <input type="number" 
                               name="qty[<?php echo $product_id; ?>]" 
                               value="<?php echo $quantity; ?>" 
                               min="1" class="form-control text-center">
                    </td>
                    <td>₱<?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" name="update_cart">Update</button>
                        <button class="btn btn-danger btn-sm" name="remove_cart_single" value="<?php echo $product_id; ?>">Remove</button>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="5" class="text-center">Your cart is empty.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center px-3 my-3">
            <a href="index.php" class="btn btn-secondary">Continue Shopping</a>

            <?php if (!$cart_empty) { ?>
                <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
            <?php } else { ?>
                <button class="btn btn-success" disabled>Proceed to Checkout</button>
            <?php } ?>
        </div>

        <?php if (!$cart_empty) { ?>
            <h4 class="text-end px-3">Total: ₱<?php echo number_format($total_price, 2); ?></h4>
        <?php } ?>
    </form>
</div>

<?php include('./Includes/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
