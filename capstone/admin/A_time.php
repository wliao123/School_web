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
                            Please Specify
                            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-fw fa-wrench"></i> Settings
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Time Slots
                            </li>
                        </ol>
                        
                        <div class="col-xs-4">
                          
                      <?php
                        if(isset($_POST['set_time'])){
                            
                            $start_time = $_POST['start'];
                            $end_time = $_POST['end'];
                            $duration = $_POST['duration'];
                            $break = $_POST['break'];
                            
                            if(empty($start_time) || empty($end_time) || empty($duration) || empty($break)  ){
                                
                                echo "<script type='text/javascript'>
       alert('Please fill out all the fields! ');
    </script>";
                                
                            }else{
                                
                                $start = new DateTime($start_time);
                                $end = new DateTime($end_time);
                                $interval = new DateInterval("PT" . $duration. "M");
                                $breakInterval = new DateInterval("PT" . $break. "M");

                                for ($intStart = $start; 
                            $intStart < $end; 
                            $intStart->add($interval)->add($breakInterval)) {

                            $endPeriod = clone $intStart;
                            $endPeriod->add($interval);
                                if ($endPeriod > $end) {
                                    $endPeriod=$end;
                                }   
                                    $periods = $intStart->format('H:iA') . 
                                            ' - ' . 
                                        $endPeriod->format('H:iA');
                                    
                                    
                                    
                                                                    
                               $query = "INSERT INTO Set_times(times,status,title) ";
                                $query .= "VALUE('{$periods}', 'Available','null') ";
                                
                                $create_time_slots = mysqli_query($connection, $query);
                                
                                if(!$create_time_slots){
                                    
                                    echo "Adding slots faild, this will happened if the table has multiple duplicate slots, please check the format.";
                                    die('QUERY FAILED' . mysql_error($connection)); 
                                }
                                    
                                    
                            }


                                
                            }
                            
                        }
                            ?>
                            
                                              
                           <?php 
                    
                    if(isset($_GET['delete'])){

                        if(isset($_SESSION['user_role'])){
                            if($_SESSION['user_role'] == 'admin'){ 
                        
                        $the_time = mysqli_real_escape_string($connection, $_GET['delete']);
                        $query = "DELETE FROM Set_times WHERE times = '{$the_time}' ";
                        $delete_query = mysqli_query($connection,$query);
                        header("Location: http://weblab.salemstate.edu/~capstonesignup/admin/A_time.php");
                        
                            }
                        }
                    }
                            
                        ?>


                           <form action="" method="post">
                             
                             
                              <div class="form-group"> 
                                  <label for="timeslots">Start Time </label>
                                   <input type="text" name="start" class="time_element"/>
 
                               </div>
                              
                              <div class="form-group"> 
                                  <label for="timeslots">End Time </label>
                                   <input type="text" name="end" class="time_element"/>
 
                               </div>
                               
                               <div class="form-group" > 
                                  <label for="catdurationtitle">Duration</label>
                                  <br>
                                   <input type = "text" onkeyup="if(/\D/.test(this.value)){alert('you can only enter number in this field!!  ');this.value='';}" name="duration">
                                   <span class="infotext">Min</span>
                               </div>
                               
                               <div class="form-group"> 
                                  <label for="cat-break">Break</label>
                                  <br>
                                   <input type = "text" onkeyup="if(/\D/.test(this.value)){alert('you can only enter number in this field!!  ');this.value='';}"  name="break">
                                   <span class="infotext">Min</span>
                               </div>
                               
                               <div class="form-group"> 
                                   <input class="btn btn-primary" type = "submit" name="set_time" value="Create Slots">
                                   
                               </div>
                               
                                 <div class="form-group" method = "post"> 
                                   <input class="btn btn-primary" type = "submit" name="delete_all" value="Delete All Slots">

                               </div>
                           </form>               
                        </div><!--Add Student Form-->
                        
                        <div class="col-xs-6">
                          


                            <table class="table table-bordered table-hover">
                                <thread>
                                    <tr>
                                        <th>Time Slots</th>
                                        <th>Status</th>
                                    </tr>
                                </thread>
                                <tbody>
      
    <?php //Find all students query

$query = "SELECT * FROM Set_times WHERE Set_times.status = 'Unavailable' ORDER BY Set_times.times";
$select_times1 = mysqli_query($connection,$query);
                                  
                                    
while($row = mysqli_fetch_assoc($select_times1)){
$time_slot1 = $row['times'];
$status = $row['status'];
echo "<tr>";
echo "<td>{$time_slot1}</td>";
echo "<td>{$status}</td>";
echo "<tr>";
}

?>
                                  
                                                          
                                                                                                              
<?php //Find all students query

$query = "SELECT * FROM Set_times WHERE Set_times.status = 'Available' ORDER BY Set_times.times";
$select_times2 = mysqli_query($connection,$query);
                                  
                                    
while($row = mysqli_fetch_assoc($select_times2)){
$time_slot2 = $row['times'];
$status = $row['status'];

echo "<td>{$time_slot2}</td>";
echo "<td>{$status}</td>";
echo "<td><a href='http://weblab.salemstate.edu/~capstonesignup/admin/A_time.php?delete={$time_slot2}'>Delete</a></td>";
echo "<tr>";
}

?>
                 
                                </tbody>
                            </table>
                            
                     <?php 
                    
                    if(isset($_POST['delete_all'])){

                        
                        $query = "DELETE FROM Set_times";
                        $delete_all_query = mysqli_query($connection,$query);
                        header("Location: http://weblab.salemstate.edu/~capstonesignup/admin/A_time.php");
                    }
                        ?>
                            

                            
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



  <script src="js/jquery.js"></script>
<script src="js/timepicki.js"></script>
<script>
  $(document).ready(function(){
    $(".time_element").timepicki();
  });
</script>
  
  
   <!-- <script type="text/javascript" src="js/jquery.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="http://weblab.salemstate.edu/~capstonesignup/admin/js/bootstrap.min.js"></script>
                                       
                                    
                                    
                                    


</body>

</html>
