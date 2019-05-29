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

    <title>Salem states CSC capstone</title>

    <!-- Bootstrap Core CSS -->
    <link href="http://weblab.salemstate.edu/~capstonesignup/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://weblab.salemstate.edu/~capstonesignup/admin/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://weblab.salemstate.edu/~capstonesignup/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   <link rel="stylesheet" type="text/css" href="css/timepicki.css">


</head>