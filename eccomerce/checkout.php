<?php
include('Includes/connect.php');
include('function/common_function.php');

$user_ip = getUserIP();
$total_price = 0;

// ---------- PROCESS ORDER ----------
if (isset($_POST['confirm_order'])) {
    $cart_query = "SELECT * FROM cart_details WHERE IP_Address='$user_ip'";
    $cart_result = mysqli_query($con, $cart_query);

    if (mysqli_num_rows($cart_result) > 0) {
        while ($cart_row = mysqli_fetch_assoc($cart_result)) {
            $product_id = $cart_row['Product_ID'];
            $quantity = $cart_row['quantity'];

            $product_query = "SELECT Product_Price FROM products WHERE Product_ID='$product_id'";
            $product_result = mysqli_query($con, $product_query);
            $product = mysqli_fetch_assoc($product_result);

            $subtotal = $product['Product_Price'] * $quantity;

            // Insert into orders table
            mysqli_query($con, "INSERT INTO orders (IP_Address, Product_ID, Quantity, Total_Price) 
                                VALUES ('$user_ip', $product_id, $quantity, $subtotal)");
        }

        // Clear cart
        mysqli_query($con, "DELETE FROM cart_details WHERE IP_Address='$user_ip'");

        echo "<script>alert('Order placed successfully!');</script>";
        echo "<script>window.open('index.php','_self');</script>";
        exit;
    } else {
        echo "<script>alert('Your cart is empty!');</script>";
        echo "<script>window.open('index.php','_self');</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="container my-4">
    <h3 class="text-center">Checkout</h3>
    <p class="text-center">Review your order before confirming</p>

    <form method="POST">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cart_query = "SELECT * FROM cart_details WHERE IP_Address='$user_ip'";
                $cart_result = mysqli_query($con, $cart_query);

                if (mysqli_num_rows($cart_result) > 0) {
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

                        $image_path = "./Admin/product_images/".$product_image;
                        if (!file_exists($image_path) || empty($product_image)) {
                            $image_path = "./images/no-image.png";
                        }
                ?>
                <tr>
                    <td><?php echo $product_name; ?></td>
                    <td><img src="<?php echo $image_path; ?>" width="80" height="80"></td>
                    <td><?php echo $quantity; ?></td>
                    <td>₱<?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="4" class="text-center">Your cart is empty.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <h4 class="text-end px-3">Total: ₱<?php echo number_format($total_price, 2); ?></h4>

        <div class="d-flex justify-content-between my-3">
            <a href="index.php" class="btn btn-secondary">Continue Shopping</a>
            <?php if ($total_price > 0) { ?>
                <button type="submit" name="confirm_order" class="btn btn-success">Confirm Order</button>
            <?php } else { ?>
                <button class="btn btn-success" disabled>Confirm Order</button>
            <?php } ?>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();

$user_ip = getUserIP();

// ---------- CHECK LOGIN ----------
if (!isset($_SESSION['user_id'])) {
    // user not logged in, redirect to login
    echo "<script>alert('Please login to proceed to checkout!');</script>";
    echo "<script>window.open('user_login.php','_self');</script>";
    exit;
}

// ---------- PROCESS ORDER ----------
if (isset($_POST['confirm_order'])) {
    $cart_query = "SELECT * FROM cart_details WHERE IP_Address='$user_ip'";
    $cart_result = mysqli_query($con, $cart_query);

    if (mysqli_num_rows($cart_result) > 0) {
        while ($cart_row = mysqli_fetch_assoc($cart_result)) {
            $product_id = $cart_row['Product_ID'];
            $quantity = $cart_row['quantity'];

            $product_query = "SELECT Product_Price FROM products WHERE Product_ID='$product_id'";
            $product_result = mysqli_query($con, $product_query);
            $product = mysqli_fetch_assoc($product_result);

            $subtotal = $product['Product_Price'] * $quantity;

            // Insert into orders table
            mysqli_query($con, "INSERT INTO orders (IP_Address, Product_ID, Quantity, Total_Price) 
                                VALUES ('$user_ip', $product_id, $quantity, $subtotal)");
        }

        // Clear cart
        mysqli_query($con, "DELETE FROM cart_details WHERE IP_Address='$user_ip'");

        echo "<script>alert('Order placed successfully!');</script>";
        echo "<script>window.open('index.php','_self');</script>";
        exit;
    } else {
        echo "<script>alert('Your cart is empty!');</script>";
        echo "<script>window.open('index.php','_self');</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('./Includes/navbar.php'); ?>

<div class="container my-4">
    <h3 class="text-center">Checkout</h3>
    <p class="text-center">Review your order before confirming</p>

    <form method="POST">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cart_query = "SELECT * FROM cart_details WHERE IP_Address='$user_ip'";
                $cart_result = mysqli_query($con, $cart_query);

                $total_price = 0;
                $cart_empty = true;

                if (mysqli_num_rows($cart_result) > 0) {
                    $cart_empty = false;
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

                        $image_path = "./Admin/product_images/".$product_image;
                        if (!file_exists($image_path) || empty($product_image)) {
                            $image_path = "./images/no-image.png";
                        }
                ?>
                <tr>
                    <td><?php echo $product_name; ?></td>
                    <td><img src="<?php echo $image_path; ?>" width="80" height="80"></td>
                    <td><?php echo $quantity; ?></td>
                    <td>₱<?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="4" class="text-center">Your cart is empty.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <h4 class="text-end px-3">Total: ₱<?php echo number_format($total_price, 2); ?></h4>

        <div class="d-flex justify-content-between my-3">
            <a href="index.php" class="btn btn-secondary">Continue Shopping</a>
            <?php if (!$cart_empty) { ?>
                <button type="submit" name="confirm_order" class="btn btn-success">Confirm Order</button>
            <?php } else { ?>
                <button class="btn btn-success" disabled>Confirm Order</button>
            <?php } ?>
        </div>
    </form>
</div>

<?php include('./Includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
