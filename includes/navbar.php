
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
<style>
    .navbar{
    background-color: #392b82;
    padding: 0;
    z-index:999999999999999999999999999;
}
.navbar-dark .navbar-toggler{
    border:none;
}
.menu-btn {
  position: relative;
  display: flex;
  align-items: center;
  width: 80px;
  height: 80px;
  cursor: pointer;
  transition: all .5s ease-in-out;
}
.menu-btn__burger {
  width: 50px;
  height: 6px;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(255,101,47,.2);
  transition: all .5s ease-in-out;
}
.menu-btn__burger::before,
.menu-btn__burger::after {
  content: '';
  position: absolute;
  width: 50px;
  height: 6px;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(255,101,47,.2);
  transition: all .5s ease-in-out;
}
.menu-btn__burger::before {
  transform: translateY(-16px);
}
.menu-btn__burger::after {
  transform: translateY(16px);
}
/* ANIMATION */
.menu-btn.open .menu-btn__burger {
  transform: translateX(-50px);
  background: transparent;
  box-shadow: none;
}
.menu-btn.open .menu-btn__burger::before {
  transform: rotate(45deg) translate(35px, -35px);
}
.menu-btn.open .menu-btn__burger::after {
  transform: rotate(-45deg) translate(35px, 35px);
}
.navbar-brand {
padding: 0;
margin: 0;
}
.navbar-brand img{
    height: 90px;
}
.nav-link{
    padding-bottom: 0;
    font-weight: 500;
}
@media screen and (max-width:600px){
    .nav-link{
        padding: 2rem;
    }
}
</style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
    <a class="navbar-brand" href="index.php"><img src="images/logo2.png"  alt=""></a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <div class="menu-btn">
    <div class="menu-btn__burger"></div>
        </div>    
</button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0 text-uppercase ">
            
            <li class="nav-item px-3">
                <a class="nav-link text-white" href="index.php"><i class="fas fa-home mr-2"></i>home</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link text-white" href="product.php"><i class="fas fa-shopping-bag mr-2"></i>products</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link text-white" href="pro.php"><i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>Cart</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link text-white" href="contact.php"><i class="fas fa-user-plus mr-2"></i>add product</a>
            </li>
            <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item px-3'>
                    <a class='nav-link text-white' href='login.php'><i class='fas fa-user mr-2'></i>login</a>
                    </li>";
                }
                else{
                    echo  " <li class='nav-item dropdown'>
                              <a class='nav-link text-white dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <i class='fas fa-door-open mr-1'></i>Welcome, ".$_SESSION['username']."
                              </a>
                              <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='logout.php'>Logout</a>
                              </div>
                            </li> ";
                }
            ?>
        </ul>
            
    </div>
    </div>
</nav>



<script>

    const menuBtn = document.querySelector('.menu-btn');
    let menuOpen = false;
    menuBtn.addEventListener('click', () => {
  if(!menuOpen) {
    menuBtn.classList.add('open');
    menuOpen = true;
  } else {
    menuBtn.classList.remove('open');
    menuOpen = false;
  }
});
</script>
</body>
</html>