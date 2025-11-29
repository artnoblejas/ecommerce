<?php
include('Includes/connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-3">
    <h1 class="text-center">New User Registration</h1>

    <form action="" method="post" >

        <!-- Username -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter your username" autocomplete="off" required>
        </div>

        <!-- Email -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Email</label>
            <input type="text" name="Email" class="form-control" placeholder="Enter your email" autocomplete="off" required>
        </div>

        <!-- Password -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Password</label>
            <input type="password" name="Password" class="form-control" placeholder="Enter your password" autocomplete="off" required>
        </div>

        <!-- Confirm Password -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="Confirm Password" class="form-control" placeholder="Enter again your password" autocomplete="off" required>
        </div>

        <!-- Address -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Address</label>
            <input type="text" name="Address" class="form-control" placeholder="Enter your address" autocomplete="off" required>
        </div>

        <!-- Contact -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Contact Number</label>
            <input type="number" name="Contact Number" class="form-control"
                   placeholder="Enter your contact number" autocomplete="off" 
                   min="1" step="0.01" required>
        </div>

        <!-- Register -->
        <div class="text-center ">
            <button type="submit" name="Register_User" class="btn btn-dark px-4">Register</button>
            <p class="small fw-bold m-2" >Already have an account?<a href="user_login.php" class="text-danger"> Login</a></p>
        </div>

    </form>
</div>

</body>
</html>