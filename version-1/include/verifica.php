<?php
session_start();
if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
  unset($_SESSION['clogin']);
  unset($_SESSION['csenha']);
  header('location:../entrar.php');
  }
?>  