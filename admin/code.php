<?php
session_start();

$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "mydb";

// Create the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include('../functions/myfunctions.php');

if (isset($_POST['add_category_btn'])) {

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = 0; // Default value for unchecked

    // Check if the checkbox value is set (means it was checked)
    if (isset($_POST['status'])) {
        $status = 1; // Value for checked
    }
    $popular = 0; // Default value for unchecked

    // Check if the checkbox value is set (it means it was checked)
    if (isset($_POST['popular'])) {
        $popular = 1; // Value for checked
    }


    $file_name = $_FILES['image']['name'];
    $image_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $image = time() . "." . $image_ext;

    $file_name = $_FILES['image']['name'];


    $tempname = $_FILES['image']['tmp_name'];
    $folder = "../uploads/" . $image;

    $query = mysqli_query($conn, "insert into categories(name,slug,description,status,popular,image,meta_tittle,meta_description,meta_keywords) values ('$name','$slug','$description','$status','$popular','$image','$meta_title','$meta_description','$meta_keywords')");






    if (move_uploaded_file($tempname, $folder)) {

        $_SESSION['alert'] = "Category added succesfuly";
        header('Location:category.php');
    } else {
        $_SESSION['alert'] = "Something went wrong";
        header('Location:add-category.php');
    }
} else if (isset($_POST['update_category_btn'])) {

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_tittle'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? "1" : "0";
    $popular = isset($_POST['popular']) ? "1" : "0";



    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        //$update_filename=$new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . "." . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $folder = "../uploads/" . $update_filename;



    $update_query = "UPDATE categories SET name='$name',slug='$slug',description='$description',
    meta_tittle='$meta_title',meta_description='$meta_description',meta_keywords='$meta_keywords',
    status='$status',popular='$popular',image='$update_filename' WHERE id='$category_id' ";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $folder);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }

        $_SESSION['alert'] = "Category Updated succesfully";
        header("Location:category.php?id=$category_id");
    } else {
        $_SESSION['alert'] = "Something went wrong";
        header("Location:edit-category.php?id=$category_id");
    }
} else if (isset($_POST['delete_category_btn'])) {


    $category_id = $_POST['category_id'];

    $category_query = "SELECT * from categories where id='$category_id' ";
    $category_query_run = mysqli_query($conn, $category_query);

    //Fetching Image
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {

        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }


        /*$_SESSION['alert'] = "Category deleted succesfully";
        header("Location:category.php");*/
        echo 200;
    } else {
        /* $_SESSION['alert'] = "Something went wrong";
        header("Location:category.php");*/
        echo 500;
    }
} else if (isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $op = $_POST['original_price'];
    $sp = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = 0; // Default value for unchecked

    // Check if the checkbox value is set (means it was checked)
    if (isset($_POST['status'])) {
        $status = 1; // Value for checked
    }

    $trend = isset($_POST['trending']) ? 1 : 0;

    $file_name = $_FILES['image']['name'];
    $image_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $image = time() . "." . $image_ext;

    $file_name = $_FILES['image']['name'];


    $tempname = $_FILES['image']['tmp_name'];
    $folder = "../uploads/" . $image;


    if ($name != "" && $slug != "" && $description != "") {
        $pquery = "INSERT INTO products(category_id,name,slug,small_description,
    description,original_price,selling_price,qty,meta_title,meta_description,
    meta_keywords,status,trending,image)
    VALUES ('$category_id','$name','$slug','$small_description','$description',
    '$op','$sp','$qty','$meta_title','$meta_description','$meta_keywords',
    '$status','$trend','$image') ";

        $product_query_run = mysqli_query($conn, $pquery);

        if (move_uploaded_file($tempname, $folder)) {

            $_SESSION['alert'] = "Product added succesfuly";
            header('Location:products.php');
        } else {
            $_SESSION['alert'] = "Something went wrong";
            header('Location:add-product.php');
        }
    } else {
        $_SESSION['alert'] = "All fields are mandatory";
        header('Location:add-product.php');
    }
} else if (isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $op = $_POST['original_price'];
    $sp = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? "1" : "0";
    $trend = isset($_POST['trending']) ? 1 : 0;



    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        //$update_filename=$new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . "." . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads/" . $update_filename;


    $update_product_query = "UPDATE products SET name='$name',
    slug='$slug',
    small_description='$small_description',
    description='$description',
    original_price='$op',
    selling_price='$sp',
    image='$update_filename ',
    qty='$qty',
    status='$status',
    trending='$trend',
    meta_title='$meta_title',
    meta_keywords='$meta_keywords',
    meta_description='$meta_description' WHERE id='$product_id'  ";

    $update_product_query_run = mysqli_query($conn, $update_product_query);

    if ($update_product_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }

        $_SESSION['alert'] = "Product Updated succesfully";
        header("Location:products.php");
    } else {
        $_SESSION['alert'] = "Something went wrong";
        header("Location:edit-product.php?id=$product_id");
    }
} else if (isset($_POST['delete_product_btn'])) {
    $product_id = $_POST['product_id'];

    $product_query = "SELECT * from products where id='$product_id' ";
    $product_query_run = mysqli_query($conn, $product_query);

    //Fetching Image
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id='$product_id' ";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {

        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }


        /* $_SESSION['alert'] = "Product deleted succesfully";
        header("Location:products.php");*/
        echo 200;
    } else {
        /* $_SESSION['alert'] = "Something went wrong";
        header("Location:products.php");*/
        echo 500;
    }
} else if(isset($_POST['update_order_btn'])){

    $track_no=$_POST['tracking_no'];
    $os=$_POST['OrderStatus'];

    $updateOrder_query="UPDATE orders SET status='$os' WHERE tracking_no='$track_no' ";
    $updateOrder_query_run=mysqli_query($conn,$updateOrder_query);

    header("Location:view-order.php?t=$track_no");
    $_SESSION['alert']="Status Updated";

}else {
    header('Location: ../admin/index.php');
}
