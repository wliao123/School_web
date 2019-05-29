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

           
           
            <!-- Blog Entries Column -->
                        <div class="col-xs-6">
                          
                        <h4>My Advisees</h4>

                            <table class="table table-bordered table-hover">
                                <thread>
                                    <tr>
                                        <th>Student ID</th>
                                        <th> Name</th>
                                    </tr>
                                </thread>
                                <tbody>
                                
<?php //Find all students query

$query = "SELECT users.user_id, users.full_name FROM users,assign WHERE users.role = 'student' AND assign.advisor_id = '{$_SESSION['user_id']}' AND users.user_id = assign.Student_id";
$select_students = mysqli_query($connection,$query);
                                  
                                    
while($row = mysqli_fetch_assoc($select_students)){
$s_id = $row['user_id'];
$s_name = $row['full_name'];

   
echo "<tr>";
echo "<td>{$s_id}</td>";
echo "<td>{$s_name}</td>";
echo "<tr>";
}

?>
                      
                                </tbody>
                            </table>
                            
                            
                        </div>



       
       
        </div>
        <!-- /.row -->

        <hr>

       <!-- Footer -->

