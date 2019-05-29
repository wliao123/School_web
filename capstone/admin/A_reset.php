<?php 

include "includes/A_header.php";

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        

       <?php 

include "includes/A_navigation.php";

?>
 
           
           
            <!--           content-->
                    <div id="page-wrapper">

                        <div class="container-fluid">


            <!--           table start ----------------------------------------------->
              
   <!-- Page Content -->
    <div class="container">

        <div class="row">

           
           
            <!-- Blog Entries Column -->
            <div>

               <center> <h1 class="page-header">Reset</h1></center>

          
          <br>
          
           <!-- Page Content -->

              <br>
              <br>
              
             <!--           table end -----------------------------------------------> 
 <center>
               <div>    
               
               <?php
if(isset($_POST['delete'])){

    if(isset($_SESSION['user_role'])){
    
        if($_SESSION['user_role'] == 'admin'){ 
            
            $query = "DELETE FROM assign; ";
            $query .= "DELETE FROM present; ";
            $query .= "DELETE FROM display_stu; ";
            $query .= "DELETE FROM Set_times; ";
            $query .= "DELETE FROM projects; ";
            $delete_query = mysqli_multi_query($connection,$query);
    if($delete_query){
        
       echo "<script type='text/javascript'>
       alert('Remove projects successful! ');
    </script>";
                }    
      
        }
    }
        
}
    ?>
               
                       <form action="" method="post">
                              
                               <div class="form-group" > 
                                  <input class="btn btn-warning" type = "submit" name="delete" value="Remove Projects">
                                 
                               </div>
                               <div class="form-group" > 
                                  <h4>(Remove all the projects and time slots)</h4>
                               </div>
                           </form>        
                        
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                                       <?php
if(isset($_POST['delete_all'])){

    if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role'] == 'admin'){ 
    
            $query = "DELETE FROM assign; ";
            $query .= "DELETE FROM present; ";
            $query .= "DELETE FROM display_stu; ";
            $query .= "DELETE FROM Set_times; ";
            $query .= "DELETE FROM projects; ";
            $query .= "DELETE FROM email; ";
            $query .= "DELETE FROM users; ";
            $delete_all_query = mysqli_multi_query($connection,$query);
               if($delete_all_query){
        
       echo "<script type='text/javascript'>
       alert('Remove all the data successful! ');
    </script>";
            }    
        }
    }

}
    ?>
               
                       <form action="" method="post">
                              
                               <div class="form-group" > 
                                  <input class="btn btn-danger" type = "submit" name="delete_all" value="DELETE ALL">
                                 
                               </div>
                               <div class="form-group" > 
                                  <h4>(Remove All the information... All!)</h4>
                               </div>
                           </form>        
                        
                        
                        
                        
                        <br>
                        <br>
                        
                        
                        
                        
                        
                        
                        
                </div>  
                
                 </center>             
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- jQuery -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/bootstrap.min.js"></script>

</body>

</html>
