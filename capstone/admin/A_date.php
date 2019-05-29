<?php 

include "includes/A_header.php";

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        

       <?php 

include "includes/A_navigation.php";

?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Please specify the presentation date
                            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-fw fa-wrench"></i> Settings
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-table"></i> Presentation Date
                            </li>
                        </ol>
                        
                        <div class="col-xs-4">
                          
                        <?php
                        if(isset($_POST['submit'])){
                            
                            $dates = $_POST['dates'];

                            
                            if(empty($dates)){
                                
                                $message = "The fields should not be empty!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                                
                            }else{
                                
                                $query  = "DELETE FROM Set_date; ";
                                $query .= "INSERT INTO Set_date(dates) ";
                                $query .= "VALUE('{$dates}') ";
                                
                                $create_dates = mysqli_multi_query($connection, $query);
                                header("Location: http://weblab.salemstate.edu/~capstonesignup/admin/A_date.php");
                                if(!$create_dates){
                                    
                                    echo "Adding dates faild, please check the format.";
                                    die('QUERY FAILED' . mysql_error($connection));
                                }
                                
                            }
                            
                        }
                            
                            ?>

                           <form action="" method="post">
                               <div class="form-group"> 
                                  <label for="dates">Date</label>
                                   
                                   <input id="date" class="form-control" name="dates" type="date">
                               </div>
                               

                               <div class="form-group"> 
                                   <input class="btn btn-primary" type = "submit" name="submit" value="Update">
                               </div>
                           </form>        
                                  
                                 
                                 
                            
                                  
                                   
                        </div><!--Add Student Form-->
                        
                        <div class="col-xs-6">
                          


                            <table class="table table-bordered table-hover">
                                <thread>
                                    <tr>
                                        <th>Presentation Date</th>

                                    </tr>
                                </thread>
                                <tbody>
                                
<?php //Find all students query

$query = "SELECT * FROM Set_date";
$select_dates = mysqli_query($connection,$query);
                                  
                                    
while($row = mysqli_fetch_assoc($select_dates)){
$dates = $row['dates'];

   
echo "<tr>";
echo "<td>{$dates}</td>";
echo "<tr>";
}

?>

                               
                               
                               
                                </tbody>
                            </table>
                            
                            
                        </div>
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/bootstrap.min.js"></script>

</body>

</html>
