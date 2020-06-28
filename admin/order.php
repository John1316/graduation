<?php
session_start();
require_once('connection.php');
if (isset($_POST['submit'])) {
            $id = $_POST['hidid']; 
            $uname = $_POST['hiduname']; 
            $name = $_POST['hidname'];
            $phone = $_POST['hidphone'];
            $address = $_POST['hidaddress'];
            $datetime = $_POST['hiddatet'];
            $quan = $_POST['hidquan']; 
            $code = $_POST['hidcode']; 
            $uprice = $_POST['hiduprice'];
            $tprice = $_POST['hidtprice'];

            $ins= "INSERT INTO accorders (order_id,cust_name,name,cust_phone,cust_add,delivery_time,quan,code,uprice,tprice) VALUES('$id','$uname','$name','$phone','$address','$datetime','$quan','$code','$uprice','$tprice')";
                    
                    if (!mysqli_query($conn, $ins)) {
                        die('Error:'. mysqli_error($conn));
                    } else {
                        $succeed ="The order information accepted succefully";
                    }
} 
if (isset($_POST['delete'])) {
    $id = $_POST['oid'];

$del= "DELETE FROM orders WHERE order_id = '$id'"; 

if(!mysqli_query($conn,$del)){ 
    die('Error:'. mysqli_error($conn));
} else {
    $deleted ="The order information rejected successfully";
}

}

if(!isset($_SESSION['uname'])){
            echo " <script> alert('Only admin is required to make this'); </script>";
            $disable = "disabled";
        }else{
        $disable = "";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer orders</title>
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
        .modal-content{
      background-color: #435c70;
      color: #fff;
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
                            <a class="nav-link" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
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
                            <a class="nav-link active" href="order.php">
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
        <section class="all py-5">
                    <?php if(isset($succeed)): ?>
                        <div class="alert alert-success text-uppercase container w-75 alert-dismissible fade show" role="alert">
                            <h5><?= $succeed ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($deleted)): ?>
                        <div class="alert alert-success text-uppercase container w-75 alert-dismissible fade show" role="alert">
                            <h5><?= $deleted ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
        <div class="container-fluid"> 
            <!-- row -->
            <div class="row tm-content-row mt-5"
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Waiting orders</h2>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER NO.</th>
                                    <th scope="col">CUST. NAME</th>
                                    <th scope="col">CUST. ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">PHONE</th>
                                    <th scope="col">ADDRESS</th>
                                    <th scope="col">CODE</th>
                                    <th scope="col">VISA</th>
                                    <th scope="col">DATE</th>  
                                    <th scope="col">QUANTITY</th>
                                    <th scope="col">TOTAL PRICE</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once('connection.php');
$order = "SELECT * FROM orders order by order_date";
$query = mysqli_query($conn,$order) or die("Error:".mysqli_error($conn)) ;
$result= mysqli_fetch_array($query);
do{
?>
                                <tr>
                                    <form action="order.php" method="POST">
                                       
                                        <th scope="row"><b>#<?php echo $result ['order_id'] ;?></b></th>
                                        <td><b><?php echo $result ['cust_name'] ;?></b></td>
                                        <td><b><?php echo $result ['users_id'] ;?></b></td>
                                        <td><b><?php echo $result ['name'] ;?></b></td>
                                        <td><b><?php echo $result ['cust_phone'] ;?></b></td>
                                        <td><b><?php echo $result ['cust_add'] ;?></b></td>
                                        <td><b><?php echo $result ['code'] ;?></b></td>
                                        <td><b><?php echo $result ['visa'] ;?></b></td>
                                        <td><b><?php echo $result ['order_date'] ;?></b></td>
                                        <td><b><?php echo $result ['quan'] ;?></b></td>
                                        <td><button type="button" class="btn btn-warning px-2 py-2 rounded">
                                        LE<span class="badge badge-light ml-2"><?php echo $result ['tprice'] ;?>
                                        </span></button></td>
                                        <td><button data-toggle="modal" <?php echo $disable ?> data-target="#accept<?php echo $result ['order_id']; ?>"  type="button" class="btn rounded-circle btn-success px-3 py-2 rounded"><i class="fa fa-user-plus" aria-hidden="true"></i></button></td>
                                        <td><button data-toggle="modal" <?php echo $disable ?> data-target="#delete<?php echo $result ['order_id']; ?>"  type="button" class="btn rounded-circle btn-danger px-3 py-2 rounded"><i class="fa fa-trash"></i></button></td>
                                    </form>
                                </tr>
    <div class="modal fade" id="accept<?php echo $result ['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add Order</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <form action="order.php" method="post">
                      <div class="row text-uppercase">
                        <div class="col-6 my-2"> <label for="name">Product no.</label><input name="hidid" value="<?php echo $result ['order_id'];?>" type="text" class="form-control validate" required /></div>
                        <div class="col-6 my-2"> <label for="name">Product Name</label><input name="hidname" value="<?php echo $result ['name'];?>" type="text" class="form-control validate" required /></div>
                        <div class="col-6 my-2"> <label for="name">Product code</label><input name="hidcode" value="<?php echo $result ['code'];?>"  type="text" class="form-control validate" required /></div>
                        <div class="col-6 my-2"> <label for="name">customer name</label><input name="hiduname" value="<?php echo $result ['cust_name'];?>"  type="text" class="form-control validate" required /></div>
                        <div class="col-6 my-2"> <label for="name">customer phone</label><input name="hidphone" value="<?php echo $result ['cust_phone'];?>"  type="text" class="form-control validate" required /></div>
                        <div class="col-6 my-2"> <label for="name">Product quantity</label><input name="hidquan" value="<?php echo $result ['quan'];?>"  type="text" class="form-control validate" required /></div>
                        <div class="col-6 my-2"> <label for="name">Product Price</label><input name="hiduprice" value="<?php echo $result ['uprice'];?>"  type="text" class="form-control validate" required /></div>
                        <div class="col-6 my-2"> <label for="name">Product Total-price</label><input name="hidtprice" value="<?php echo $result ['tprice'];?>"  type="text" class="form-control validate" required /></div>
                        <div class="col-6 my-2"> <label for="name">Delivery time</label><input type="date" name="hiddatet" class="form-control validate" required /></div>
                        <div class="col-12 my-2"> <label for="name">Product address</label><textarea name="hidaddress"  type="text" class="form-control validate" required><?php echo $result ['cust_add'];?></textarea></div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block my-3">ACCEPT ORDER</button>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="delete<?php echo $result ['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="order.php" class="tm-edit-product-form" method="POST">
            <div class="modal-content text-white">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">DELETE ORDER?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <h6>Do you want to delete Product <input type="hidden" name="oid" value="<?php echo $result ['order_id']; ?>"> <span class="badge badge-warning"> <?php echo $result ['order_id']; ?></span> and for cutomer <span class="badge badge-warning mx-2"><?php echo $result ['uname']; ?></span></h6>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete" class="btn btn-primary">Delete Order</button>
                </div>
            </div>
        </form>
    </div>
</div>
                                <?php
}
while($result=mysqli_fetch_array($query));
?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row tm-content-row my-5">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Accepted Orders List</h2>
                        <table class="table">
                            <thead>
                                <tr class="text-uppercase">
                                    <th scope="col">ORDER NO.</th>
                                    <th scope="col">CUST. NAME</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">PHONE</th>
                                    <th scope="col">ADDRESS</th>
                                    <th scope="col">CODE</th>
                                    <th scope="col">QUANTITY</th>
                                    <th scope="col">DATE OF DELVIERY</th>
                                    <th scope="col">UNIT PRICE</th>
                                    <th scope="col">TOTAL PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
require_once('connection.php');



$orderacc = "SELECT * FROM accorders";
$queryacc = mysqli_query($conn,$orderacc) or die("Error:".mysqli_error($conn)) ;
$resultacc= mysqli_fetch_array($queryacc);
do{
?>
                                <tr>
                                        <th scope="row"><b>#<?php echo $resultacc ['order_id'] ;?></b></th>
                                        <td><b><?php echo $resultacc ['cust_name'] ;?></b></td>
                                        <td>
                                            <div class="tm-status-circle moving">
                                            </div>Active
                                        </td>
                                        <td><b><?php echo $resultacc ['name'] ;?></b></td>
                                        <td><b><?php echo $resultacc ['cust_phone'] ;?></b></td>
                                        <td><b><?php echo $resultacc ['cust_add'] ;?></b></td>
                                        <td><b><?php echo $resultacc ['code'] ;?></b></td>
                                        <td><b><?php echo $resultacc ['quan'] ;?></b></td>
                                        <td><b><?php echo $resultacc ['delivery_time'] ;?></b></td>
                                        <td><button type="button" class="btn btn-warning px-2 py-2 rounded">
                                        LE<span class="badge badge-light ml-2"><?php echo $resultacc ['uprice'] ;?>
                                        </span></button></td>
                                        <td><button type="button" class="btn btn-warning px-2 py-2 rounded">
                                        LE<span class="badge badge-light ml-2"><?php echo $resultacc ['tprice'] ;?>
                                        </span></button></td>
                                </tr>
  
                                <?php
}
while($resultacc=mysqli_fetch_array($queryacc));
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </section>
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
            drawLineChart(); // Line Chart
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
