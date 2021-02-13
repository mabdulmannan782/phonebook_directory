<?php 
require 'menu.php';
session_start();

if(isset($_SESSION['username'])){
  session_destroy();
  header('Location:login.php');
}

 ?>