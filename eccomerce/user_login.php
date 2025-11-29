<?php
include('Includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-3">
    <h1 class="text-center">User Login</h1>

    <form action="" method="post" >

        <!-- Username -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter your username" autocomplete="off" required>
        </div>

        <!-- Password -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label class="form-label">Password</label>
            <input type="password" name="Password" class="form-control" placeholder="Enter your password" autocomplete="off" required>
        </div>
        
        <p class="text-blue text-center"><a href="">Forgot password</a></p>

        <!-- Register -->
        <div class="text-center ">
            <button type="submit" name="Login_User" class="btn btn-dark px-4">Login</button>
            <p class="small fw-bold m-2" >Don't have an account?<a href="user_register.php" class="text-danger"> Register </a></p>
        </div>

    </form>
</div>

</body>
</html>