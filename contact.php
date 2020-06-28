<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/all.css">
<link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
<style>
    .form-control{
        border: 3px solid #392b82;
    }
    .btn-index{
        background-color: #392b82;
        color: #fff;
    }
    .btn-index:hover{
        background-color: #392b82;
        color: #fff;
    }
    .border-contact{
        border: 3px solid #392b82;
    }
    @media screen and (max-width:1000px){
        section .col-sm-12{
            padding: 50px;
        }
    }
</style>
<title>Title</title>
</head>
<body>
<?php
require_once('connection.php');
session_start();
if (isset($_POST['csubmit']))
{
    $name = $_POST['name'];
    $cname = $_POST['cname'];
    $phone = $_POST['phone'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $location = $_POST['location'];
    $des = $_POST['cdes'];
    $expdate = $_POST['expdate'];
    $addedPhoto = time() . '-' . $_FILES["image"]["name"];
    $target_dir = "admin/img/";
    $target_file = $target_dir . basename($addedPhoto);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);     
    
    if ((empty($name))){
        $empty = "Please fill this field it's important for us";
    }
    elseif ((empty($price))){ 
        $empty= "Please fill this field it's important for us";
    }
    elseif ((empty($quantity))){
        $empty = "Please fill this field it's important for us";
    }
    elseif ((empty($location))){
        $empty = "Please fill this field it's important for us";
    }
    elseif ((empty($des))){
        $empty = "Please fill this field it's important for us";
    }
    elseif ((empty($expdate))){
        $empty = "Please fill this field it's important for us";
    }
    else 
    {
        $ins= "INSERT INTO newprod (cust_name,cust_phone,name,price,quantity,cust_location,cust_desc,image,expdate) VALUES('$cname','$phone','$name','$price','$quantity','$location','$des','$addedPhoto','$expdate')";
        $success = "Your Product posted successfully";
        if(!mysqli_query($conn,$ins)){ 
        die('Error:'. mysqli_error($conn));
        } 
    }
}

if(!isset($_SESSION['username'])){
            echo " <script> alert('please sign in to add product'); </script>";
            $disable = "disabled";
        }else{
        $disable = "";
        }

?>
<?php include('includes/navbar.php'); ?>
    <section class="py-5">
        <div class="container">
            <div class="row d-flex align-items-center mt-5">
                <div class="col-lg-6 col-sm-12"><img src="images/photo.png" class="img-fluid" alt=""></div>
                <div class="col-lg-6 col-sm-12 py-5">
                    <form action="contact.php" method="post" enctype="multipart/form-data">
                        <div class="row p-3 border-contact">
                            <div class="col-6 my-3"><input type="text" name="cname" placeholder="Customer Name" class="form-control"></div>
                            <div class="col-6 my-3"><input type="text" name="phone" placeholder="Phone" class="form-control"></div>
                            <div class="col-6 my-3"><input type="text" name="name" placeholder="Name" class="form-control"></div>
                            <div class="col-6 my-3"><input type="text" name="price" placeholder="price" class="form-control"></div>
                            <div class="col-6 my-3"><input type="number" name="quantity" placeholder="quantity" class="form-control"></div>
                            <div class="col-6 my-3"><input type="text" name="location" placeholder="Location" class="form-control"></div>
                            <div class="col-12 my-3"><textarea type="text" name="cdes" placeholder="Description" class="form-control"></textarea></div>
                            <div class="col-lg-6 col-sm-12 my-3 py-0"><label>Insert Your Image here</label><input type="file" name="image" class="form-control-file"></div>
                            <div class="col-lg-6 col-sm-12 my-3 py-0"><label>Expiry Date</label><input type="date" name="expdate" class="form-control-file"></div>
                            <div class="col-12 my-3"><button <?php echo $disable ?> type="submit" name="csubmit" class="btn btn-index btn-block">Add Product</button></div>
                        </div>
                    </form>
                </div>
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
<?php include('includes/footer.html'); ?>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>