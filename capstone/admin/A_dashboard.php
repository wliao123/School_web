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

                   
       <div class="container">

                   <br>
                      <center> <h1> Computer Science Capstone Project Sign Up Information</h1></center>
                       <br>
                       <br>
                       <br>
                              
                    <?php  //print student number
    
$query = "SELECT COUNT(users.role) AS stu_num FROM users WHERE users.role = 'student'";
$student = mysqli_query($connection,$query);

      
    echo "<h2>Number of Students: ";
            
           
    while ($row = $student->fetch_assoc()) {

                  
                  $stu_num = $row['stu_num'];
                  echo "<a href='http://weblab.salemstate.edu/~capstonesignup/admin/A_student.php'>".$stu_num."</a>";
    
    }
        echo "</h2>";
    ?>
                          
                                <?php  //print project number
    
$query = "SELECT COUNT(projects.P_name) AS project_num FROM projects;";
$project = mysqli_query($connection,$query);

      
    echo "<h2>Number of Projects: ";
            
           
    while ($row = $project->fetch_assoc()) {

                  
                  $project_num = $row['project_num'];
         echo "<a href='http://weblab.salemstate.edu/~capstonesignup/admin/A_capstone.php'>".$project_num."</a>";
    
    }
        echo "</h2>";
    ?>

     
                         <?php  //print Time slots number
    
$query = "SELECT COUNT(Set_times.times) AS slots_num FROM Set_times;";
$time_slots = mysqli_query($connection,$query);

      
    echo "<h2>Number of Time Slots: ";
            
           
    while ($row = $time_slots->fetch_assoc()) {

                  
                  $slots_num = $row['slots_num'];
        echo "<a href='http://weblab.salemstate.edu/~capstonesignup/admin/A_time.php'>".$slots_num."</a>";
    
    }
        echo "</h2>";
    ?>
    
                             <?php  //print Advisor number
    
$query = "SELECT COUNT(users.role) AS adv_num FROM users WHERE users.role = 'advisor'";
$advisor = mysqli_query($connection,$query);

      
    echo "<h2>Number of Advisors: ";
            
           
    while ($row = $advisor->fetch_assoc()) {

                  
                  $adv_num = $row['adv_num'];
    
        echo "<a href='http://weblab.salemstate.edu/~capstonesignup/admin/A_advisor.php'>".$adv_num."</a>";
    
    }
        echo "</h2>";
    ?>

              
       
              <br>              
              <br>
              <br>              
              <br>
              <br>

                     </div>  
                        
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
