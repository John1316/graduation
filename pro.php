<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<html>

<head>
    <title>Shopping Cart</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="css/all.css" type="text/css" rel="stylesheet" />
    <link href="pro.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
	<style>
        .modal{
            z-index:9999999999999999999999999999;

        }
		.btn-empty{
            margin:120px 20px 20px 20px;
        }
        .card td img{
            width: 25px;
            height: 25px;
            border-radius: 50%;
        }
        .card .delete {
            width: 55px;
            height: 55px;
            border-radius: 50%;
        }
        table{
            text-align: center;
        }
        .img {
            height:180px;
        }
        .cart .card{
        border: 3px solid #392b82;
        }
        .cart .btn-primary{
            background-color: #392b82;
            color: #fff;
        }
        .cart .btn-primary:hover{
            background-color: #392b82;
            color: #fff;
        }
        .cart .form-control{
            border: 3px solid #392b82;
        }
        @media screen and (max-width:800px){
            
            .cart .col-lg-8 img{
                width:100%;
            }
            .cart .col-lg-4 button{
                width:100% !important;
            }
            
        }
        @media screen and (min-width:801px){
            
            .cart .col-lg-8 img{
                width:650px;
                height:500px;
            }
        }
        @media screen and (min-width:1025px){
            
            .cart .col-lg-8 img{
                width:800px;
                height:500px;
            }
        }
        
	</style>

</head>

<body>
    <?php include('includes/navbar.php'); ?>

    
    
   <a class="btn-empty btn btn-outline-danger float-right" href="pro.php?action=empty">Empty Cart</a>
        <div class="clearfix"></div>
    <section class="cart">
        <div class="container-fluid">
        <?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
        
                <?php	
                require_once('connection.php');
if(isset($_POST['submit']))	{
    $uname = $_POST['uname']; 
    $name = $_POST['hidname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $quan = $_POST['hidquan']; 
    $visa = sha1($_POST['visa']); 
    $cvv = sha1($_POST['cvv']); 
    $code = $_POST['hidcode']; 
    $uprice = $_POST['hiduprice'];
    $tprice = $_POST['hidutprice'];
        if ((empty($uname)) || (empty($phone)) || (empty($address)) || (empty($visa)) || (empty($cvv)) )
            {
            	$error ="You must fill this field to know your information well";
            }
                else{
                    $ins= "INSERT INTO orders (users_id,cust_name,name,cust_phone,cust_add,quan,visa,cvv,code,uprice,tprice) VALUES(".$_SESSION['users_id'].",'$uname','$name','$phone','$address','$quan','$visa','$cvv','$code','$uprice' ,'$tprice')";
                    
                    if (!mysqli_query($conn, $ins)) {
                        die('Error:'. mysqli_error($conn));
                    } else {
                        $succeed ="Your information inserted successfully";
                    }
                }
}
?>

                        <?php if(isset($succeed)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?= $succeed ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $error ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>

<?php
 if(!isset($_SESSION['username'])){
            echo " <script> alert('please sign in to checkout'); </script>";
            $disable = "disabled";
        }else{
        $disable = "";
        }
        
    foreach ($_SESSION["cart_item"] as $item){
        $service = 20;
        $item_price = ($item["quantity"]*$item["price"])+$service;
		?>        
                        
    
            <div class="row mb-4">
                <div class="col-lg-8 col-sm-12"><img src="<?php echo $item["image"]; ?>" alt=""></div>
                <div class="col-lg-4 col-sm-12 py-5">
                    <div class="col-lg-9 col-sm-12 card my-3">
                        <div class="card-body">
                                <p class="card-title">Name : <span class="float-right"><?php echo $item["name"]; ?></span></p>
                                
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-12 card">
                        <div class="card-body">
                            <p class="card-title">Unit price : <span class="float-right"><?php echo $item["price"]; ?></span></p>
                            <p class="card-title">Total Quantity : <span class="float-right"><?php echo $item["quantity"]; ?></span></p>
                            <p class="card-title">Service : <span class="float-right">LE <?php echo $service ?></span></p>
                            <hr>
                            <h5 class="card-title">Total price <span class="float-right"><?php echo $item_price ?></span></h5>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <button id="disableBtn" <?php echo $disable ?>
                data-toggle="modal" data-target="#check<?php echo $item["code"]?>" class="btn btn-primary btn-block my-3 w-75" type="button">Check out</button>
                </div>
                
            </div>
    <div class="modal fade" id="check<?php echo $item["code"]?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                    <form action="pro.php" method="post">
                        <div class="row">
                            <input type="hidden" name="hidname" value="<?php echo $item["name"]; ?>">
                            <input type="hidden" name="hidquan" value="<?php echo $item["quantity"]; ?>">
                            <input type="hidden" name="hidcode" value="<?php echo $item["code"]; ?>">
                            <input type="hidden" name="hiduprice" value="<?php echo $item["price"]; ?>">
                            <input type="hidden" name="hidutprice" value="<?php echo $item_price ?>">
                            <div class="col-6 my-2"><p class="card-title">Product Name</p></div>
                            <div class="col-6 my-2"><p class="card-text"><?php echo $item["name"]; ?> </div>
                            <div class="col-6 my-2"><p class="card-title">Product Price</p></div>
                            <div class="col-6 my-2"><p class="card-text"> <?php echo $item["price"]; ?> </div>
                            <div class="col-6 my-2"><p class="card-title">Product Quantity</p></div>
                            <div class="col-6 my-2"><p class="card-text"> <?php echo $item["quantity"]; ?></div>
                            <div class="col-6 my-2"><p class="card-title">Product code</p></div>
                            <div class="col-6 my-2"><p class="card-text"> <?php echo $item["code"]; ?></div>
                            <div class="col-6 my-2"><p class="card-title">Product Service</p></div>
                            <div class="col-6 my-2"><p class="card-text"> <?php echo $service ?></div>
                            <div class="col-6 my-2"><h5 class="card-title">Total Price</h5></div>
                            <div class="col-6 my-2"><p class="card-text"> <?php echo $item_price ?></div>
                            <div class="col-6 my-2"><input type="text" name="uname" placeholder="Your Name" class="form-control"></div>
                            <div class="col-6 my-2"><input type="text" name="phone" placeholder="Your Phone" class="form-control"></div>
                            <div class="col-8 my-2"><input type="number" name="visa" placeholder="Your Visa" class="form-control"></div>
                            <div class="col-4 my-2"><input type="number" name="cvv" placeholder="Your Cvv" class="form-control"></div>
                            <div class="col-12 my-2"><textarea name="address" placeholder="Your address"  class="form-control"></textarea></div>
                            <div class="col-12"><button type="submit" name="submit" class="btn btn-primary btn-block">Check out</button></div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php
				
	}
		?>


    
            
            </div>
        </div>
    </section>
        <?php
} else {
?>
        <h5 class="no-records">Your Cart is Empty</h5>
        <?php 
}
?>
    </div>
    <section class="card-prod">
        <div class="container">
		<h2>Products</h2>
        <div class="brdr mb-3"></div>
            <div class="row">
            <?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
                <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-3">
                    <form method="post" action="pro.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                        <div class="card">
                            <img src="<?php echo $product_array[$key]["image"]; ?>" class="img" alt="<?php echo $product_array[$key]["name"]; ?>">
                            <div class="card-body">
                                <p class="card-title"><b><?php echo $product_array[$key]["name"]; ?></b></p>
                                <div class="product-price my-3"><button type="button" class="btn btn-info">
                                        LE <span class="badge badge-light"><?php echo "$".$product_array[$key]["price"]; ?></span>
                                    </button></div>
                                <div class="cart-action my-2"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btn btn-index m-2" /></div>
                            </div>
                        </div>
                    </form>
                </div>
    <?php
	}
	}
	?>
            </div>
        </div>
    </section>
    <?php include('includes/footer.html'); ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
