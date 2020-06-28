<?php
session_start();
require_once('connection.php');
//
$users = "SELECT users_id FROM users ORDER BY users_id";
$users_count = mysqli_query($conn,$users) or die("Error:".mysqli_error($conn)) ;
$userId = mysqli_num_rows($users_count);
//
$order = "SELECT order_id FROM orders ORDER BY order_id";
$order_count = mysqli_query($conn,$order) or die("Error:".mysqli_error($conn)) ;
$orderId = mysqli_num_rows($order_count);
//
$review = "SELECT rate_id FROM rate ORDER BY rate_id";
$review_count = mysqli_query($conn,$review) or die("Error:".mysqli_error($conn)) ;
$reviewId = mysqli_num_rows($review_count);
//
$admins = "SELECT admin_id FROM admins ORDER BY admin_id";
$admins_count = mysqli_query($conn,$admins) or die("Error:".mysqli_error($conn)) ;
$adminsId = mysqli_num_rows($admins_count);
//
$product = "SELECT id FROM tblproduct ORDER BY id";
$product_count = mysqli_query($conn,$product) or die("Error:".mysqli_error($conn)) ;
$prodid = mysqli_num_rows($product_count);
//
$custprod = "SELECT newprod_id FROM newprod ORDER BY newprod_id";
$custprod_count = mysqli_query($conn,$custprod) or die("Error:".mysqli_error($conn)) ;
$custprodid = mysqli_num_rows($custprod_count);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="shortcut icon" href="../images/logo2.png" type="image/x-icon">

    <style>
        .card {
            background-color: #567086;
        }

    </style>
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="dashboard.php">
                    <h1 class="tm-site-title mb-0">Admin Panel</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">
                                <i class="fas fa-shopping-cart"></i>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="fas fa-users"></i> Users
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order.php">
                            <i class="fas fa-shopping-bag"></i>                                
                            Orders
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="custproduct.php">
                        <i class="fas fa-user"></i>                                
                        Customer products
                        </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="logout.php">
                                <?php
                                if(isset($_SESSION['uname']))
                                {
                                    echo $_SESSION['uname'];
                                }
                                
                                ?><b class="mx-2">Logout</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <div class="container">
            
            <!-- row -->
            <div class="row tm-content-row mt-5">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">                                    
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Details</h2>
                        <div class="my-3 row text-center">
                            <div class="col-lg-4 col-sm-12 col-md-6 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="my-2 fas fa-2x fa-users d-block"></i>
                                        <button type="button" class="btn btn-warning px-3 py-2 rounded">
                                            <span class="badge badge-light"><?php echo $userId ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="my-2 fas fa-2x fa-user-clock d-block"></i>
                                        <button type="button" class="btn btn-warning px-3 py-2 rounded">
                                            <span class="badge badge-light"><?php echo $orderId ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="my-2 fas fa-2x fa-tasks d-block"></i>
                                        <button type="button" class="btn btn-warning px-3 py-2 rounded">
                                            <span class="badge badge-light"><?php echo $reviewId ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="my-2 fas fa-2x fa-user-cog d-block"></i>
                                        <button type="button" class="btn btn-warning px-3 py-2 rounded">
                                            <span class="badge badge-light"><?php echo $adminsId ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="my-2 fas fa-2x fa-cart-arrow-down d-block"></i>
                                        <button type="button" class="btn btn-warning px-3 py-2 rounded">
                                            <span class="badge badge-light"><?php echo $prodid ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-6 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="my-2 fas fa-2x fa-user-plus d-block"></i>
                                        <button type="button" class="btn btn-warning px-3 py-2 rounded">
                                            <span class="badge badge-light"><?php echo $custprodid ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Customer Review</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Rate</th>
                                    <th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once('connection.php');
                                $review = "SELECT * FROM rate";
                                $review_count = mysqli_query($conn,$review) or die("Error:".mysqli_error($conn)) ;
                                $userreview = mysqli_num_rows($review_count);
                                do{
                                ?>
                                <tr>
                                    
                                    <td><?php echo $userreview['scale'] ?>/5</td>
                                    <td><?php echo $userreview['msg'] ?></td>
                                </tr>
                                <?php
                                }
                                while($userreview=mysqli_fetch_array($review_count));
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
        <footer class="tm-footer row tm-mt-small">
            <div class="col-12 font-weight-light">
                <p class="text-center text-white mb-0 px-4 small">
                    Copyright © 2020 All rights reserved by Medic Team.
                </p>
            </div>
        </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function() {
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart

            $(window).resize(function() {
                updateLineChart();
                updateBarChart();
            });
        });

    </script>
</body>

</html>
