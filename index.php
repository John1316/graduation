<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="shortcut icon" href="images/logo2.png" type="image/x-icon">
    <title>Main page</title>
	<style>
        /* .product-img{
            border:1px solid black;
        }
        .product-img:before{
            content:"";
            position:absolute;
            top:-2px;
            bottom:-2px;
            right:-2px;
            left:-2px;
            background:#fff;
            transform:skew(2deg,2deg);
            z-index:-1;

        }
        .product-img:nth-child(1):before{
            background:linear-gradient(90deg,#ff0057,#e64a19);
        } */
        /* .stylish-border:nth-child(2):before{
            background:linear-gradient(90deg,#ff0057,#e64a19);
        }
        .stylish-border:nth-child(3):before{
            background:linear-gradient(90deg,#ff0057,#e64a19);
        } */
        #btnUp:hover{
            background-color: #392b82;
        }
        #comment:hover{
            background-color: #392b82;
        }
        .contactus li{
            font-size:22px;
        }
        .contactus p{
            color:#777;
        }
    @media screen and (min-width:750px)
    {
        .advisor img{
            height:264px;
        }
    }
    @media screen and (max-width:450px)
    {
        #options h2{
            font-size:40px;
        }
    }
    @media screen and (max-width:1000px){
        .contactus iframe{
            max-width: 100%;
            margin: 20px 0px;
        }
        .contactus {
            text-align: center;
            padding: 20px;
        }
    }
	</style>
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
</head>

<body>

    <!--start navbar-->
        <?php include('includes/navbar.php'); ?>
	<!--end navbar-->

	<section id="loading">
<div class="sk-folding-cube">
  <div class="sk-cube1 sk-cube"></div>
  <div class="sk-cube2 sk-cube"></div>
  <div class="sk-cube4 sk-cube"></div>
  <div class="sk-cube3 sk-cube"></div>
</div>
</section>

    <button id="btnUp" class="btn btnup bg-white">
    <i class="fas fa-2x fa-caret-up"></i>
    </button>
    <button id="comment" class="btn bg-white">
    <i class="fas fa-2x fa-comments"></i>
	</button>
	<?php
	require_once('connection.php');
	if(isset($_POST['submit'])){
    
    $rate= $_POST['rate'];
    $message= $_POST['revmessage'];
                
        $ins= "INSERT INTO rate (scale,msg) VALUES('$rate','$message')";

	        if(!mysqli_query($conn,$ins)){ 
                die('Error:'. mysqli_error($conn));
	        }
	        else{
	    	    echo "<script>Your rating submited successfully</script>";
	        }
    }


?>
    <div id="options">
        <div id="color-options">
		    <h2>Rate Us</h2>
			<div class="brdr"></div>
			<form action="index.php" method="post">
                <div class="form-group my-3">
                    <select class="form-control" name="rate" id="exampleFormControlSelect1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <!-- <input type="number" name="rate" placeholder="Rate" class="form-control my-4"> -->
				<input type="text" name="revmessage" placeholder="Your message" class="form-control my-4"> <!-- 5aliha select options -->
				<input type="submit" name="submit" class="btn btn-index">
			</form>    
        </div> 
    </div>                          
    <!-- start home-->
    <section id="home">
        <div class="home position-relative d-flex align-items-center ">
            <div class="row">
                <div class="pos col-6">
                    <img class="animated slideInLeft" src="images/layerall.png" alt="">
                    <h1 class="my-2 animated slideInLeft delay-1s">Health is <span><br> priority </span> </h1>
                    <h3 class="my-2 animated slideInLeft delay-1s">We are here to help you... </h3>
                </div>
                <div class="pos2 col-6">
                    <img src="images/pic2.jpeg" class="animated slideInRight" alt="">
                </div>
            </div>
            <a class="section_scroll scroll ff " href="#about">
                <i class="fa fa-angle-down fa-4x swap"></i>
            </a>
        </div>
    </section>
    <!--end home-->

    <!-- start about -->
    
    <section id="about" class="about py-5">
        <div class="container">
            <h1 class="text-center">How We Work</h1>
            <div class="brdr mb-4"></div>
            <div class="upper-about my-4">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 my-4 text-center wow animated rotateInDownLeft">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-2x my-3 fa-clipboard-check"></i>
                                <h5 class="card-subtitle my-3">Select Order</h5>
                                <p class="card-text my-3">Relax and get your order delivered to your door step.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12  my-4 text-center wow animated slideInDown">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-3x my-2 fa-map-marked-alt"></i>
                                <h5 class="card-subtitle my-3">Compare and Select</h5>
                                <p class="card-text my-3">Submit your request and wait for responses, select and locate your self.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12  my-4 text-center wow animated rotateInDownRight">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-2x my-3 fa-truck"></i>
                                <h5 class="card-subtitle my-3">Receive Order</h5>
                                <p class="card-text my-3">Relax and get your order delivered to your door step.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lower-about">
                <div class="row">
                    <div class="left-lower col-lg-5 my-5 wow animated slideInLeft delay-1s">
                        <h3 class="my-3">Our Services</h3>
                        <p class="my-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur fugiat reprehenderit officiis sequi doloribus nam in numquam libero laborum beatae! Nobis neque, saepe aliquid quam assumenda sed perferendis officia iste eveniet sunt adipisci voluptatem, magni minima id! Laborum officiis et odio deserunt placeat dolorum nesciunt quasi laudantium praesentium esse doloremque vel alias, quas accusamus dignissimos quia eum reprehenderit ut animi labore a! In, architecto sapiente aut autem rem maiores laboriosam.</p>
                    </div>
                    <div class="right-lower col-lg-6 wow animated slideInRight delay-1s">
                        <img src="images/medicine.svg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>


        </div>

    </section>
    <!-- end about-->

    <!-- Start products-->
    <section class="products py-5">
        <h1 class="text-center mt-4">Sample of our products</h1>
        <div class="brdr mb-4"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 my-2 stylish-border wow animated fadeInLeft delay-1s">
                    <div class="product-img">
                        <img src="product-images/nex.jpg" class="img-fluid" alt="screenshot">
                        <div class="product-overlay d-flex justify-content-center align-items-center text-white">
                            <h5>Nexuim 40</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 my-2 stylish-border wow animated fadeInDown delay-1s">
                    <div class="product-img">
                        <img src="product-images/eltro.jpg" class="img-fluid" alt="screenshot">
                        <div class="product-overlay d-flex justify-content-center align-items-center text-white">
                            <h5>Eltroxin 100</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 my-2 stylish-border wow animated fadeInRight delay-1s">
                    <div class="product-img">
                        <img src="product-images/statin.jpg" class="img-fluid" alt="screenshot">
                        <div class="product-overlay d-flex justify-content-center align-items-center text-white">
                            <h5>Statin</h5>
                        </div>
                    </div>
                </div>
                <div class="col text-center my-5 wow animated fadeInUp delay-2s">
                    <a href="product.php" class="btn-liquid"><span class="inner">See our products here</span></a>
                </div>
            </div>
        </div>
    </section>
    <!-- End products-->

    <!-- start advisors-->
    <!-- <section class="advisors py-5">
        <div class="container">
            <div class="beg text-center my-3">
                <h1>Meet Our Team</h1>
                <div class="brdr"></div>
            </div>
            <div class="row">
                <div class="col-lg my-3 wow animated zoomInLeft">
                    <div class="advisor">
                        <img src="images/WhatsApp Image 2020-05-19 at 9.18.31 PM (1).jpeg" class="img-fluid">
                        <div class="py-3 advisor-info text-center">
                            <span>It developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg my-3 wow animated zoomInLeft delay-1s">
                    <div class="advisor">
                        <img src="images/mary.jpeg" class="img-fluid">
                        <div class="py-3 advisor-info text-center">
                            <span>Backend supervisior</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg my-3 wow animated zoomInUp delay-2s">
                    <div class="advisor">
                        <img src="images/ber.jpeg" class="img-fluid">
                        <div class="py-3 advisor-info text-center">
                            <span>Manager</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg my-3 wow animated zoomInRight delay-3s">
                    <div class="advisor">
                        <img src="images/vero.jpeg" class="img-fluid">
                        <div class="py-3 advisor-info text-center">
                            <span>Finanacial leader</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg my-3 wow animated zoomInRight delay-4s">
                    <div class="advisor">
                        <img src="images/dany.jpeg" class="img-fluid">
                        <div class="py-3 advisor-info text-center">
                            <span>Marketing mananger</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- start advisors-->

    <section class="contactus py-5">
        <div class="container">
            <h1>Contact Us</h1>
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 col-sm-12">
                    <ul class="list-unstyled">
                        <li class="my-3 py-2"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem atque aut tenetur vel esse unde necessitatibus quasi accusamus sint aspernatur.</p></li>
                        <li class="my-3"><i class="fas fa-address-book mr-1"></i>Conatct Details:</li>
                            <li class="my-3 py-2"><i class="fa fa-location-arrow mr-3"></i>8 phaoroes bulidings</li>
                            <li class="my-3 py-2"><i class="fas fa-mobile-alt mr-3"></i>01149917963</li>
                            <li class="my-3 py-2"><i class="fas fa-at mr-2"></i>medishare8@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3078.82517068075!2d31.1524446739454!3d29.98333748655518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145845edbf2545fb%3A0x2d83fba2be0cf93c!2sNazlet%20Al%20Batran%2C%20Al%20Haram%2C%20Giza%20Governorate!5e0!3m2!1sen!2seg!4v1591623908775!5m2!1sen!2seg" width="550" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- start last part-->
    <?php include('includes/footer.html'); ?>
    <!-- end last part-->



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.js"></script>
    <script>
        $(window).on("scroll", function() {
            if ($(window).scrollTop()) {
                $("nav").addClass("bg-nav");
            } else {
                $("nav").removeClass("bg-nav");
            }
        });

        new WOW().init();

		$(window).scroll(function(){
    let scrollTop = $(window).scrollTop();
if ( scrollTop > 800)
{
    $("#btnUp").fadeIn(500)
}
else{
   $("#btnUp").fadeOut(500)

}
})
$("#btnUp").click(function(){
   $("body,html").animate({scrollTop:0},1000)
})


$(document).ready(function(){
    $("#loading").fadeOut(2500 , function(){
        $("body").css("overflow","auto")
    });
    });

$("#comment").click(function(){
    $("#color-options").slideToggle(1500);
});
$("#color-options").hide();



        $(function() {
            // Vars
            var pointsA = [],
                pointsB = [],
                $canvas = null,
                canvas = null,
                context = null,
                vars = null,
                points = 8,
                viscosity = 20,
                mouseDist = 70,
                damping = 0.05,
                showIndicators = false;
            mouseX = 0,
                mouseY = 0,
                relMouseX = 0,
                relMouseY = 0,
                mouseLastX = 0,
                mouseLastY = 0,
                mouseDirectionX = 0,
                mouseDirectionY = 0,
                mouseSpeedX = 0,
                mouseSpeedY = 0;

            /**
             * Get mouse direction
             */
            function mouseDirection(e) {
                if (mouseX < e.pageX)
                    mouseDirectionX = 1;
                else if (mouseX > e.pageX)
                    mouseDirectionX = -1;
                else
                    mouseDirectionX = 0;

                if (mouseY < e.pageY)
                    mouseDirectionY = 1;
                else if (mouseY > e.pageY)
                    mouseDirectionY = -1;
                else
                    mouseDirectionY = 0;

                mouseX = e.pageX;
                mouseY = e.pageY;

                relMouseX = (mouseX - $canvas.offset().left);
                relMouseY = (mouseY - $canvas.offset().top);
            }
            $(document).on('mousemove', mouseDirection);

            /**
             * Get mouse speed
             */
            function mouseSpeed() {
                mouseSpeedX = mouseX - mouseLastX;
                mouseSpeedY = mouseY - mouseLastY;

                mouseLastX = mouseX;
                mouseLastY = mouseY;

                setTimeout(mouseSpeed, 50);
            }
            mouseSpeed();

            /**
             * Init button
             */
            function initButton() {
                // Get button
                var button = $('.btn-liquid');
                var buttonWidth = button.width();
                var buttonHeight = button.height();

                // Create canvas
                $canvas = $('<canvas></canvas>');
                button.append($canvas);

                canvas = $canvas.get(0);
                canvas.width = buttonWidth + 100;
                canvas.height = buttonHeight + 100;
                context = canvas.getContext('2d');

                // Add points

                var x = buttonHeight / 2;
                for (var j = 1; j < points; j++) {
                    addPoints((x + ((buttonWidth - buttonHeight) / points) * j), 0);
                }
                addPoints(buttonWidth - buttonHeight / 5, 0);
                addPoints(buttonWidth + buttonHeight / 10, buttonHeight / 2);
                addPoints(buttonWidth - buttonHeight / 5, buttonHeight);
                for (var j = points - 1; j > 0; j--) {
                    addPoints((x + ((buttonWidth - buttonHeight) / points) * j), buttonHeight);
                }
                addPoints(buttonHeight / 5, buttonHeight);

                addPoints(-buttonHeight / 10, buttonHeight / 2);
                addPoints(buttonHeight / 5, 0);
                // addPoints(x, 0);
                // addPoints(0, buttonHeight/2);

                // addPoints(0, buttonHeight/2);
                // addPoints(buttonHeight/4, 0);

                // Start render
                renderCanvas();
            }

            /**
             * Add points
             */
            function addPoints(x, y) {
                pointsA.push(new Point(x, y, 1));
                pointsB.push(new Point(x, y, 2));
            }

            /**
             * Point
             */
            function Point(x, y, level) {
                this.x = this.ix = 50 + x;
                this.y = this.iy = 50 + y;
                this.vx = 0;
                this.vy = 0;
                this.cx1 = 0;
                this.cy1 = 0;
                this.cx2 = 0;
                this.cy2 = 0;
                this.level = level;
            }

            Point.prototype.move = function() {
                this.vx += (this.ix - this.x) / (viscosity * this.level);
                this.vy += (this.iy - this.y) / (viscosity * this.level);

                var dx = this.ix - relMouseX,
                    dy = this.iy - relMouseY;
                var relDist = (1 - Math.sqrt((dx * dx) + (dy * dy)) / mouseDist);

                // Move x
                if ((mouseDirectionX > 0 && relMouseX > this.x) || (mouseDirectionX < 0 && relMouseX < this.x)) {
                    if (relDist > 0 && relDist < 1) {
                        this.vx = (mouseSpeedX / 4) * relDist;
                    }
                }
                this.vx *= (1 - damping);
                this.x += this.vx;

                // Move y
                if ((mouseDirectionY > 0 && relMouseY > this.y) || (mouseDirectionY < 0 && relMouseY < this.y)) {
                    if (relDist > 0 && relDist < 1) {
                        this.vy = (mouseSpeedY / 4) * relDist;
                    }
                }
                this.vy *= (1 - damping);
                this.y += this.vy;
            };


            /**
             * Render canvas
             */
            function renderCanvas() {
                // rAF
                rafID = requestAnimationFrame(renderCanvas);

                // Clear scene
                context.clearRect(0, 0, $canvas.width(), $canvas.height());
                context.fillStyle = '#fff';
                context.fillRect(0, 0, $canvas.width(), $canvas.height());

                // Move points
                for (var i = 0; i <= pointsA.length - 1; i++) {
                    pointsA[i].move();
                    pointsB[i].move();
                }

                // Create dynamic gradient
                var gradientX = Math.min(Math.max(mouseX - $canvas.offset().left, 0), $canvas.width());
                var gradientY = Math.min(Math.max(mouseY - $canvas.offset().top, 0), $canvas.height());
                var distance = Math.sqrt(Math.pow(gradientX - $canvas.width() / 2, 2) + Math.pow(gradientY - $canvas.height() / 2, 2)) / Math.sqrt(Math.pow($canvas.width() / 2, 2) + Math.pow($canvas.height() / 2, 2));

                var gradient = context.createRadialGradient(gradientX, gradientY, 300 + (300 * distance), gradientX, gradientY, 0);
                gradient.addColorStop(0, '#102ce5');
                gradient.addColorStop(1, '#E406D6');

                // Draw shapes
                var groups = [pointsA, pointsB]

                for (var j = 0; j <= 1; j++) {
                    var points = groups[j];

                    if (j == 0) {
                        // Background style
                        context.fillStyle = '#1CE2D8';
                    } else {
                        // Foreground style
                        context.fillStyle = gradient;
                    }

                    context.beginPath();
                    context.moveTo(points[0].x, points[0].y);

                    for (var i = 0; i < points.length; i++) {
                        var p = points[i];
                        var nextP = points[i + 1];
                        var val = 30 * 0.552284749831;

                        if (nextP != undefined) {
                            // if (nextP.ix > p.ix && nextP.iy < p.iy) {
                            // 	p.cx1 = p.x;
                            // 	p.cy1 = p.y-val;
                            // 	p.cx2 = nextP.x-val;
                            // 	p.cy2 = nextP.y;
                            // } else if (nextP.ix > p.ix && nextP.iy > p.iy) {
                            // 	p.cx1 = p.x+val;
                            // 	p.cy1 = p.y;
                            // 	p.cx2 = nextP.x;
                            // 	p.cy2 = nextP.y-val;
                            // }  else if (nextP.ix < p.ix && nextP.iy > p.iy) {
                            // 	p.cx1 = p.x;
                            // 	p.cy1 = p.y+val;
                            // 	p.cx2 = nextP.x+val;
                            // 	p.cy2 = nextP.y;
                            // } else if (nextP.ix < p.ix && nextP.iy < p.iy) {
                            // 	p.cx1 = p.x-val;
                            // 	p.cy1 = p.y;
                            // 	p.cx2 = nextP.x;
                            // 	p.cy2 = nextP.y+val;
                            // } else {

                            p.cx1 = (p.x + nextP.x) / 2;
                            p.cy1 = (p.y + nextP.y) / 2;
                            p.cx2 = (p.x + nextP.x) / 2;
                            p.cy2 = (p.y + nextP.y) / 2;

                            context.bezierCurveTo(p.x, p.y, p.cx1, p.cy1, p.cx1, p.cy1);
                            // 	continue;
                            // }

                            // context.bezierCurveTo(p.cx1, p.cy1, p.cx2, p.cy2, nextP.x, nextP.y);
                        } else {
                            nextP = points[0];
                            p.cx1 = (p.x + nextP.x) / 2;
                            p.cy1 = (p.y + nextP.y) / 2;

                            context.bezierCurveTo(p.x, p.y, p.cx1, p.cy1, p.cx1, p.cy1);
                        }
                    }

                    // context.closePath();
                    context.fill();
                }

                if (showIndicators) {
                    // Draw points
                    context.fillStyle = '#000';
                    context.beginPath();
                    for (var i = 0; i < pointsA.length; i++) {
                        var p = pointsA[i];

                        context.rect(p.x - 1, p.y - 1, 2, 2);
                    }
                    context.fill();

                    // Draw controls
                    context.fillStyle = '#f00';
                    context.beginPath();
                    for (var i = 0; i < pointsA.length; i++) {
                        var p = pointsA[i];

                        context.rect(p.cx1 - 1, p.cy1 - 1, 2, 2);
                        context.rect(p.cx2 - 1, p.cy2 - 1, 2, 2);
                    }
                    context.fill();
                }
            }

            // Init
            initButton();
        });

    </script>
</body>

</html>
