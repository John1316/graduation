<?php
require_once('connection.php'); 
session_start();
if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass']; 

    $sql = "SELECT * FROM admins WHERE uname = '$uname' and pass = '$pass'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo('check as something went wrong in the sql statement');
    } else {
        $row = mysqli_fetch_array($result);
        
        $count = mysqli_num_rows($result);
        if (empty($email)) {
            $errlog ="please fill this field to login";
        }
        if (empty($pass)) {
            $errlog ="please fill this field to login";
        }
            if ($count == 1) {
                $_SESSION['uname'] = $uname;
                header("location: dashboard.php");
            } else {
                $logfailed = "Your email or password is uncorrect";
            }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Page</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body>

    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto tm-login-col">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12 text-center">
                <h2 class="tm-block-title mb-4">Welcome to Dashboard, Login</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form action="index.php" method="POST" class="tm-login-form">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input
                      name="uname"
                      type="text"
                      class="form-control validate"
                      id="username"
                      value=""
                      required
                    />
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input
                      name="pass"
                      type="password"
                      class="form-control validate"
                      id="password"
                      value=""
                      required
                    />
                  </div>
                  <div class="form-group mt-4">
                    <button name="submit"
                      type="submit"
                      class="btn btn-primary btn-block text-uppercase"
                    >
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if(isset($logfailed)): ?>
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <h5><?= $logfailed ?></h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <?php endif; ?>
    </div>
    <footer class="tm-footer row tm-mt-small fixed-bottom">
      <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
                    Copyright &copy; 2020 All rights reserved by Medic Team.
        </p>
      </div>
    </footer>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
