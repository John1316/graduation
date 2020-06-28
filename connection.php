 <?php 
  $conn=mysqli_connect("localhost","root",""); 
  if(!$conn){ 
      die('database connection fail: '.mysqli_error());
    }
  mysqli_select_db($conn,"bisians"); 
 ?>
