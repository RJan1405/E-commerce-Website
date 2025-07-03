<?php
include('../functions/myfunctions.php');
if(isset($_SESSION['auth']))
{
    if($_SESSION['role_as']!=1)
    {
        $_SESSION['alert']="You are not authorized to acess this page";
        header('Location:../index.php');

       
    }

}
else
{
    $_SESSION['alert']="Login to continue";
    header('Location:../login.php');
    
}

?>