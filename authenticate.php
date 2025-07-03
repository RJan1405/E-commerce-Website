<?php

if(!isset($_SESSION['auth'])){
    header('Location:login.php');
    $_SESSION['alert']="Login to continue";
}



?>