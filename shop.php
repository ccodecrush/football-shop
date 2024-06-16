<?php
  include './cfg/dbconnect.php';
  
  if(isset($_POST['add_to_cart']))
  {
    $products_name = $_POST['product_name'];
    $products_price = $_POST['product_price'];
    $products_image = $_POST['product_image'];
    $product_quantity=1;

    $select_cart = mysqli_query($conn, "Select * from `productscard` where name='$products_name'");
    if(mysqli_num_rows($select_cart)>0)
    {
      $display_message[]="Product already added to cart";
    }else{
      $add_products = mysqli_query($conn, "INSERT INTO `productscard` (name, price, image, quantity) VALUE ('$products_name', '$products_price', '$products_image', $product_quantity)");
      $display_message[]="Product added to cart";
    }

    
  }
?>
<?php
include "header.php";
?>
<link rel="stylesheet" href="./css/shopy.css">

<div class="container__shop">
  <?php if (isset($_SESSION['name'])){ ?>
    <div class="banner-container">
<div class="banner">
        <div class="content" id="banner1">
          <div class="width">
             <span>you get a</span>
            <h3>10% discount</h3>
            <p>offer VALID FOR 5 DAYS</p>
          </div>
           
        </div>
    </div>
    </div>
    
  <?php } ?>
  <div class="container">
  <?php
    if(isset($display_message)) {
      foreach($display_message as $display_message){
      echo "<div class='display_message'>
              <span>$display_message</span>
              <i class='fas fa-times' onclick='this.parentElement.style.display=`none`;'></i>
            </div>";
    }
  }
  ?>
</div>
  <section id="product1" class="section-p1">
    <h2>Products</h2>
    <div class="pro-container">
      <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `footballboots` INNER JOIN producers ON footballboots.producer_id = producers.producer_id");

        if(mysqli_num_rows($select_products)>0)
        {
          while($row=mysqli_fetch_assoc($select_products)){
      ?>
      <div class="pro">
        <form action="#" method="post">
          <div class="pro-img">
            <img src="images/<?php echo $row['image'] ?>" alt="<?php echo $row['image'] ?>">
          </div>
          
          <div class="des">
            <span><?php echo $row['producer_name'] ?></span>
            <h5><?php echo $row['name'] ?></h5>
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h4 class="price">$<?php echo $row['price'] ?></h4>
          </div>
          <input type="hidden" name="product_name" value="<?php echo $row['name'] ?>">
          <input type="hidden" name="product_price" value="<?php echo $row['price'] ?>">
          <input type="hidden" name="product_image" value="<?php echo $row['image'] ?>">
          <button type="submit" class="cart" name="add_to_cart"><i class="fa-solid fa-cart-shopping"></i></button>
      </form>
    </div> 
  
  
      <?php
      }
        }else{
          echo "No products";
        }
      ?>
    </div>
  </section>
</div>
<?php
include "footer.php";
?>

</body>
</html>
