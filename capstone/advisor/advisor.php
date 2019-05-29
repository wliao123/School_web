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
            <div class="col-md-8">

                
                
                    <?php  
    
$query = "SELECT Set_date.dates FROM Set_date";
$result = mysqli_query($connection,$query);

      
    echo "<h1 class='page-header'> Presentation Day: ";
            
    while ($row = $result->fetch_assoc()) {

                  
                  $date = $row['dates'];
                  echo $date;
    
    }
        echo "</h1>";
    ?>
<!--                 First Blog Post
                <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <hr> -->



            </div>



       
       
        </div>
        <!-- /.row -->

        <hr>

       <!-- Footer -->

