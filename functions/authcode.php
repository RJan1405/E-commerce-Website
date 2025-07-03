<?php
session_start();
// Initialize the database connection
$host = "127.0.0.1";
$username = "root";
$password = " ";
$dbname = "mydb";

// Create the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// my functions is not includes
include('myfunctions.php');

// Form submission
if (isset($_POST['register_btn'])) {
    // Get the form data
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];
    $phone=$_POST['phone'];
    $Ccode=$_POST['countryCode'];

    // Validate the form data
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['alert']="Please fill out all fields";
        header('Location:../register.php');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['alert']="Invalid Credentials";
        header('Location:../register.php');
    } elseif ($password !== $confirm_password) {
        $_SESSION['alert']="Passwords do not match";
        header('Location:../register.php');
    } else {
        // Insert the user data into the database
        $query = "INSERT INTO users (username, email,phone,password,countrycode) VALUES ('$username', '$email', '$phone','$password','$Ccode')";
        $result = $conn->query($query);

        if ($result) {
            $_SESSION['alert']="Registeration Successfully done!";
            header("Location: ../login.php");
            exit;
        } else {
            $_SESSION['alert']="Error inserting data into the database";
            header('Location:../register.php');
        }
    }
}

else if(isset($_POST['login_btn']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];


    $login_query="SELECT * from users WHERE email='$email' AND password='$password' ";
    $login_query_run=$conn->query($login_query);
    if(mysqli_num_rows($login_query_run)>0){
        $_SESSION['auth']=true;

        $userdata=mysqli_fetch_array($login_query_run);
        $userid=$userdata['id'];
        $username=$userdata['name'];
        $useremail=$userdata['email'];
        $role_as=$userdata['role_as'];


        $_SESSION['auth_user']=[
            'user_id'=>$userid,
            'name'=>$username,
            'email'=>$useremail
        ];

        $_SESSION['role_as']=$role_as;
        if($role_as == 1)
        {
            $_SESSION['alert']="Welcome to Dashboard";
            header('Location:../admin/index.php');
    
        }

        else
        {
            $_SESSION['alert']="Logged in successfully";
             header('Location:../index.php');


        }

        
    }
    else{
        $_SESSION['alert']="Invalid Credentials";
        header('Location:../login.php');
    }
}

// Display the registration form
?>



<?php
if (isset($error)) {
    echo "<p>$error</p>";
}
?>