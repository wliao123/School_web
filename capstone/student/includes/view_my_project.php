  <div class="row">
            
                                       <?php     //hide table if not sign up
           
           $query2 = "SELECT assign.Student_id FROM assign WHERE assign.Student_id = '{$_SESSION['user_id']}'";
           $result = mysqli_query($connection,$query2);
           
               while ($row = $result->fetch_assoc()) {

                  $exists = $row['Student_id'];
    }           
           
           if($exists > 0) {               
               
               echo "<br>";
                
                       
               echo "<div class='col-md-12'>";        //<div class="col-md-12">

               echo "<table class='table table-bordered table-hover'>";                            
               echo "<thead class='thead-inverse'>";                                 
                echo "<tr>";                                    

                echo "<th> Student </th>";                                
                echo "<th> Advisor </th>";                                        
                echo "<th style='width: 20%'>Project Title</th>";                               
                echo "<th style='width: 30%'>Description</th>";                               
                echo "<th>Course</th>";                               
                echo "<th>Presentation Time</th>";                                

                echo "</tr>";                            
                echo "</thead>";                                
                echo "<tbody>";                                
           }
                                ?>
                                
                                
<?php //Find all students query                                    
$query = "SELECT users.full_name FROM users WHERE users.user_id IN (SELECT present.presenter FROM present WHERE present.project_name = (SELECT assign.p_title FROM assign WHERE assign.Student_id = '{$_SESSION['user_id']}'))";

$query2 = "SELECT projects.P_name, projects.description, projects.course_type, projects.P_time FROM projects, present 
           WHERE present.presenter = '{$_SESSION['user_id']}' AND present.project_name = projects.P_name ";
                                    
$query3 = "SELECT assign.ad_fullname FROM assign WHERE assign.Student_id = '{$_SESSION['user_id']}' ";                                                                
$select_advisor = mysqli_query($connection,$query3);
$select_student = mysqli_query($connection,$query); 
$select_project = mysqli_query($connection,$query2);

                                    
while($row = mysqli_fetch_assoc($select_student)){

$stu_name = $row['full_name'];
$multi_name [] = $stu_name; 

$name_str = implode(',<br/>', $multi_name);

echo "<tr>";

}
echo "<td>{$name_str}</td>";

while($row = mysqli_fetch_assoc($select_advisor)){
$advisor = $row['ad_fullname'];
    
echo "<td>{$advisor}</td>";
}  
   
while($row = mysqli_fetch_assoc($select_project)){
$p_name = $row['P_name'];
$description = $row['description'];
$Course = $row['course_type'];
$present_time = $row['P_time'];
$p_name = str_replace("'","&#39;","$p_name");
$p_name = str_replace("\"","&#34;","$p_name");

echo "<td>{$p_name}</td>";
echo "<td>{$description}</td>";
echo "<td>{$Course}</td>";
echo "<td>{$present_time}</td>";
echo "<td><a href='http://weblab.salemstate.edu/~capstonesignup/student/myproject.php?source=edit_project&p_title={$p_name}'>Edit</a></td>";
echo "<td><a href='http://weblab.salemstate.edu/~capstonesignup/student/myproject.php?delete={$p_name}'>Cancel</a></td>";
echo "<tr>";
}
                                    
?>
                 
                 <?php 

        if(isset($_GET['delete'])){

            if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'student'){ 
            
            
            $the_p_name = $_GET['delete'];
            $the_p_name = addslashes($the_p_name);

                
            $query = "DELETE FROM assign WHERE assign.p_title = '{$the_p_name}'; ";
            $query .= "DELETE FROM present WHERE present.project_name= '{$the_p_name}'; "; 
            $query .= "DELETE FROM display_stu WHERE display_stu.p_title= '{$the_p_name}'; ";
            $query .= "UPDATE Set_times SET status = 'Available' WHERE title = '{$the_p_name}'; ";
            $query .= "UPDATE Set_times SET title = 'null' WHERE title = '{$the_p_name}'; ";
            $query .= "DELETE FROM projects WHERE projects.P_name= '{$the_p_name}'; ";

            $delete_query = mysqli_multi_query($connection,$query);
            
            if(!$delete_query){

            echo "<script type='text/javascript'>
       alert('$the_p_name');
    </script>";
            }
                else{
            header("Location: http://weblab.salemstate.edu/~capstonesignup/student/myproject.php");
                    
                    }
                }
            }
                
        }
            ?> 

                              
                              <?php      
                    echo "</tbody>";            
                     echo "</table>" ;      
                     echo "</div>" ;       
                            
                    
?>
       
       

       
       
        </div>
        <!-- /.row -->