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
          <li class="nav-item px-2">
            <a href="http://weblab.salemstate.edu/~capstonesignup/student/signup.php" class="nav-link active">SignUp</a>
          </li>
          <li class="nav-item px-2">
            <a href="http://weblab.salemstate.edu/~capstonesignup/student/myproject.php" class="nav-link">My Project</a>
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
          <h1><i class="fa fa-pencil"></i> Sign Up</h1>
        </div>
      </div>
    </div>
  </header>   
       
       <hr>
       <!-- body -->
    
        <?php 

        include "includes/signup_body.php";

        ?>
    

        <!-- Footer -->
    
        <?php 

        include "includes/s_footer.php";

        ?>






