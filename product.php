<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/product.css">
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
    <style>
    .h3{
        font-family: 'Sacramento', cursive;
        font-size:30px;
        font-weight:500;
    }
    .h4{
        font-size:25px;
        font-weight:500;
    }
    .modal{
        z-index:999999999999999999999999999999999999999;
    }
    </style>
    <title>Our products</title>
</head>

<body>
    <?php include('includes/navbar.php'); ?>
        <section class="py-5">
        <div class="container">
            <form class="pt-5">
                <div class="form-group input-group">
                    <input name="search_text" id="search_text" type="text" class="form-control mt-5" placeholder="Search for...">
                </div>
            </form>
            <section class="py-3">
            <h2>Products</h2>
            <div class="brdr mb-2"></div>
                <div id="result" class="row"></div>
            </section>
            </div>
        </section>
            



    

    <?php include('includes/footer.html'); ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
    </script>
</body>

</html>
