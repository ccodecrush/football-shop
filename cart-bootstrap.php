<?php
session_start();
  include './cfg/dbconnect.php';
  
  if(isset($_POST['update_product_quantity'])){
    $update_value=$_POST['update_quantity'];
    $update_id=$_POST['update_quantity_id'];

    $update_quantity_query=mysqli_query($conn, "UPDATE `productscard` SET quantity=$update_value WHERE productscard_id=$update_id");

  }

  if(isset($_GET['remove'])){
    $remove_id=$_GET['remove'];
    $remove_query=mysqli_query($conn,"DELETE FROM `productscard` WHERE productscard_id=$remove_id");

    header('location: cart-bootstrap.php');
  }

  if(isset($_GET['delete_all'])){
    $delete_all_query=mysqli_query($conn,"DELETE FROM `productscard`");

    header('location: cart-bootstrap.php');
  }

  include 'header.php';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="css/cart-bootstrapp.css">
  <title>Document</title>
</head>
<body>
  <div class="container__main">
  <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col"><h4><b>Shopping Cart</b></h4></div>
                            <?php
                $select_product = mysqli_query($conn, "Select * from `productscard`") or die('query failed');
                $row_count=mysqli_num_rows($select_product);


              ?>
                            <div class="col align-self-center text-right text-muted"><?php echo $row_count ?> items</div>
                        </div>
                    </div>
                    <?php
                      $select_cart_products = mysqli_query($conn, "Select * from `productscard`");
                      $grand_total=0;
                      if(mysqli_num_rows($select_cart_products)>0){    
                        while($fetch_cart_products=mysqli_fetch_assoc($select_cart_products)){
                    ?>
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="col"><img  src="images/<?php echo $fetch_cart_products['image']?>"></div>
                            <div class="col">
                                <!-- <div class="row text-muted">$</div> -->
                                <div class="row"><?php echo $fetch_cart_products['name']?></div>
                            </div>
                            <div class="col">
                              <form action="" method="post">
                                 <input type="hidden" value="<?php echo $fetch_cart_products['productscard_id']?>" name="update_quantity_id">
                               <div class="number-input">
                                <button type="submit" name="update_product_quantity" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                                <input type="number" name="update_quantity"class="quantity" min="1"  value="<?php echo $fetch_cart_products['quantity']?>" > 
                                <button type="submit" name="update_product_quantity" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                              </div>
                            </form>
                            </div>
                            <div class="col my-center">&dollar;<?php
              echo $subtotal=number_format($fetch_cart_products['price']*$fetch_cart_products['quantity']);
            ?> </div>
            <div class="col my-center remove-my">
            <a href="cart-bootstrap.php?remove=<?php echo $fetch_cart_products['productscard_id'] ?>">
              <i class="fa-solid fa-xmark "></i>
            </a>
            </div>
          
                        </div>
                        
                    </div>
                    <?php
                      if (isset($_SESSION['name'])) {
                        $today = date("Y-m-d");
                        $discount_start_date = strtotime($today);
                        $discount_end_date = strtotime("+5 days",   $discount_start_date);
                        $current_date = time(); 

                        if ($current_date >= $discount_start_date && $current_date <= $discount_end_date) {
                          $discount = 0.1; 
                        } else {
                          $discount = 0; 
                        }
                      } else {
                        $discount = 0;
                      }

                      $grand_total = $grand_total + ($fetch_cart_products['price'] * $fetch_cart_products['quantity']);
                      $discount_rate = $grand_total * $discount;
                      $total_price = $grand_total - $discount_rate;
                      

                        }
                      }else{
                        echo "<div class='empty_text'>Cart is empty</div>";
                      }
                    ?>
                    <div class="back-to-shop first"><a href="shop.php">Back to shop</a>
                  </div>
                  <div class="back-to-shop delete_all">
                    <a href="cart-bootstrap.php?delete_all" class="delete__all">Delete all</a>
                  </div>
                </div>
                <div class="col-md-4 summary">
                    <div><h5><b>Summary</b></h5></div>
                     <?php
                     if($grand_total>0){
                     ?>
        

                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">Subtotal</div>
                        <div class="col text-right">&dollar;<?php echo $grand_total ?></div>
                    </div>

                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">Discount</div>
                        <div class="col text-right">&dollar;<?php echo $discount_rate ?></div>
                    </div>

                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">Total</div>
                        <div class="col text-right">&euro; <?php echo $total_price ?></div>
                    </div>
                    <?php
    }else{
      echo"";
    }

    ?>
                    <button class="btn">CHECKOUT</button>
                </div>
            </div>
            
        </div>
      </div>
      <script>
        
      </script>
      <?php 
      include 'footer.php';
      ?>
</body>
</html>