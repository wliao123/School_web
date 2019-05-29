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
            <a href="http://weblab.salemstate.edu/~capstonesignup/student/myproject.php" class="nav-link active">My Project</a>
          </li>
          <li class="nav-item px-2">
            <a href="http://weblab.salemstate.edu/~capstonesignup/student/all_project.php" class="nav-link">All Projects</a>
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
          <h1><i class="fa fa-folder"></i> My Project</h1>
        </div>
      </div>
    </div>
  </header>   
             
     <hr>
        <?php   
           
           $query1 = "SELECT assign.Student_id FROM assign WHERE assign.Student_id = '{$_SESSION['user_id']}'";
           $result = mysqli_query($connection,$query1);

           
               while ($row = $result->fetch_assoc()) {
                 
                  $exists = $row['Student_id'];
    }
  
           if(!$exists > 0) {
               
               echo "<center> <h1 class='text-danger'>You have not signed up yet. </h1></center> ";         echo "<br>";
           }           

           ?>
   
    
   <!-- Page Content -->
    <div class="container">

      

              <?php 
            if(isset($_GET['source'])){
                
              $source = $_GET['source'];
                
            }else{
                
                $source = '';
            }
            
            switch($source){
                    
                    case 'edit_project';
                    include "includes/edit_project.php";
                    break;

                default:
                    
                    include "includes/view_my_project.php";
                    
                    break;          
            }
            
            
            ?>
       
       
       
        <hr>

        <!-- Footer -->
    
        <?php 

        include "includes/s_footer.php";

        ?>
