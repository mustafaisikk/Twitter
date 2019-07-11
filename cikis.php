<?php 

session_start();

setcookie('kid','son',time()-1);
session_destroy();
header("location:index.php");

 ?>