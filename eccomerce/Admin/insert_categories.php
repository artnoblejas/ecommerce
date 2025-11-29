<?php
include('../Includes/connect.php');

if (isset($_POST['insert_cat'])) {

    // Get the user input
    $category_title = trim($_POST['cat_name']);

    // 1. Check if input is empty
    if (empty($category_title)) {
        echo "<script>alert('Please enter a valid category name.');</script>";
    } else {

        // 2. Check if category already exists
        $select_query = "SELECT * FROM categories WHERE Category_Name = '$category_title'";
        $result_select = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($result_select);

        if ($number > 0) {
            echo "<script>alert('This category already exists.');</script>";
        } else {

            // 3. Insert category ONLY IF not empty and not duplicate
            $insert_query = "INSERT INTO categories(Category_Name) VALUES('$category_title')";
            $result = mysqli_query($con, $insert_query);

            if ($result) {
                echo "<script>alert('Category added successfully!');</script>";
            } else {
                echo "<script>alert('Failed to add category.');</script>";
            }
        }
    }
}
?>


<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="cat_name" placeholder="Category Name"
            aria-label="category" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2">
        <button type="submit" name="insert_cat" class="bg-secondary text-light p-2 my-3 b-0">
            Insert Category
        </button>
    </div>
</form>
