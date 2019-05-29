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
                            Welcome to admin
                            <small> <?php  echo $_SESSION['firstname']?></small>
                        </h1>
                        <ol class="breadcrumb">


                        </ol>
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
