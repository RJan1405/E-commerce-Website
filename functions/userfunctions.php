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





function getAllActive($tables)
{
    global $conn;
    $query = "SELECT * FROM $tables WHERE status='0' ";
    return $query_run = mysqli_query($conn, $query);
}


function getAllTrending()
{
    global $conn;
    $query = "SELECT * FROM products WHERE trending='1' ";
    return $query_run = mysqli_query($conn, $query);
}








function getIDActive($tables, $id)
{
    global $conn;
    $query = "SELECT * FROM $tables WHERE id='$id' AND status='0' ";
    return $query_run = mysqli_query($conn, $query);
}

function getSlugActive($tables, $slug)
{
    global $conn;
    $query = "SELECT * FROM $tables WHERE slug='$slug' AND status='0' LIMIT 1 ";
    return $query_run = mysqli_query($conn, $query);
}

function getProductByCategory($category_id)
{
    global $conn;
    $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0' ";
    return $query_run = mysqli_query($conn, $query);
}

function getCartItems()
{
    global $conn;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid , c.prod_id , c.prod_qty , p.id as pid , p.name , p.image , p.selling_price 
    FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC";
    return $query_run = mysqli_query($conn, $query);
}

function getOrders()
{
    global $conn;
    $userId=$_SESSION['auth_user']['user_id'];
    $query="SELECT * FROM orders WHERE user_id='$userId' ORDER BY id DESC";
    return $query_run=mysqli_query($conn,$query);
}

function yourDrives()
{
    global $conn;
    $userId=$_SESSION['auth_user']['user_id'];
    $query="SELECT * FROM bookings WHERE user_id='$userId' ORDER BY id DESC";
    return $query_run=mysqli_query($conn,$query);
}



function redirect($url, $alert)
{
    $_SESSION['alert'] = $alert;
    header('Location:' . $url);
    exit(0);
}

function checkTrackingNoValid($trackingNo)
{
    global $conn;

    $userId=$_SESSION['auth_user']['user_id'];

    $query="SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userId' ";
    return mysqli_query($conn,$query);
}

function checkTestDrive($trackingNo)
{
    global $conn;

    $userId=$_SESSION['auth_user']['user_id'];

    $query="SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userId' ";
    return mysqli_query($conn,$query);
}