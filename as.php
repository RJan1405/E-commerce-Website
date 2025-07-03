
<?php

if (isset($_POST['login_btn'])) {


    $email = $_POST['email'];
    $password = $_POST['password'];


    $login_query = "SELECT * from users WHERE email='$email' AND password='$password' ";
    $login_query_run = mysqli_query($conn,$login_query);
    if (mysqli_num_rows($login_query_run) > 0) {

        $_SESSION['alert'] = "Welcome to Dashboard";
        header('Location:../admin/index.php');
    }
}




?>

