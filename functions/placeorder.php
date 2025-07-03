<?php

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


require 'userfunctions.php';

if (isset($_SESSION['auth'])) {
    if (isset($_POST['placeOrderBtn'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
        $payment_id=mysqli_real_escape_string($conn, $_POST['payment_id']);

        if ($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "") {
            $_SESSION['alert'] = "All fields are mandatory";
            header('Location: ../checkout.php');
            exit(0);
        }
        $cartItems = getCartItems();
        $totalPrice = 0;
        foreach ($cartItems as $citem) 
        {
            
            $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
        }
        echo $totalPrice;

        $tracking_no = "AksharMotors" . rand(1111, 9999) . substr($phone, 2);
        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "INSERT INTO orders (tracking_no,user_id,name,email,phone,address,pincode,total_price,
        payment_mode,payment_id) VALUES ('$tracking_no','$user_id','$name','$email','$phone','$address','$pincode','$totalPrice','$payment_mode','$payment_id')";
        $insert_query_run=mysqli_query($conn,$query);

        if($insert_query_run)
        {
            $order_id=mysqli_insert_id($conn);

            foreach ($cartItems as $citem) {


                $prod_id=$citem['prod_id'];
                $prod_qty=$citem['prod_qty'];
                $sp=$citem['selling_price'];
                 

                $insert_items_query="INSERT INTO order_items(order_id,prod_id,qty,price) 
                VALUES ('$order_id','$prod_id','$prod_qty','$sp')" ;

                $insert_items_query_run=mysqli_query($conn,$insert_items_query);

                $product_query="SELECT * FROM products WHERE id='$prod_id' LIMIT 1";
                $product_query_run=mysqli_query($conn,$product_query);

                $productData=mysqli_fetch_array($product_query_run);
                $current_qty=$productData['qty'];

                $new_qty=$current_qty-$prod_qty;

                $updateQty_query="UPDATE products SET qty='$new_qty' WHERE id='$prod_id' ";
                $updateQty_query_run=mysqli_query($conn,$updateQty_query);




            }


            $delete_cart_query="DELETE FROM carts WHERE user_id='$user_id' ";
            $delete_cart_query_run=mysqli_query($conn,$delete_cart_query);
            










            $_SESSION['alert']="Orders Placed Successfully";
            header('Location: ../my-orders.php'); 
            die();
           

        }



    } 
} 
else 
{
    header('Location: ../index.php');
}
?>