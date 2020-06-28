<!--  -->
<html>

<head>
    <title>Insert product</title>

    <style>
    body {
        text-align:center;
        background-color: black;
        color: white;
    }
    </style>
</head>

<body>

    <?php
require_once('connection.php'); 
            $uname = $_POST['hiduname']; 
            $name = $_POST['hidname'];
            $phone = $_POST['hidphone'];
            $address = $_POST['hidaddress'];
            $quan = $_POST['hidquan']; 
            $code = $_POST['hidcode']; 
            $uprice = $_POST['hiduprice'];

            $ins= "INSERT INTO acceptedorders (uname,name,phone,address,quan,code,uprice) VALUES('$uname','$name','$phone','$address','$quan','$code','$uprice')";
    
if(!mysqli_query($conn,$ins)){ 
    die('Error:'. mysqli_error($conn));
} else {
    echo"<h1>Your information was Inserted successfully.</h1>"."<br>";
}

?>
    <h3> Please press <a href='products.php'>here</a> to see products </h3>
</body>

</html>