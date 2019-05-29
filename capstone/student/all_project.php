<?php 

include "includes/s_header.php";

?>

<body>

     <!-- Navigation -->
    
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="http://weblab.salemstate.edu/~capstonesignup/student/student.php" class="navbar-brand">Hi, <?php  echo $_SESSION['firstname']?></a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="http://weblab.salemstate.edu/~capstonesignup/student/student.php" class="nav-link ">Home</a>
          </li>
 <?php   
           
           $query1 = "SELECT assign.Student_id FROM assign WHERE assign.Student_id = '{$_SESSION['user_id']}'";
           $result = mysqli_query($connection,$query1);
           
               while ($row = $result->fetch_assoc()) {

                  $exists = $row['Student_id'];
    }           
           
           if(!$exists > 0) {               
               
               echo "<li class='nav-item px-2'>";
               echo " <a href='http://weblab.salemstate.edu/~capstonesignup/student/signup.php' class='nav-link'>SignUp</a>";
               echo "</li>";
           }
           ?>
          <li class="nav-item px-2">
            <a href="http://weblab.salemstate.edu/~capstonesignup/student/myproject.php" class="nav-link">My Project</a>
          </li>
          <li class="nav-item px-2">
            <a href="http://weblab.salemstate.edu/~capstonesignup/student/all_project.php" class="nav-link active">All Projects</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a href="http://weblab.salemstate.edu/~capstonesignup/include/logout.php" class="nav-link">
              <i class="fa fa-user-times"></i> Logout
            </a>
          </li>
          
          
        </ul>
      </div>
    </div>
  </nav>

    
    
    
     <!-- body -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-folder-open-o"></i> All Projects</h1>
        </div>
      </div>
    </div>
  </header>   
       
        <hr>
    
   <!-- Page Content -->
    <div class="container">

        <div class="row">
            
                        <div class="col-md-12">

                            <table class="table table-bordered table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        
                                        <th> Student(s) </th>
                                        <th>Advisor</th>
                                        <th style="width: 20%">Project Title</th>
                                        <th style="width: 30%">Description</th>
                                        <th class="">Course</th>
                                        <th>Presentation Time</th> 
                                        
                                    </tr>
                                </thead>
                                <tbody>

<?php     
$query = "SELECT DISTINCT display_stu.student, assign.ad_fullname, projects.P_name,projects.description,projects.course_type,projects.P_time FROM display_stu,users, assign, projects WHERE display_stu.p_title = projects.P_name AND assign.p_title = projects.P_name ORDER BY projects.P_time";
          
$result = mysqli_query($connection,$query);

    while ($row = $result->fetch_assoc()) {

//        unset($stu_name);
//        unset($advisor);
//        unset($title);
//        unset($descrip);
//        unset($descrip);
//        unset($time);
        $stu_name = $row['student'];
        $advisor = $row['ad_fullname'];
        $title = $row['P_name'];
        $descrip = $row['description'];
        $course = $row['course_type'];
        $time = $row['P_time'];
     

            echo "<tr>";
            echo "<td>{$stu_name}</td>";
            echo "<td>{$advisor}</td>";
            echo "<td>{$title}</td>";
            echo "<td>{$descrip}</td>";
            echo "<td>{$course}</td>";
            echo "<td>{$time}</td>";
            echo "<tr>";
}
    
?>   
                          
                                </tbody>
                            </table>
   
                        </div>
    
        </div>
        </div>
        <!-- /.row -->

        <hr>

  
  
 
  
 























        <!-- Footer -->
    
        <?php 

        include "includes/s_footer.php";

        ?>




 