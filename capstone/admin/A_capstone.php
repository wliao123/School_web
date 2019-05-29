<?php 

include "includes/A_header.php";

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        

       <?php 

include "includes/A_navigation.php";

?>
 
           
           
            <!--           content-->
                    <div id="page-wrapper">

                        <div class="container-fluid">


            <!--           table start ----------------------------------------------->
              
   <!-- Page Content -->
    <div class="container">

        <div class="row">

           
           
            <!-- Blog Entries Column -->
            <div>

               <center> <h1 class="page-header">
                    All signed up Projects
                    
                   </h1></center>

          
          <br>
          
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

              <br>
              <br>
              <br>
              
             <!--           table end -----------------------------------------------> 
            
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
                            </div>
                        </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/bootstrap.min.js"></script>

</body>

</html>
