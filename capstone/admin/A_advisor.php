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
                            Please Specify
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-user"></i> Manage Users
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i><a href="http://weblab.salemstate.edu/~capstonesignup/admin/A_advisor.php"> Advisors</a>
                            </li>
                        </ol>
                        
                        <div class="col-xs-4">
                          
<?php
if(isset($_POST['submit'])){

    $f_id = $_POST['F_ID'];
    $f_fname = $_POST['F_fname'];
    $f_lname = $_POST['F_lname'];
    $f_email = $_POST['F_email'];

    if(empty($f_id) || empty($f_fname) || empty($f_lname) || empty($f_email) ){

        $message = "The fields should not be empty!";
                echo "<script type='text/javascript'>alert('$message');</script>";

    }else{

        $query = "INSERT INTO users(user_id,first_name,last_name,full_name,role,username,password) ";
        $query .= "VALUE('{$f_id}','{$f_fname}','{$f_lname}','{$f_fname} {$f_lname}','advisor','{$f_lname}','{$f_id}'); ";
        $query .= "INSERT INTO email(advisor_id,a_email) VALUE('{$f_id}', '$f_email') ";

        $create_advisor_query = mysqli_multi_query($connection, $query);
        
        if($create_advisor_query){
             header("Location: http://weblab.salemstate.edu/~capstonesignup/admin/A_advisor.php");
        }
        
        else{
 echo "<script type='text/javascript'>
       alert('Adding advisor failed, please check the format. ');
    </script>";
            
        }
        
    }

}
    ?>

                          
                          
                          
                           <form action="" method="post">
                               <div class="form-group"> 
                                  <label for="cat-title">Advisor ID</label>
                                   <input type = "text" class="form-control" name="F_ID"  onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')"  placeholder="">
                               </div>
                                <div class="form-group"> 
                                  <label for="cat-title">First Name</label>
                                   <input type = "text" class="form-control" onkeyup="value=value.replace(/[^a-zA-Z]/g,'')" name="F_fname"  >
                               </div>
                                <div class="form-group"> 
                                  <label for="cat-title">Last Name</label>
                                   <input type = "text" class="form-control" onkeyup="value=value.replace(/[^a-zA-Z]/g,'')" name="F_lname"   >
                               </div>
                               <div class="form-group"> 
                                  <label for="cat-title">Email</label>
                                   <input type = "email" class="form-control" name="F_email"  >
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
                                        <th>Advisor ID</th>
                                        <th> Name </th>
                                        <th>Email</th>
                                    </tr>
                                </thread>
                                <tbody>
                                
<?php //Find all students query

$query = "SELECT email.a_email,users.user_id, users.full_name FROM users,email WHERE users.role ='advisor'";
$query .= " AND email.advisor_id = users.user_id ";
$select_advisors = mysqli_query($connection,$query);
                                  
                                    
while($row = mysqli_fetch_assoc($select_advisors)){
$f_id = $row['user_id'];
$f_name = $row['full_name'];
$f_email = $row['a_email'];

   
echo "<tr>";
echo "<td>{$f_id}</td>";
echo "<td>{$f_name}</td>";
echo "<td>{$f_email}</td>";
echo "<td><a href='http://weblab.salemstate.edu/~capstonesignup/admin/A_advisor.php?delete={$f_id}'>Delete</a></td>";
echo "<tr>";
}

?>
                   <?php 
                    
                    if(isset($_GET['delete'])){
                            
                        if(isset($_SESSION['user_role'])){
                            if($_SESSION['user_role'] == 'admin'){ 
                        
                        
                        $the_f_id = mysqli_real_escape_string($connection, $_GET['delete']);
                        $query = "DELETE FROM email WHERE email.advisor_id = '{$the_f_id}'; ";
                        $query .= "DELETE FROM users WHERE users.user_id = '{$the_f_id}'; ";
                        
                        $delete_query = mysqli_multi_query($connection,$query);
                        
     
            header("Location: http://weblab.salemstate.edu/~capstonesignup/admin/A_advisor.php");
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
