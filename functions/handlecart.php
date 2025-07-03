<?php

session_start();

// Initialize the database connection
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

if (isset($_SESSION['auth'])) {
    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case "add":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                $run = mysqli_query($conn, $chk_existing_cart);

                if (mysqli_num_rows($run) > 0) {
                    echo "existing";
                } else {
                    $insert_query = "INSERT INTO carts(user_id,prod_id,prod_qty)VALUES ('$user_id','$prod_id','$prod_qty')";
                    $insert_query_run = mysqli_query($conn, $insert_query);

                    if ($insert_query_run) {
                        echo 201;
                    } else {
                        echo 500;
                    }
                }







                break;

            case "update":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];
                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                $run = mysqli_query($conn, $chk_existing_cart);

                if (mysqli_num_rows($run) > 0) {
                    $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                    $update_query_run = mysqli_query($conn, $update_query);
                    if ($update_query_run) {
                        echo 200;
                    } else {
                        echo 500;
                    }
                } else {
                    echo "Something Went wrong";
                }
                break;




            case "delete":
                $cart_id = $_POST['cart_id'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $chk_existing_cart = "SELECT * FROM carts WHERE id='$cart_id' AND user_id='$user_id' ";
                $run = mysqli_query($conn, $chk_existing_cart);
                if (mysqli_num_rows($run) > 0) {
                    $delete_query = " DELETE FROM carts WHERE id='$cart_id' ";
                    $delete_query_run = mysqli_query($conn, $delete_query);
                    if ($delete_query_run) {
                        echo 200;
                    } else {
                        echo "Something Went wrong";
                    }
                } else {
                    echo "Something Went wrong";
                }
                break;


            default:
                echo 500;
        }
    }
} else {
    echo 401;
}
