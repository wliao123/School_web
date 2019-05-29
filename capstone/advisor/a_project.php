<?php 

include "includes/a_header.php";

?>

<body>

    <!-- Navigation -->
    
        <?php 

        include "includes/a_navigation.php";

        ?>

           
   <!-- Page Content -->
    <div class="container">

        <div class="row">
            
                        <div class="col-md-12">
                        
                        <center><h1> My Advisee's Projects</h1></center>
                          <br>
                           
                            <table class="table table-bordered table-hover">
                                <thead class="thead-inverse">
                                    <tr>
                                        
                                        <th> Student </th>
                                        <th style="width: 20%">Project Title</th>
                                        <th style="width: 30%">Description</th>
                                        <th class="">Course</th>
                                        <th class="">Present Time</th> 
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                
<?php //Find all students query                                    


$query = " SELECT DISTINCT display_stu.student, projects.P_name, projects.description, projects.course_type,projects.P_time FROM assign, projects, display_stu WHERE assign.advisor_id = '{$_SESSION['user_id']}' AND assign.p_title = projects.P_name AND display_stu.p_title = projects.P_name"; 
                                                            
$select_project = mysqli_query($connection,$query); 

                                    
while($row = mysqli_fetch_assoc($select_project)){

$stu_name = $row['student'];
$p_name = $row['P_name'];
$description = $row['description'];
$Course = $row['course_type'];
$present_time = $row['P_time'];
$p_name = str_replace("'","&#39;","$p_name");
$p_name = str_replace("\"","&#34;","$p_name");

echo "<tr>";
echo "<td>{$stu_name}</td>";
echo "<td>{$p_name}</td>";
echo "<td>{$description}</td>";
echo "<td>{$Course}</td>";
echo "<td>{$present_time}</td>";

echo "<tr>";
}


?>
                 
                             
                              
                              
                              
                               
                                </tbody>
                            </table>                  
                            <br>
                            <br>
                        </div>


        </div>
    </div>
       
       
       
       
       
       
        <!-- /.row -->

        <hr>

       <!-- Footer -->

