<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CSC Capstone Login</title>
  <link rel="stylesheet" href="http://weblab.salemstate.edu/~capstonesignup/css_login/font-awesome.min.css">
  <link rel="stylesheet" href="http://weblab.salemstate.edu/~capstonesignup/css_login/bootstrap.css">
  <link rel="stylesheet" href="http://weblab.salemstate.edu/~capstonesignup/css_login/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark p-0">
    <div class="container">
      <a class="text-white" class="navbar-brand">Salem State University</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
      </div>
    </div>
  </nav>

  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Computer Science Capstone Project Presentation Signup</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">

      </div>
    </div>
  </section>

  <!-- LOGIN -->
  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <h4>Account Login</h4>
            </div>
            <div class="card-body">
              <form action="include/loginphp.php" method="post">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username"  placeholder="Last Name (first letter upper case)">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control"  name="password" placeholder="SID (no leading-S)">
                </div>
                <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <script src="http://weblab.salemstate.edu/~capstonesignup/js_login/jquery.min.js"></script>
  <script src="http://weblab.salemstate.edu/~capstonesignup/js_login/popper.min.js"></script>
  <script src="http://weblab.salemstate.edu/~capstonesignup/js_login/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'editor1' );
  </script>
</body>
</html>
