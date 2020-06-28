<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Product Page - Admin HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
        <link rel="shortcut icon" href="../images/logo2.png" type="image/x-icon">

    <style>
        .modal-content {
            background-color: #435c70;
        }

        a {
            cursor: pointer;
        }
        .alert h5{
            margin-bottom:0;
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
                        <a class="nav-link active" href="products.php">
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
<?php
require_once('connection.php');
if (isset($_POST['add'])) {
    $name = $_POST['pname']; 
    $des = $_POST['pdes']; 
    $code = $_POST['code']; 
    $price = $_POST['price'];
    $profileImageName = time() . '-' . $_FILES["img"]["name"];
    $target_dir = "../product-images/";
    $target_file = $target_dir . basename($profileImageName);
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);     
    $expdate = $_POST['expdate'];

$ins= "INSERT INTO tblproduct (name,des,code,price,image,expdate) VALUES('$name','$des','$code','$price','product-images/$profileImageName','$expdate')"; 
    
if(!mysqli_query($conn,$ins)){ 
    die('Error:'. mysqli_error($conn));
} else {
    $added ="Your product added successfully";

}

}
if (isset($_POST['delete'])) {
    $id = $_POST['pid'];

$del= "DELETE FROM tblproduct WHERE id = '$id'"; 

if(!mysqli_query($conn,$del)){ 
    die('Error:'. mysqli_error($conn));
} else {
    $deleted ="Your product deleted successfully";
}

}
if (isset($_POST['update'])) {
    $id = $_POST['pid'];
$name = $_POST['pname']; 
$des = $_POST['pdes']; 
$code = $_POST['code']; 
$price = $_POST['price'];
$expdate = $_POST['expdate'];
$profileImageName = time() . '-' . $_FILES["img"]["name"];
$target_dir = "../product-images/";
$target_file = $target_dir . basename($profileImageName);
move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);     


$up= "UPDATE tblproduct SET name='$name' , des='$des', code='$code' , price='$price', image='product-images/$profileImageName' , expdate='$expdate' WHERE id='$id'"; 

if(!mysqli_query($conn,$up)){ 
    die('Error:'. mysqli_error($conn));
} else {
    $updated ="Your product updated successfully";
}
}
        if(!isset($_SESSION['uname'])){
        echo " <script> alert('Only admin is required to make this'); </script>";
        $disable = "disabled";
        }else{
        $disable = "";
        }
?>
    <div class="container mt-5">
        <div class="row tm-content-row">
            <div class="col-sm-12 col-md-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-products">
                    <div class="tm-product-table-container">
                        <table class="table table-hover tm-table-small tm-product-table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">PRODUCT NAME</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">CODE</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">EXPIRY DATE</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once('connection.php');
                                $products = "SELECT * FROM tblproduct ORDER by id ASC";
                                $query = mysqli_query($conn,$products) or die("Error:".mysqli_error($conn)) ;
                                $result= mysqli_fetch_array($query);
                                do{
                                ?>
                                <tr>
                                    <td><?php echo $result ['id']; ?></td>
                                    <td class="tm-product-name"><?php echo $result ['name']; ?></td>
                                    <td><?php echo $result ['des']; ?></td>
                                    <td><?php echo $result ['code']; ?></td>
                                    <td><?php echo $result ['price']; ?></td>
                                    <td><?php echo $result ['image']; ?></td>
                                    <td><?php echo $result ['expdate']; ?></td>
                                    <td>
                                        <button data-toggle="modal" <?php echo $disable ?> data-target="#add" class="btn rounded-circle btn-success px-3 py-2">
                                            <i class="fas text-white fa-user-plus"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button data-toggle="modal" <?php echo $disable ?> data-target="#update<?php echo $result ['id']; ?>" class="btn rounded-circle btn-info px-3 py-2">
                                            <i class="fas text-white fa-edit"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button data-toggle="modal" <?php echo $disable ?> data-target="#delete<?php echo $result ['id']; ?>" class="btn rounded-circle btn-danger px-3 py-2">
                                            <i class="fas text-white fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

<div class="modal fade" id="delete<?php echo $result ['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="products.php" class="tm-edit-product-form" method="POST">
            <div class="modal-content text-white">
                <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Product?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <h6>Do you want to delete Product <input type="hidden" name="pid" value="<?php echo $result ['id']; ?>"> <?php echo $result ['id']; ?> and his Name is <span class="badge btn-primary mx-2"><?php echo $result ['name']; ?></span></h6>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete" class="btn btn-primary">Delete changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="modal fade" id="update<?php echo $result ['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">Edit product</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <div class="modal-body">
                    <form action="products.php" class="tm-edit-product-form" method="POST">
                        <div class="row tm-edit-product-row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Product id
                                    </label>
                                    <input id="name" value="<?php echo $result ['id']; ?>" name="pid" type="text" class="form-control validate" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Product Name
                                    </label>
                                    <input id="name" value="<?php echo $result ['name']; ?>" name="pname" type="text" class="form-control validate" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control validate" name="pdes" rows="3" required><?php echo $result['des'];?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Code</label>
                                    <input class="form-control validate" name="code" value="<?php echo $result ['code']; ?>" rows="3" required></input>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="name">Price
                                    </label>
                                    <input id="name" name="price" value="<?php echo $result ['price']; ?>" type="text" class="form-control validate" required />
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 mx-auto my-4">
                                <div class="tm-product-img-dummy mx-auto">
                                    <i class="fas fa-cloud-upload-alt tm-upload-icon" onclick="document.getElementById('fileInput').click();"></i>
                                </div>
                                <div class="custom-file mt-3 mb-3">
                                    <input id="fileInput" name="img" type="file" style="display:none;" />
                                    <input type="button" class="btn btn-primary btn-block mx-auto" name="img" value="UPDATE PRODUCT IMAGE" onclick="document.getElementById('fileInput').click();" />
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="update" class="btn btn-primary btn-block text-uppercase">Update Product Now</button>
                            </div>
                    </form>
                </div> -->
                <div class="modal-body">
                  <div class="container-fluid">
                    <form action="products.php" method="post" enctype="multipart/form-data">
                        <div class="row text-white">
                            <div class="col-6 my-2"> <label for="name">Product ID</label><input name="pid" type="text" value="<?php echo $result ['id']; ?>" class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product Name</label><input name="pname" type="text" value="<?php echo $result ['name']; ?>" class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product code</label><input name="code" type="text" value="<?php echo $result ['code']; ?>" class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product Price</label><input name="price" type="text" value="<?php echo $result ['price']; ?>" class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product IMAGE</label><input name="img" type="file"  class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product Expiry-Date</label><input name="expdate" type="date" value="<?php echo $result ['expdate']; ?>" class="form-control validate" required /></div>
                            <div class="col-12 my-2"> <label for="name">Product Description</label><textarea name="pdes"  type="text" class="form-control validate" required /><?php echo $result ['des']; ?></textarea></div>
                            <button type="submit" name="update" class="btn btn-primary btn-block my-3">UPDATE PRODUCT</button>
                        </div>
                    </form>
                  </div>
                </div>

            </div>
        </div>
    </div>

    
                                <?php
                                  }
                                  while($result=mysqli_fetch_array($query));
                                  ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- table container -->
                    <!-- <button data-toggle="modal" <?php echo $disable ?> data-target="#add" class="btn btn-warning btn-block text-white text-uppercase mb-3">Add new product</button> -->
                    <?php if(isset($added)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h5><?= $added ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($updated)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h5><?= $updated ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($deleted)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5><?= $deleted ?></h5>
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
                Copyright © 2020 All rights reserved by Medic Team.
        </div>
    </footer>

    <!-- Modal -->

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add product</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <form action="products.php" method="post" enctype="multipart/form-data">
                        <div class="row text-white">
                            <div class="col-6 my-2"> <label for="name">Product Name</label><input name="pname" type="text" class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product code</label><input name="code" type="text" class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product Price</label><input name="price" type="text" class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product IMAGE</label><input name="img" type="file" class="form-control validate" required /></div>
                            <div class="col-6 my-2"> <label for="name">Product Expiry-Date</label><input name="expdate" type="date" class="form-control validate" required /></div>
                            <div class="col-12 my-2"> <label for="name">Product Description</label><textarea name="pdes" type="text" class="form-control validate" required /></textarea></div>
                            <button type="submit" name="add" class="btn btn-primary btn-block my-3">ADD PRODUCT</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>

    </script>
</body>

</html>
