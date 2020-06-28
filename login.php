<?php
require_once('connection.php');
session_start();

if(isset($_POST['registsubmit']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $age = $_POST['age'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $pass = sha1($_POST['pass']);
    $cpass = sha1($_POST['cpass']);
    $un = "SELECT uname FROM users WHERE uname = '$uname'"; 
    $em = "SELECT mail FROM users WHERE mail = '$mail'"; 
    $ph = "SELECT phone FROM users WHERE phone = '$phone'"; 
    $um_conn = mysqli_query($conn,$un)or die(mysqli_error($conn));   
    $em_conn = mysqli_query($conn,$em)or die(mysqli_error($conn));   
    $ph_conn = mysqli_query($conn,$ph)or die(mysqli_error($conn)); 


    if (mysqli_num_rows($um_conn) >0){
        $um = "Your Username already existed";
    }
    elseif (mysqli_num_rows($ph_conn) >0){
        $phonerror = "Your phone already existed";
    }
    elseif (mysqli_num_rows($em_conn) >0){
        $mailerror = "Your email already existed";
    }
    elseif ((empty($fname))){
        $empty = "Please fill this field it's important for us";
    }
    elseif ((empty($lname))){ 
        $empty= "Please fill this field it's important for us";
    }
    elseif ((empty($uname))){ 
        $empty= "Please fill this field it's important for us";
    }
    elseif ((empty($age))){
        $empty = "Please fill this field it's important for us";
    }
    elseif ((empty($phone))){
        $empty = "Please fill this field it's important for us";
    }
    elseif ((empty($mail))){
        $empty = "Please fill this field it's important for us";
    }
    elseif ((empty($pass))){
        $empty = "Please fill this field it's important for us";
    }
    elseif (strlen($_POST['pass']) < 5) {
        $passless = "Your pass is less than 6 try again";
    }
    elseif ($pass != $cpass) {
        $passmatch = "Your pass doesn't match";
    }
    else 
    {
        $ins= "INSERT INTO users (fname,lname,uname,age,phone,mail,pass,cpass) VALUES('$fname','$lname','$uname','$age','$phone','$mail','$pass','$cpass')";
        $success = "Your information posted successfully";
        if(!mysqli_query($conn,$ins)){ 
        die('Error:'. mysqli_error($conn));
        } 
        
    }
}
if (isset($_POST['submit'])) {
    $unlog = $_POST['un'];
    $mypass = sha1($_POST['pass']);

    $sql = "SELECT * FROM users WHERE uname = '$unlog' and pass = '$mypass' ";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        echo('check as something went wrong in the sql statement');
    } else {
        while ($row = mysqli_fetch_array($result))
        {
            $_SESSION['users_id'] = $row['users_id'];
        }
        $count = mysqli_num_rows($result);
            if ($count == 1) {
                $_SESSION['username'] = $unlog;
                header("location: index.php");
            } else {
                $logfalied = "Your Username or Password is uncorrect";
            }
        
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
    <style>
        h2 {
            color: #392b82;
        }

        li a {
            color: #392b82;
            font-weight: 500;
        }

        p {
            margin: 0px;
        }
        .w-50{
            width:50% !important;
        }

        .alert {
            width: 70%;
        }

        .form-control {
            border: 2px solid #392b82;
            border-radius: 25px;
        }

        .nav-pills .nav-link.active {
            background-color: #392b82;
        }

        .btn-index {
            background-color: #392b82;
            color: #fff;
        }

        .brdr {
            background-color: #392b82;
            width: 10%;
            height: 3px;
        }
        @media screen and (max-width:550px)
        {
            .w-50{
                width:100%!important;
            }
            .alert{
                width:100% !important;
            }
        }
        

    </style>
    <title>Login page</title>
</head>

<body>
    <section class="py-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Register</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form class="login-form" name="login" action="login.php" method="POST">
                                <div class="login-desc">
                                    <h2>Login Page</h2>
                                    <div class="brdr"></div>
                                </div>
                                <input type="text" name="un" placeholder="Username" class="form-control my-3 w-50" required="required" />
                                <input type="password" name="pass" placeholder="Password" class="form-control my-3 w-50" required="required" />
                                <button type="submit" name="submit" class="btn btn-index">Login</button>
                                <?php if(isset($logfalied)): ?>
                                <div class="alert alert-danger alert-dismissible fade show w-100 my-3" role="alert">
                                    <h5><?= $logfalied ?></h5>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php endif; ?>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="index-desc my-4">
                                <h2>Register page</h2>
                                <div class="brdr"></div>
                            </div>
                            <form action="login.php" method="POST">
                                <input type="text" onchange="fname_validate(this.value);" id="" placeholder="First name" name="fname" class="form-control mb-3 w-50">
                                <div id="fname"></div>
                                <?php if(isset($empty)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $empty ?></p>
                                </div>
                                <?php endif; ?>
                                <input type="text" placeholder="Last name" onchange="lname_validate(this.value);" name="lname" class="form-control mb-3 w-50">
                                <div id="lname"></div>
                                <?php if(isset($empty)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $empty ?></p>
                                </div>
                                <?php endif; ?>
                                <input type="text" placeholder="Username" name="uname" class="form-control mb-3 w-50">
                                <?php if(isset($um)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $um ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($empty)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $empty ?></p>
                                </div>
                                <?php endif; ?>
                                <input type="number" placeholder="Age" name="age" class="form-control mb-3 w-50">
                                <?php if(isset($empty)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $empty ?></p>
                                </div>
                                <?php endif; ?>
                                <input type="number" onchange="phone_validate(this.value);" id="phone" placeholder="Mobile" name="phone" class="form-control  mb-3 w-50">
                                <div id="phoneval"></div>
                                <?php if(isset($empty)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $empty ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($phonerror)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $phonerror ?></p>
                                </div>
                                <?php endif; ?>
                                <input type="email" onchange="email_validate(this.value);" id="mail" placeholder="Email" name="mail" class="form-control mb-3 w-50">
                                <div id="email"></div>
                                <?php if(isset($empty)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $empty ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($mailerror)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $mailerror ?></p>
                                </div>
                                <?php endif; ?>
                                <input type="password" placeholder="password" name="pass" class="form-control  mb-3 w-50">
                                <?php if(isset($empty)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $empty ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if(isset($passless)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $passless ?></p>
                                </div>
                                <?php endif; ?>
                                <input type="password" placeholder="Confirm password" name="cpass" class="form-control mb-3 w-50">
                                <?php if(isset($passmatch)): ?>
                                <div class="alert alert-danger">
                                    <p><?= $passmatch ?></p>
                                </div>
                                <?php endif; ?>
                                <div class="text-white my-3">
                                    <input class="btn btn-index my-2" type="submit" name="registsubmit" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"><img class="img-fluid" src="images/index.png" alt=""></div>
            </div>
        <?php if(isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show w-100 my-2" role="alert">
                <h5><?= $success ?></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        </div>
    </section>



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    function fname_validate(fname) {
      var regfname = /^[A-Z][a-z]{2,10}$/;
      console.log(fname)

      if (regfname.test(fname) == false) {
        document.getElementById("fname").innerHTML = "<div class='alert alert-danger'>Your name must be first capital</div>";
      }
      else {
        document.getElementById("fname").innerHTML = "";
      }
    }
    function lname_validate(lname) {
      var reglname = /^[A-Z][a-z]{2,10}$/;

      console.log(lname)

      if (reglname.test(lname) == false) {
        document.getElementById("lname").innerHTML = "<div class='alert alert-danger'>Your name must be first capital</div>";
      }
      else {
        document.getElementById("lname").innerHTML = "";
      }
    }
    function email_validate(mail) {
      var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

      console.log(mail)

      if (regMail.test(mail) == false) {
        document.getElementById("email").innerHTML = "<div class='alert alert-danger'>Your email is not valid yet!</div>";
      }
      else {
        document.getElementById("email").innerHTML = "";
      }
    }
    function phone_validate(phone) {
      var regPhone = /^01[0|1|2|5]{1}[0-9]{8}$/;

      console.log(phone)

      if (regPhone.test(phone) == false) {
        document.getElementById("phoneval").innerHTML = "<div class='alert alert-danger'>Your phone is not found in our country</div>";
      }
      else {
        document.getElementById("phoneval").innerHTML = "";
      }
    }
    fun
    </script>
</body>

</html>
