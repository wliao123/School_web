<?php ob_start(); ?>
<?php  include "../include/db.php" ?>
<?php session_start();?>
<?php 

if(!isset($_SESSION['user_role'])){
       
header ("Location: ../login.php");    
        
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Salem States CSC Capstone</title>
  <link rel="stylesheet" href="http://weblab.salemstate.edu/~capstonesignup/student/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://weblab.salemstate.edu/~capstonesignup/student/css/bootstrap.css">
  <link rel="stylesheet" href="http://weblab.salemstate.edu/~capstonesignup/student/css/style.css">
  
  
  
</head>
