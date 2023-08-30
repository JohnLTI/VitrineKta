<?php 
session_start();
if((isset ($_SESSION['email']) == true) and (isset ($_SESSION['senha']) == true))
{
    session_destroy();
    header('location:../site/index.php');
}
?>