                                  
                              <form action="" method="post">
                               <div class="form-group"> 
                                  <label for="dates">Edit the date</label>
                                  
                                   <?php

                                  if(isset($_GET['edit'])) {
                           
                            $dates = $_GET['edit'];
                                      
                                      
                                  
                                                                     
                            $query = "SELECT * FROM Set_date WHERE dates = $dates ";
                            $select_dates = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_dates)){
                            $dates = $row['dates'];
                               
                            ?>
                             <input value="<?php if(isset($dates)){echo $dates;} ?>" type = "text" class="form-control" name="dates" >
                            
                            
                    <?php   }} ?>
                        
                                  
                                                      
             <?php   ////////UPDATE Date query

                    
                    if(isset($_POST['update_date'])){

                        $the_date = $_POST['dates'];
                        $query = "UPDATE Set_date SET dates = '{$dates}' WHERE dates = '{$the_date}' ";
                        $update_query = mysqli_query($connection,$query);
                         
                       if(!$update_query){

                                    die("QUERY FAILED" . mysql_error($connection));
                                }
                       
                    }



                   ?>                
                               </div>
                         
                               <div class="form-group"> 
                                   <input class="btn btn-primary" type = "submit" name="update_date" value="Update">
                               </div>
                           </form>    
                                 