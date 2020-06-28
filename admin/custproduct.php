<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Customer product - Admin</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="shortcut icon" href="../images/logo2.png" type="image/x-icon">

    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
  -->
  <style>
    .modal-content{
      background-color: #435c70;
      color: #fff;
    }
    table tr td img{
      width:100px;
      height:70px;
      border-radius:50% ;
    }
  </style>
  </head>

  <body id="reportsPage">
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
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">
                            <i class="fas fa-shopping-cart"></i> Products
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
                        <a class="nav-link active" href="custproduct.php">
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
    <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products">
            <h2 class="tm-block-title">Customer Products</h2>
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">CUSTOMER NAME</th>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">LOCATION</th>
                    <th scope="col">UNIT PRICE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">EXPIRE DATE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                                                  <?php
                                                  require_once('connection.php');
                      if (isset($_POST['psubmit']))
                      {
                            $name = $_POST['pname'];
                            $price = $_POST['pprice'];
                            $code = $_POST['pcode'];
                            $des = $_POST['pdesc'];
                            $expdate = $_POST['pexpdate'];
                            $prophoto = time() . '-' . $_FILES["pimage"]["name"];
                            $target_dir = "../product-images/";
                            $target_file = $target_dir . basename($prophoto);
                            move_uploaded_file($_FILES["pimage"]["tmp_name"], $target_file);     

                            $ins= "INSERT INTO tblproduct (name,code,price,des,image,expdate) VALUES('$name','$code','$price','$des','product-images/$prophoto','$expdate')";
                            $success = "Your Product posted successfully";

                                if(!mysqli_query($conn,$ins)){ 
                                die('Error:'. mysqli_error($conn));
                                } 
    
                      }
                      if (isset($_POST['pdelete']))
                      {
                        $pdid = $_POST['pdid'];
                        $del= "DELETE FROM newprod WHERE custadd_id= '$pdid'";
                        $delete = "Customer Request deleted successfully";

                                if(!mysqli_query($conn,$del)){ 
                                die('Error:'. mysqli_error($conn));
                                } 
    

                      }
        if(!isset($_SESSION['uname'])){
            echo " <script> alert('Only admin is required to make this'); </script>";
            $disable = "disabled";
        }else{
        $disable = "";
        }
        
                      $products = "SELECT * FROM newprod";
                      $query = mysqli_query($conn,$products) or die("Error:".mysqli_error($conn)) ;
                      $result= mysqli_fetch_array($query);
                      do{
                      ?>
                  <tr>
                    <td scope="row">#<?php echo $result ['newprod_id']; ?></td>
                    <td class="tm-product-name"><?php echo $result ['name']; ?></td>
                    <td><?php echo $result ['cust_name']; ?></td>
                    <td><?php echo $result ['cust_phone']; ?></td>
                    <td><?php echo $result ['cust_location']; ?></td>
                    <td><?php echo $result ['price']; ?></td>
                    <td><?php echo $result ['quantity']; ?></td>
                    <td><?php echo $result ['expdate']; ?></td>
                    <td><img src="img/<?php echo $result ['image']; ?>" alt="<?php echo $result ['image']; ?>"> </td>
                    <td>
                      <button href="#" data-toggle="modal" <?php echo $disable ?> data-target="#add<?php echo $result ['newprod_id']; ?>" class="btn rounded-circle btn-success px-3 py-2">
                        <i class="fas fa-user-plus"></i>
                      </button>
                    </td>
                    <td>
                      <button href="#" <?php echo $disable ?> data-toggle="modal" data-target="#delete<?php echo $result ['newprod_id']; ?>" class="btn rounded-circle btn-danger px-3 py-2">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </button>
                    </td>
                  </tr>
<div class="modal fade" id="add<?php echo $result ['newprod_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <form action="custproduct.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-6 my-2"><label for="">Product Name</label><input type="text" name="pname" value="<?php echo $result ['name']; ?>"" class="form-control"></div>
              <div class="col-6 my-2"><label for="">Product Image</label><input type="file" name="pimage" value="<?php echo $result ['image']; ?>"" class="form-control"></div>
              <div class="col-6 my-2"><label for="">Product Price</label><input type="text" name="pprice" value="<?php echo $result ['price']; ?>"" class="form-control"></div>
              <div class="col-6 my-2"><label for="">Product Code</label><input type="text" name="pcode" class="form-control"></div>
              <div class="col-6 my-2"><label for="">Product Expiry Date</label><input type="date" name="pexpdate" value="<?php echo $result ['expdate']; ?>"" class="form-control"></div>
              <div class="col-12 my-2"><label for="">Product Description</label><textarea type="text" name="pdesc" class="form-control"></textarea></div>
              <button type="submit" name="psubmit" class="btn btn-primary btn-block text-white text-uppercase my-3">add product</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete<?php echo $result ['newprod_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="custproduct.php" class="tm-edit-product-form" method="POST">
            <div class="modal-content text-white">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Product?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <h6>Do you want to delete Product <input type="hidden" name="pdid" value="<?php echo $result ['newprod_id']; ?>"> <?php echo $result ['newprod_id']; ?> and his name is <span class="badge btn-primary mx-2"><?php echo $result ['name']; ?></span></h6>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="pdelete" class="btn btn-primary">Delete changes</button>
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
            <?php if(isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show w-100 my-2" role="alert">
                <h5><?= $success ?></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
            <?php if(isset($delete)): ?>
            <div class="alert alert-danger alert-dismissible fade show w-100 my-2" role="alert">
                <h5><?= $delete ?></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
      <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
          Copyright &copy; <b>2018</b> All rights reserved. 
          
          Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
      </div>
    </footer>




    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      $(function() {
        $(".tm-product-name").on("click", function() {
          window.location.href = "edit-product.html";
        });
      });
    </script>
  </body>
</html>