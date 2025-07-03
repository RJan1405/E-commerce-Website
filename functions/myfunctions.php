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

function getAll($tables){
    global $conn;
    $query="SELECT * FROM $tables";
   return $query_run=mysqli_query($conn,$query);

}




function getByID($tables,$id){
    global $conn;
    $query="SELECT * FROM $tables WHERE id='$id' ";
   return $query_run=mysqli_query($conn,$query);

}









//my functions is not included
function redirect($url,$alert)
{
    $_SESSION['alert']=$alert;
    header('Location:'.$url);
    exit();
}




function getAllOrders(){
    global $conn;
    $query="SELECT *  FROM  orders WHERE status='0' ";
   return $query_run=mysqli_query($conn,$query);

}

function checkTrackingNoValid($trackingNo)
{
    global $conn;


    $query="SELECT * FROM orders WHERE tracking_no='$trackingNo' ";
    return mysqli_query($conn,$query);
}


function getOrderHistory(){
    global $conn;
    $query="SELECT *  FROM  orders WHERE status !='0' ";
   return $query_run=mysqli_query($conn,$query);

}







//categories fetch


?>
