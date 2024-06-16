<?php 
if (!isset($_SESSION) || session_id() == "" || session_status() === PHP_SESSION_NONE)
session_start() ;

include './cfg/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>FootballPRO | Football boots</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./img/logohead.png">
    <link rel="stylesheet" href="css/header.css"> 
    <link rel="stylesheet" href="css/basic-styles.css">
    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ICONS -->
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JQUERY -->
    <!-- JS -->
    <script src="./js/header.js"></script>
    <script src="./js/drop-list.js"></script>
    <!-- JS -->
  </head>
  <body>
    <header class="header">
      <div class="header__container">
        <div class="top-header__icon icon-menu">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="container__navigation">
          <div class="header__logo">
            <img src="./img/logo.png" alt="">
          </div>
          <div class="header__list">
            <ul class="menu__lisy">
              <li><a class="header__links" href="shop.php">Shop</a></li>
              <li><a class="header__links" href="addproducts.php">Add Products</a></li>
              <li><a class="header__links" href="assortment.php">Assortment</a></li>
            </ul>
          </div>
        </div>
        <div class="header__icons">
          <?php
            $select_product = mysqli_query($conn, "Select * from `productscard`") or die('query failed');
            $row_count=mysqli_num_rows($select_product);
          ?>
          <div class="position-relative">
            <a class="svg-icon" href="cart-bootstrap.php"><i class="fa-solid fa-cart-shopping"></i>
            <span class="nav-badge"><?php echo $row_count ?></span></a>
          </div>
          <?php if (isset($_SESSION['name'])){ ?>
            <div class="user">
                <a href="profile.php"><i class="fas fa-user-circle"></i></a>
            </div>
          <?php } else { ?>
            <nav class="menu__body">
              <ul class="menu__list">
                <li>
                  <a href="login.php" class="menu__link"><i class="fa-solid fa-user"></i></a>
                  <ul class="menu__sub-list">
                    <li><a href="login.php" class="menu__sub-link"><i class="fa-solid fa-arrow-right-to-bracket"></i>LogIN</a></li>
                    <li><a href="register.php" class="menu__sub-link"><i class="fa-solid fa-right-to-bracket"></i>SignUP</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          <?php } ?>
        </div>
      </div>
    </header>
    
