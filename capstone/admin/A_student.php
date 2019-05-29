<?php 

include "includes/A_header.php";

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        

       <?php 

include "includes/A_navigation.php";

?>
 
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Please specify
                            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-user"></i> Manage Users
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i><a href="http://weblab.salemstate.edu/~capstonesignup/admin/A_student.php"> Students</a>
                            </li>

                        </ol>
                        
                        <div class="col-xs-4">
                          
<?php
if(isset($_POST['submit'])){

    $s_id = $_POST['S_ID'];
    $s_fname = $_POST['S_fname'];
    $s_lname = $_POST['S_lname'];

    if(empty($s_id) || empty($s_fname) || empty($s_lname)  ){

        $message = "The fields should not be empty!";
                echo "<script type='text/javascript'>alert('$message');</script>";

    }else{

        $query = "INSERT INTO users(user_id,first_name,last_name,full_name,role,username,password) ";
        $query .= "VALUE('{$s_id}','{$s_fname}','{$s_lname}','{$s_fname} {$s_lname}','student','{$s_lname}','{$s_id}') ";

        $create_student_query = mysqli_query($connection, $query);

        if(!$create_student_query){

            echo "<script type='text/javascript'>
       alert('Adding student failed, please check the format. ');
    </script>";
        }

    }

}
    ?>
                          
                          
                          
                          
                           <form action="" method="post">
                               <div class="form-group"> 
                                  <label for="cat-title">Student ID</label>
                                   <input type = "text" class="form-control" name="S_ID"                              onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')"  placeholder="Student ID">
                               </div>
                                <div class="form-group"> 
                                  <label for="cat-title">First Name</label>
                                   <input type = "text" onkeyup="value=value.replace(/[^a-zA-Z]/g,'')" class="form-control" name="S_fname">
                               </div>
                                <div class="form-group"> 
                                  <label for="cat-title">Last Name</label>
                                   <input type = "text" onkeyup="value=value.replace(/[^a-zA-Z]/g,'')" class="form-control" name="S_lname"  >
                               </div>
                               <div class="form-group"> 
                                   <input class="btn btn-primary" type = "submit" name="submit" value="Add">
                               </div>
                           </form>               
                        </div><!--Add Student Form-->
                        
                        <div class="col-xs-6">
                          


                            <table class="table table-bordered table-hover">
                                <thread>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student</th>
                                    </tr>
                                </thread>
                                <tbody>
                                
<?php //Find all students query

$query = "SELECT users.user_id, users.full_name FROM users WHERE users.role = 'student'";
$select_students = mysqli_query($connection,$query);
                                  
                                    
while($row = mysqli_fetch_assoc($select_students)){
$s_id = $row['user_id'];
$s_name = $row['full_name'];
   
echo "<tr>";
echo "<td>{$s_id}</td>";
echo "<td>{$s_name}</td>";
echo "<td><a href='http://weblab.salemstate.edu/~capstonesignup/admin/A_student.php?delete={$s_id}'>Delete</a></td>";
echo "<tr>";
}

?>
                   <?php 
                    
                    if(isset($_GET['delete'])){

                          if(isset($_SESSION['user_role'])){
                            if($_SESSION['user_role'] == 'admin'){ 
                        
                        
                        $the_s_id = mysqli_real_escape_string($connection, $_GET['delete']);
                        $query = "DELETE FROM users WHERE users.user_id = '{$the_s_id}' ";
                        $delete_query = mysqli_query($connection,$query);
                        header("Location: http://weblab.salemstate.edu/~capstonesignup/admin/A_student.php");
                                
                            }
                          }
                    }
                        ?>

                               
                                </tbody>
                            </table>
                            
                            
                        </div>
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/bootstrap.min.js"></script>

</body>

</html>
