<?php ob_start(); ?>
<?php  include "../include/db.php" ?>
<?php session_start();?>
<?php 

if(!isset($_SESSION['user_role'])){
       
   header ("Location: ../index.php");    
        
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Salem States CSC Capstone</title>

    <!-- Bootstrap Core CSS -->
    <link href="http://weblab.salemstate.edu/~capstonesignup/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://weblab.salemstate.edu/~capstonesignup/css/blog-home.css" rel="stylesheet">
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   


</head>