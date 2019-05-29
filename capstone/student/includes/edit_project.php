       <?php
       if(isset($_GET['p_title'])){
           
         $p_title = $_GET['p_title'];
           
          $p_title = addslashes($p_title);
           
           
       }


$query2 = "SELECT projects.P_name, projects.description, projects.course_type, projects.P_time FROM projects
WHERE projects.P_name = '{$p_title}'; ";
                                    
$query3 = "SELECT assign.ad_fullname FROM assign WHERE assign.p_title = '{$p_title}' ";                                                                
$select_advisor = mysqli_query($connection,$query3);
$select_project = mysqli_query($connection,$query2);


//

while($row = mysqli_fetch_assoc($select_advisor)){
$advisor = $row['ad_fullname'];

}  
   
while($row = mysqli_fetch_assoc($select_project)){
$p_name = $row['P_name'];
$description = $row['description'];
$Course = $row['course_type'];
$present_time = $row['P_time'];
               
}
          
         ?>    
               
               
                <?php 
      if(isset($_POST['update'])){

        $title0 = $_POST['title'];
        $type = $_POST['courseType'];
        $time = $_POST['times'];
        $advisor = $_POST['advisors'];
        $descri0 = $_POST['description'];
          
        $title = addslashes($title0);
        $descri = addslashes($descri0);
        $descri_check =str_word_count($descri,0);
            
          
          
          
          
          
        if( empty($type) || empty($time) 

          || empty($descri)  || empty($title) || empty($advisor)
           
          ){

            echo "<script type='text/javascript'>
       alert('Please fill out all the fields!');
    </script>";

        }else if( !empty($type) && !empty($time)   //1 team member signup------------------------------------------------

          && !empty($descri)  && !empty($title) && !empty($advisor) ) {

           if($descri_check < 65){
               
               echo "<script type='text/javascript'>
       alert('Project description is required to contain at least 65 words.');
    </script>";
           }else{

             $query = "UPDATE projects SET description = '{$descri}' WHERE P_name = '{$p_name}'; ";
            $query .= "UPDATE projects SET course_type = '{$type}' WHERE P_name = '{$p_name}'; ";
            $query .= "UPDATE projects SET P_time = '{$time}' WHERE P_name = '{$p_name}';";
            $query .= "UPDATE projects SET P_name = '{$title}' WHERE P_name = '{$p_name}'; ";
            $query .= "UPDATE assign SET advisor_id = (SELECT users.user_id FROM users WHERE users.full_name = '{$advisor}') WHERE p_title = '{$p_name}'; ";
            $query .= "UPDATE assign SET ad_fullname = '{$advisor}' WHERE p_title = '{$p_name}'; "; 
            $query .= "UPDATE assign SET p_title = '{$title}' WHERE assign.p_title = '{$p_name}'; ";       
            $query .= "UPDATE present SET project_name = '{$title}' WHERE project_name = '{$p_name}'; "; 
            $query .= "UPDATE display_stu SET p_title = '{$title}' WHERE display_stu.p_title = '{$p_name}'; ";
            $query .= "UPDATE Set_times SET status = 'Available' WHERE title = '{$p_name}'; ";
            $query .= "UPDATE Set_times SET title = 'null' WHERE title = '{$p_name}'; ";
            $query .= "UPDATE Set_times SET status = 'Unavailable' WHERE times = '{$time}'; ";
            $query .= "UPDATE Set_times SET title = '{$title}' WHERE times = '{$time}'; "; 

            
            $update_query = mysqli_multi_query($connection, $query);
            
            

               if(!$update_query){
                   
                    $message = "Update failed.\\n Please check.";
                echo "<script type='text/javascript'>alert('$message');</script>";
               }
               else{


 
                header("Location: http://weblab.salemstate.edu/~capstonesignup/student/student.php");
            }
                   
               
               
           }
        
        }       
               
          
    } //if POST END     
         ?>      
     
   
            <div class="col-md-8">  
               
                 
<form action="#" method="post">
                
<br>
  
    

    <div class="form-group">
    <label for="title">Project Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $p_name; ?>" >
  </div>


  <div class="form-group">
    <label for="courseType">Course Type</label>
    <select class="form-control" name="courseType"  >
    
     <option></option>
      <option <?php if($Course=='CSC 520') echo 'selected="selected"';?> >CSC 520</option>
      <option <?php if($Course=='CSC 521') echo 'selected="selected"';?> >CSC 521</option>
    
      
    </select>
  </div>

  <div class="form-group">
    <label for="timeSlots">Presentation Time</label>
   
<?php     
$query = "SELECT * FROM Set_times WHERE Set_times.status = 'Available' ";
$result = mysqli_query($connection,$query);
$line0 = $row[''];
    echo "<select class='form-control' name='times' value='$present_time'> ";
      echo '<option>'.$present_time.'</option>';
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
      
    echo "<select class='form-control' name='advisors' value='$advisor'>";
            echo '<option>'.$advisor.'</option>';
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
    <textarea class="form-control"  name="description" id="description" rows="7" placeholder="Minimum length requirement: 65 words." ><?php echo $description; ?></textarea>
  </div>
  
<div class="form-group"> 
<input class="btn btn-primary" type = "submit" name="update" value="Update">
</div>


</form>
</div>