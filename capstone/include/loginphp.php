<?php include "db.php";  ?>
<?php session_start();  ?>

<?php

if(isset($_POST['login'])){
    
  
$username = $_POST['username'];
$password = $_POST['password'];   
   
$username = mysqli_real_escape_string($connection, $username);   
$password = mysqli_real_escape_string($connection, $password);   
    
$query = " SELECT * FROM users WHERE password = '{$password}'";
$select_user_query = mysqli_query($connection,$query);
if(!$select_user_query) {
    
    die("QUERY FAILED". mysqli_error($connection));

}   

    while($row = mysqli_fetch_array($select_user_query)) {
        
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['password'];
        $db_user_firstname = $row['first_name'];
        $db_user_lastname = $row['last_name'];
        $db_user_role = $row['role'];
    }
    
    if($password === $db_password && $username === $db_username && $db_user_role ==="admin"){
        
        $_SESSION['user_id'] = $db_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        
        header("Location: ../admin/A_dashboard.php");
    }elseif($password === $db_password && $username === $db_username && $db_user_role ==="student"){
        
        $_SESSION['user_id'] = $db_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        
        header("Location: ../student/student.php");
    }elseif($password === $db_password && $username === $db_username && $db_user_role ==="advisor"){
        
        $_SESSION['user_id'] = $db_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        
        header("Location: ../advisor/advisor.php");
    }else{
        
        header ("Location: ../index.php");
    }
          
    
}



?>










