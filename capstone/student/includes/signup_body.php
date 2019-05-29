
          
   
   <!-- Page Content -->
    <div class="container">
        <div class="row">
           
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <!-- php here////////// -->
                
             <?php 
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
            require 'credential.php';
                
                
      if(isset($_POST['submit'])){

        
        $stu2 = $_POST['student2'];
        $stu3 = $_POST['student3'];
        $title0 = $_POST['title'];
        $type = $_POST['courseType'];
        $time = $_POST['times'];
        $advisor = $_POST['advisors'];
        $descri0 = $_POST['description'];
        $email = $_POST['email']; 
          
        $title = addslashes($title0);
        $descri = addslashes($descri0);
        $descri_check =str_word_count($descri,0);
            
          
        if( empty($type) || empty($time) 

          || empty($descri)  || empty($title) || empty($email) || empty($advisor)
           
          ){

            echo "<script type='text/javascript'>
       alert('Please fill out all the fields!');
    </script>";

        }else if( !empty($type) && !empty($time)   //1 team member signup------------------------------------------------

          && !empty($descri)  && !empty($title) && !empty($email) && empty($stu2) && empty($stu3)) {

           if($descri_check < 65){
               
               echo "<script type='text/javascript'>
       alert('Project description is required to contain at least 65 words.');
    </script>";
           }else{

            $query = "INSERT INTO projects(P_name, description, course_type, P_time) ";
            $query .= "SELECT * FROM (SELECT '{$title}','{$descri}','{$type}','{$time}') AS tmp ";
            $query .= "WHERE NOT EXISTS ( ";
        $query .= "
        SELECT present.presenter FROM present WHERE present.presenter = '{$_SESSION['user_id']}') ";
            
            
            $query2 = "INSERT INTO present(presenter, project_name) VALUE ('{$_SESSION['user_id']}','{$title}'); ";  
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$_SESSION['user_id']}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            $query2 .= "UPDATE Set_times SET status = 'Unavailable' WHERE times = '{$time}'; ";
            $query2 .= "UPDATE Set_times SET title = '{$title}' WHERE times = '{$time}'; ";
            $query2 .= "INSERT INTO  display_stu(student, p_title) VALUE ((SELECT users.full_name FROM users WHERE users.user_id = '{$_SESSION['user_id']}'), '{$title}');  ";
            
            $project_query = mysqli_multi_query($connection, $query);
            
            

               if(!$project_query){
                   
                    $message = "Your Project name is identify with an existing project name.\\n Please change.";
                echo "<script type='text/javascript'>alert('$message');</script>";
               }
               else{
                   
                   $project_query2 = mysqli_multi_query($connection, $query2);
                   
            if(!$project_query2 ){
                $message = "Signup failed: \\n-You or your teammate may have already signup. \\n-Team member ID not exist. \\nTry again.";
                echo "<script type='text/javascript'>alert('$message');</script>";
               
            }else{

                $email_query = "SELECT email.a_email FROM email, users WHERE email.advisor_id = users.user_id AND users.full_name = '{$advisor}'  And users.role = 'advisor'";
                $advisor_email = mysqli_query($connection,$email_query);

           
while($row = mysqli_fetch_assoc($advisor_email)){
                
                 $adv_email = $row['a_email']; 
}
$adv_email
//                    while ($row = $advisor_email->fetch_assoc()) {
//
//                            $adv_email = $row['a_email'];
//
//                    }

       
                
                // the message    
                
$msg =  
"{$_SESSION['firstname']} has signed up for capstone project presentation. 

The presentation is scheduled to take place during {$time} on the Presentation Day.

Good luck with the presentation.";                
                
/////////////////
                                

              $mail = new PHPMailer(true);  
              

    
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = EMAIL;                              // SMTP username
    $mail->Password = PASSWORD;                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ssutoolbox@gmail.com', 'Salem State University');
    $mail->addAddress($email);     // Add a recipient
    $mail->addAddress($adv_email);     // Add a recipient
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Computer Science Capstone Project Signup Comfirmation';
    $mail->Body    = $msg;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    

///////////////////

                header("Location: http://weblab.salemstate.edu/~capstonesignup/student/myproject.php");
            }
                   
               }
               
           }
        
        }else if( !empty($type) && !empty($time)  //2 team member signup  stu 3 empty---------------------------------------------

          && !empty($descri)  && !empty($title) && !empty($stu2) && !empty($email) && empty($stu3)) {

            if($descri_check < 65){
               
               echo "<script type='text/javascript'>
       alert('Project description is required to contain at least 65 words.');
    </script>";
           }else{
              
            
            $query = "INSERT INTO projects(P_name, description, course_type, P_time) ";
            $query .= "SELECT * FROM (SELECT '{$title}','{$descri}','{$type}','{$time}') AS tmp ";
            $query .= "WHERE NOT EXISTS ( ";
            $query .= "
            SELECT present.presenter FROM present WHERE present.presenter = '{$_SESSION['user_id']}' OR  present.presenter = '{$stu2}' ";
            $query .= " ) AND EXISTS (SELECT * FROM users WHERE users.user_id = '{$stu2}' ); ";
            
            
            $query2 = "INSERT INTO present(presenter, project_name) VALUE ('{$_SESSION['user_id']}','{$title}'); ";  
            $query2 .= "INSERT INTO present(presenter, project_name) VALUE ('{$stu2}','{$title}'); "; 
            
            
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$_SESSION['user_id']}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$stu2}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            $query2 .= " INSERT INTO stu2(stu2_id, p_title) VALUE('{$stu2}','{$title}')";
            
            
            $query2 .= "UPDATE Set_times SET status = 'Unavailable' WHERE times = '{$time}'; ";
            $query2 .= "UPDATE Set_times SET title = '{$title}' WHERE times = '{$time}'; ";         
            $query3 = "INSERT INTO display_stu(student, p_title) VALUE (CONCAT ((SELECT users.full_name FROM users WHERE users.user_id = '{$_SESSION['user_id']}'),', ',(SELECT users.full_name FROM users WHERE users.user_id = '{$stu2}')), '{$title}'); ";
            
                $project_query = mysqli_multi_query($connection, $query);
                
            if(!$project_query){
                
                $message = "Your Project name is identify with a existing project name.\\n Please change.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                
            }else{
                
                $project_query3 = mysqli_query($connection, $query3);
            $project_query2 = mysqli_multi_query($connection, $query2);
                
                
                if(!$project_query3){
                    $message = "query dis_stu failed. \\nTry again.";
                echo "<script type='text/javascript'>alert('{$_SESSION['user_id']}.{$title}');</script>";
                }
                elseif(!$project_query2){
                $message = "Signup failed: \\n-You or your teammate may have already signup. \\n-Team member ID not exist. \\nTry again.";
                echo "<script type='text/javascript'>alert('$message');</script>";
               
            }else{
 
                $query = "SELECT email.a_email FROM email WHERE email.advisor_id = 
          (SELECT users.user_id FROM users WHERE users.full_name = '{$advisor}')";
          $advisor_email = mysqli_query($connection,$query);

                // the message
$advisor_msg =
"Hi $advisor.
Your advisee {$_SESSION['firstname']} has scheduled his/her capstone presentaion during {$time} on the Reading Day. ";     
                
$stu_msg =  
"Hi {$_SESSION['firstname']}: Thank you for signing up to present your capstone project. 

You are scheduled to present during {$time} on the Reading Day

Good luck with your presentation.";

// send email
mail("$email","Computer Science Capstone Project Sign-Up Confirmation",$stu_msg,"noreply@salemstate.edu");
                      
mail("$advisor_email","Computer Science Capstone Project Sign-Up Confirmation",$advisor_msg,"noreply@salemstate.edu");
                
                 header("Location: http://weblab.salemstate.edu/~capstonesignup/student/myproject.php");
            }
             
                
            }
                          
                
            }
            
        }else if( !empty($type) && !empty($time) //3 team member signup----------------------------------------------

          && !empty($descri)  && !empty($title) && !empty($stu2) && !empty($stu3) && !empty($email)) {


            if($descri_check < 65){
               
               echo "<script type='text/javascript'>
       alert('Project description is required to contain at least 65 words.');
    </script>";
           }else{
            
            
                
            $query = "INSERT INTO projects(P_name, description, course_type, P_time) ";
            $query .= "SELECT * FROM (SELECT '{$title}','{$descri}','{$type}','{$time}') AS tmp ";
            $query .= "WHERE NOT EXISTS ( ";
            $query .= "
            SELECT present.presenter FROM present WHERE present.presenter = '{$_SESSION['user_id']}' OR  present.presenter = '{$stu2}' OR  present.presenter = '{$stu3}'";
            $query .= " ) AND EXISTS (SELECT * FROM users WHERE users.user_id = '{$stu2}' OR users.user_id = '{$stu3}'); ";
            
            
            $query2 = "INSERT INTO present(presenter, project_name) VALUE ('{$_SESSION['user_id']}','{$title}'); ";  
            $query2 .= "INSERT INTO present(presenter, project_name) VALUE ('{$stu2}','{$title}'); "; 
            $query2 .= "INSERT INTO present(presenter, project_name) VALUE ('{$stu3}','{$title}'); ";
            
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$_SESSION['user_id']}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$stu2}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$stu3}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            $query2 .= " INSERT INTO stu2(stu2_id, p_title) VALUE('{$stu2}','{$title}')";
            $query2 .= " INSERT INTO stu2(stu2_id, p_title) VALUE('{$stu3}','{$title}')";
            
            $query2 .= "UPDATE Set_times SET status = 'Unavailable' WHERE times = '{$time}'; ";
            $query2 .= "UPDATE Set_times SET title = '{$title}' WHERE times = '{$time}'; ";
            $query2 .= "INSERT INTO  display_stu(student, p_title) VALUE ((SELECT users.full_name FROM users WHERE users.user_id = '{$_SESSION['user_id']}' ), '{$title}');  ";
            $query2 .= "INSERT INTO  display_stu(student, p_title) VALUE (CONCAT ((SELECT users.full_name FROM users WHERE users.user_id = '{$_SESSION['user_id']}'),\", \",(SELECT users.full_name FROM users WHERE users.user_id = '{$stu2}'),\", \", 
            (SELECT users.full_name FROM users WHERE users.user_id = '{$stu3}')
            ), '{$title}'); ";
                 
            $project_query = mysqli_multi_query($connection, $query);
            
            
                if (!$project_query){
                    
                    $message = "Your Project name is identify with a existing project name.\\n Please change.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                
                }
                else{
                
                    $project_query2 = mysqli_multi_query($connection, $query2);

            if(!$project_query2 ){
                $message = "Signup failed: \\n-You or your teammate may have already signup. \\n-Team member ID not exist. \\nTry again.";
                echo "<script type='text/javascript'>alert('$message');</script>";
               
            }else{
                
               
                $query = "SELECT email.a_email FROM email WHERE email.advisor_id = 
          (SELECT users.user_id FROM users WHERE users.full_name = '{$advisor}')";
          $advisor_email = mysqli_query($connection,$query);

                // the message
$advisor_msg =
"Hi $advisor.
Your advisee {$_SESSION['firstname']} has scheduled his/her capstone presentaion during {$time} on the Reading Day. ";     
                
$stu_msg =  
"Hi {$_SESSION['firstname']}: Thank you for signing up to present your capstone project. 

You are scheduled to present during {$time} on the Reading Day

Good luck with your presentation.";

// send email
mail("$email","Computer Science Capstone Project Sign-Up Confirmation",$stu_msg,"noreply@salemstate.edu");
                      
mail("$advisor_email","Computer Science Capstone Project Sign-Up Confirmation",$advisor_msg,"noreply@salemstate.edu");
                
                 header("Location: http://weblab.salemstate.edu/~capstonesignup/student/myproject.php");
            }
                }
        
            }
            
        } else if( !empty($type) && !empty($time) // 2 team member stu 2 empty -----------------------------

          && !empty($descri)  && !empty($title) && empty($stu2) && !empty($stu3) && !empty($email)) {


            if($descri_check < 65){
               
               echo "<script type='text/javascript'>
       alert('Project description is required to contain at least 65 words.');
    </script>";
           }else{
            
                
            $query = "INSERT INTO projects(P_name, description, course_type, P_time) ";
            $query .= "SELECT * FROM (SELECT '{$title}','{$descri}','{$type}','{$time}') AS tmp ";
            $query .= "WHERE NOT EXISTS ( ";
            $query .= "
            SELECT present.presenter FROM present WHERE present.presenter = '{$_SESSION['user_id']}' OR  present.presenter = '{$stu3}' ";
            $query .= " ) AND EXISTS (SELECT * FROM users WHERE users.user_id = '{$stu3}' ); ";
            
            
            $query2 = "INSERT INTO present(presenter, project_name) VALUE ('{$_SESSION['user_id']}','{$title}'); ";  
            $query2 .= "INSERT INTO present(presenter, project_name) VALUE ('{$stu3}','{$title}'); "; 
            
            
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$_SESSION['user_id']}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            
            $query2 .= "INSERT INTO assign(p_title,Student_id,advisor_id,ad_fullname) VALUE ";
            $query2 .= "('{$title}','{$stu3}',(SELECT users.user_id FROM users WHERE users.full_name = '$advisor' AND users.role = 'advisor'), '$advisor' ); ";
            $query2 .= " INSERT INTO stu2(stu2_id, p_title) VALUE('{$stu3}','{$title}')";
            
            
            $query2 .= "UPDATE Set_times SET status = 'Unavailable' WHERE times = '{$time}'; ";
            $query2 .= "UPDATE Set_times SET title = '{$title}' WHERE times = '{$time}'; ";
            $query2 .= "INSERT INTO  display_stu(student, p_title) VALUE (CONCAT ((SELECT users.full_name FROM users WHERE users.user_id = '{$_SESSION['user_id']}'),\", \",(SELECT users.full_name FROM users WHERE users.user_id = '{$stu3}')), '{$title}'); ";
           
           
            $project_query = mysqli_multi_query($connection, $query);
            
            

                if (!$project_query){
                    
                    $message = "Your Project name is identify with a existing project name.\\n Please change.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                }
                
                else{
                    
                    $project_query2 = mysqli_multi_query($connection, $query2);
            if(!$project_query2 ){

                $message = "Signup failed: \\n-You or your teammate may have already signup. \\n-Team member ID not exist. \\nTry again.";
                echo "<script type='text/javascript'>alert('$message');</script>";
               
            }else{
                
               
                $query = "SELECT email.a_email FROM email WHERE email.advisor_id = 
          (SELECT users.user_id FROM users WHERE users.full_name = '{$advisor}')";
          $advisor_email = mysqli_query($connection,$query);

                // the message
$advisor_msg =
"Hi $advisor.
Your advisee {$_SESSION['firstname']} has scheduled his/her capstone presentaion during {$time} on the Reading Day. ";     
                
$stu_msg =  
"Hi {$_SESSION['firstname']}: Thank you for signing up to present your capstone project. 

You are scheduled to present during {$time} on the Reading Day

Good luck with your presentation.";

// send email
mail("$email","Computer Science Capstone Project Sign-Up Confirmation",$stu_msg,"noreply@salemstate.edu");
                      
mail("$advisor_email","Computer Science Capstone Project Sign-Up Confirmation",$advisor_msg,"noreply@salemstate.edu");
                
                 header("Location: http://weblab.salemstate.edu/~capstonesignup/student/myproject.php");
            }
                }
            }
        } 
    }      
         ?>      
          
           
                <!-- beginning of the form  /////////////// -->
                
                <form action="#" method="post">
                
                <h4 class="page-header">

                Please fill out the following form
                </h4> 
  
  <div class="form-group">
    <label for="student2">Team member 1 ID</label>
    <input type="text" class="form-control" class="border border-bold" name="student2"  value="<?php echo isset($_POST['student2']) ? $_POST['student2'] : '' ?>"  placeholder="Leave it blank if not applicable" >

  </div>
   
    <div class="form-group">
    <label for="student3">Team member 2 ID </label>
    <input type="text" class="form-control" name="student3" value="<?php echo isset($_POST['student3']) ? $_POST['student3'] : '' ?>"  placeholder="Leave it blank if not applicable">
  </div>
    
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" >
  </div>
    
    

    <div class="form-group">
    <label for="title">Project Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>" >
  </div>



  <div class="form-group">
    <label for="courseType">Course Type</label>
    <select class="form-control" name="courseType">
    
     <option> </option>
      <option  <?php if($_POST['courseType']=='CSC 520') echo 'selected="selected"';?> >CSC 520</option>
      <option  <?php if($_POST['courseType']=='CSC 521') echo 'selected="selected"';?> >CSC 521</option>
    
      
    </select>
  </div>

  <div class="form-group">
    <label for="timeSlots">Presentation Time</label>
   
<?php     
$query = "SELECT * FROM Set_times WHERE Set_times.status = 'Available' ";
$result = mysqli_query($connection,$query);
$line0 = $row[''];
    echo "<select class='form-control' name='times'> ";
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
    <textarea class="form-control"  name="description" id="description" rows="7" placeholder="Minimum length requirement: 65 words." ><?php if(isset($_POST['description'])) {  echo htmlentities ($_POST['description']); }?></textarea>
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
      
 
