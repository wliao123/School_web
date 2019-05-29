<?php 

include "includes/S_header.php";

?>

<body>

    <!-- Navigation -->
    
        <?php 

        include "includes/S_navigation.php";

        ?>
        
        
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            
                        <div class="col-xs-12">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> ID</th>
                                        <th> Name </th>
                                        <th>Advisor</th>
                                        <th class="col-xs-3">Project Title</th>
                                        <th class="col-xs-3">Description</th>
                                        <th class="col-xs-1">Course</th>
                                        <th class="col-xs-2">Present Time</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                
<?php //Find all students query                                    
$query = "SELECT users.user_id, users.full_name FROM users,present WHERE users.user_id = '{$_SESSION['user_id']}' AND present.presenter = '{$_SESSION['user_id']}'";

$query2 = "SELECT projects.P_name, projects.description, projects.course_type, projects.P_time FROM projects, present 
           WHERE present.presenter = '{$_SESSION['user_id']}' AND present.project_name = projects.P_name ";
                                    
$query3 = "SELECT assign.ad_fullname FROM assign WHERE assign.Student_id = '{$_SESSION['user_id']}' ";                                                                

$select_student = mysqli_query($connection,$query); 
$select_project = mysqli_query($connection,$query2);
$select_advisor = mysqli_query($connection,$query3);
                                    
while($row = mysqli_fetch_assoc($select_student)){
$s_id = $row['user_id'];
$stu_name = $row['full_name'];
   
echo "<tr>";
echo "<td>{$s_id}</td>";
echo "<td>{$stu_name}</td>";

}

while($row = mysqli_fetch_assoc($select_advisor)){
$advisor = $row['ad_fullname'];
    
echo "<td>{$advisor}</td>";
}  
   
while($row = mysqli_fetch_assoc($select_project)){
$p_name = $row['P_name'];
$description = $row['description'];
$Course = $row['course_type'];
$present_time = $row['P_time'];


echo "<td>{$p_name}</td>";
echo "<td>{$description}</td>";
echo "<td>{$Course}</td>";
echo "<td>{$present_time}</td>";
echo "<td><a href='http://weblab.salemstate.edu/~S0297324/capstone/students/myproject.php?delete={$p_name}'>Delete</a></td>";
echo "<tr>";
}
                                    
                                    



                                    


?>
                 
                             <?php 
                    
                    if(isset($_GET['delete'])){

                        $the_p_name = $_GET['delete'];
                        $query = "DELETE FROM assign WHERE assign.p_title = '{$the_p_name}'; ";
                        $query .= " DELETE FROM present WHERE present.project_name= '{$the_p_name}'; ";
                        $query .= " DELETE FROM stu2 WHERE stu2.p_title= '{$the_p_name}'; ";
                        query .= " DELETE FROM stu3 WHERE stu3.p_title= '{$the_p_name}'; ";
                        $query .= " DELETE FROM projects WHERE projects.P_name= '{$the_p_name}'; ";
                        $query .= "UPDATE Set_times SET status = 'Available' WHERE title = '{$the_p_name}'; ";
                        $query .= "UPDATE Set_times SET title = 'null' WHERE title = '{$the_p_name}'; ";
                        
                        $delete_query = mysqli_multi_query($connection,$query);
                        header("Location: http://weblab.salemstate.edu/~S0297324/capstone/students/myproject.php");
                    }
                        ?> 
                              
                              
                              
                               
                                </tbody>
                            </table>
                            
                            
                        </div>



       
       
        </div>
        <!-- /.row -->

        <hr>

       <!-- Footer -->

