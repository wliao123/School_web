<?php include "includes/S_header.php";?>

<body>
    <!-- Navigation -->
    
        <?php include "includes/S_navigation.php"; ?>
        
        
    <!-- Page Content -->
    <div class="container">
        <div class="row">
           
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <!-- php here////////// -->
                
             <?php 
      if(isset($_POST['submit'])){

        
        $stu2 = $_POST['student2'];
        $stu3 = $_POST['student3'];
        $title = $_POST['title'];
        $type = $_POST['courseType'];
        $time = $_POST['times'];
        $advisor = $_POST['advisors'];
        $descri = $_POST['description'];
          
        if( empty($type) || empty($time) 

          || empty($descri)  || empty($title)         
           
          ){

            echo "<script type='text/javascript'>
       alert('Please fill out all the fields! (ノ｀Д´)ノ');
    </script>";

        }else if( !empty($type) && !empty($time) 

          && !empty($descri)  && !empty($title) && empty($stu2) && empty($stu3)) {

            //$_SESSION['user_id']

            $query = "INSERT INTO projects(P_name, description, course_type, P_time) ";
            $query .= "SELECT * FROM (SELECT '{$title}','{$descri}','{$type}','{$time}') AS tmp ";
            $query .= "WHERE NOT EXISTS ( ";
            $query .= "
            SELECT present.presenter FROM present WHERE present.presenter = '{$_SESSION['user_id']}' 
            UNION  SELECT projects.P_name FROM projects WHERE projects.P_name = '{$title}' ";
            $query .= " ) LIMIT 1; ";
            
            $query3 = "INSERT INTO title_check(title) ";
            $query3 .= "SELECT * FROM (SELECT '{$title}') AS t ";
            $query3 .= "WHERE NOT EXISTS ( ";
            $query3 .= "
            SELECT present.presenter FROM present WHERE present.presenter = '{$_SESSION['user_id']}' ";
            $query3 .= " ) LIMIT 1; ";
            
            
            $query2 = "INSERT INTO present(presenter, project_name) VALUE ('{$_SESSION['user_id']}','{$title}'); ";  
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$_SESSION['user_id']}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            $query2 .= "UPDATE Set_times SET status = 'Unavailable' WHERE times = '{$time}'; ";
            $query2 .= "UPDATE Set_times SET title = '{$title}' WHERE times = '{$time}'; ";
            
            $project_query = mysqli_multi_query($connection, $query);
            $project_query3 = mysqli_multi_query($connection, $query3);
            $project_query2 = mysqli_multi_query($connection, $query2);

            
            if(!$project_query2 || !$project_query3){
                $message = "Signup failed, you or your teammate may have already signup,please check the format .\\nTry again.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                die('QUERY FAILED' . mysql_error($connection));
               
            }else{
                
                header("Location: http://weblab.salemstate.edu/~S0297324/capstone/students/myproject.php");
                 
            }
        
        
        
        
        }
    
    }      
         ?>      
          
           
                <!-- beginning of the form  ///////////////////////////////////////////// -->
                
                <form action="#" method="post">
                
                <h4 class="page-header">

                Please fill out the following form
                </h4> 
  
  <div class="form-group">
    <label for="student2">Team member ID 1</label>
    <input type="text" class="form-control" class="border border-dark" name="student2" >
    <small id="inform" class="form-text text-muted">If you have teammates, please enter their SID below.</small>
  </div>
   
    <div class="form-group">
    <label for="student3">Team member ID 2</label>
    <input type="text" class="form-control" name="student3" >
  </div>

    <div class="form-group">
    <label for="title">Project Title</label>
    <input type="text" class="form-control" name="title" >
  </div>



  <div class="form-group">
    <label for="courseType">Course Type</label>
    <select class="form-control" name="courseType" name="course_type">
    
     <option value="Capstone"> </option>
      <option>CSC 520</option>
      <option>CSC 521</option>
      
      
    </select>
  </div>
  
  

  <div class="form-group">
    <label for="timeSlots">Present Time</label>
   
<?php     
$query = "SELECT * FROM Set_times WHERE Set_times.status = 'Available' ";
$result = mysqli_query($connection,$query);
$line0 = $row[''];
    echo "<select class='form-control' name='times'>";
      echo '<option>'.$line0.'</option>';
    while ($row = $result->fetch_assoc()) {

                  unset($times);
                  $times = $row['times'];
                   
                  echo '<option>'.$times.'</option>';
                 
}
    echo "</select>";
?> 
  </div>
  
  
  <div class="form-group">
    <label for="timeSlots">Advisor</label>
   
<?php     
$query = "SELECT users.full_name FROM users WHERE users.role = 'advisor'";
$result = mysqli_query($connection,$query);
$line1 = $row[''];
      
    echo "<select class='form-control' name='advisors'>";
            echo '<option>'.$line1.'</option>';
    while ($row = $result->fetch_assoc()) {

                  unset($full_name);
                  $full_name = $row['full_name'];
                  echo '<option>'.$full_name.'</option>';
                 
}
    echo "</select>";
?> 
  </div>
  
  
  <div class="form-group">
    <label for="description">Project Description</label>
    <textarea class="form-control" name="description" rows="7"></textarea>
  </div>
  
<div class="form-group"> 
<input class="btn btn-primary" type = "submit" name="submit" value="submit">
</div>


</form>

                <hr>

            </div>
            
       
        <!-- End of the form  ///////////////////////////////////////////// -->    

        </div>
        <!-- /.row -->

        <hr>
         
       <!-- Footer -->

