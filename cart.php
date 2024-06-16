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

    header('location:cart.php');
  }

  if(isset($_GET['delete_all'])){
    $delete_all_query=mysqli_query($conn,"DELETE FROM `productscard`");

    header('location:cart.php');
  }

  include 'top_menu.php';
?>
<link rel="stylesheet" href="./css/cart.css">
<div class="container__main">
  <?php

  ?>
  <section class="shopping__cart">
    <h1>My Cart</h1>
    <table>
      <?php
        $select_cart_products = mysqli_query($conn, "Select * from `productscard`");
        $num=1;
        $grand_total=0;
        if(mysqli_num_rows($select_cart_products)>0){
          echo "
            <thead>
              <th>S1 No</th>
              <th>Name</th>
              <th>Image</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Action</th>
            </thead>
            <tbody>
          ";
          while($fetch_cart_products=mysqli_fetch_assoc($select_cart_products)){
            ?>
            <tr>
          <td><?php echo $num ?></td>
          <td><?php echo $fetch_cart_products['name']?></td>
          <td>
            <img src="images/<?php echo $fetch_cart_products['image']?>" alt="" width="111px">
          </td>
          <td>$<?php echo $fetch_cart_products['price']?></td>
          <td>
            <form action="" method="post">
              <input type="hidden" value="<?php echo $fetch_cart_products['productscard_id']?>" name="update_quantity_id">
              <div class="quantity_box">
                
                <input type="number" min="1" value="<?php echo $fetch_cart_products['quantity']?>" name="update_quantity">
                <input type="submit" class="update_quantity" value="Update" name="update_product_quantity">
              </div>
            </form>
          </td>
          <td>
            
            $<?php
              echo $subtotal=number_format($fetch_cart_products['price']*$fetch_cart_products['quantity']);
            ?>
          </td>
          <td>
            <a href="cart.php?remove=<?php echo $fetch_cart_products['productscard_id'] ?>">
              <i class="fa-solid fa-xmark"></i>
            </a>
          </td>
        </tr>
            <?php
  // Перевірка, чи користувач увійшов
  if (isset($_SESSION['name'])) {
    // Отримання сьогоднішньої дати
    $today = date("Y-m-d");

    // Перевірка, чи знижка активна
    $discount_start_date = strtotime($today); // Сьогоднішня дата
    $discount_end_date = strtotime("+5 days", $discount_start_date); // Дата завершення дії знижки
    $current_date = time(); // Поточна дата

    if ($current_date >= $discount_start_date && $current_date <= $discount_end_date) {
      // Якщо поточна дата знаходиться в межах дії знижки
      $discount = 0.1; // Наприклад, знижка 10%
    } else {
      // Якщо дія знижки завершилася
      $discount = 0; // Знижки немає
    }
  } else {
    $discount = 0; // Якщо користувач не увійшов, знижки немає
  }

  $num++;

  // Вирахування загальної вартості з урахуванням знижки
  $grand_total = $grand_total + ($fetch_cart_products['price'] * $fetch_cart_products['quantity']);
  $grand_total_with_discount = $grand_total - ($grand_total * $discount); // Загальна вартість зі знижкою

          }

        }else{
          echo "<div class='empty_text'>Cart is empty</div>";
        }
      ?>
      
      
        
      </tbody>
    </table>
    <?php
    if($grand_total>0){
      echo 
      "
        <div class='table__bottom'>
      <a href='shopie.php' class='bottom__btn'>Continue Shopping</a>
      <h3 class='bottom__btn'>Grant total: <span>$$grand_total</span></h3>
      <h3 class='bottom__btn'>Grand_total_with_discount: <span>$$grand_total_with_discount</span></h3>
      <a href='checkout.php' class='bottom__btn'>Procent to checkout</a>
    </div>
      ";
      ?>
      
    <a href="cart.php?delete_all" class="delete__all">
      <i class="fa-solid fa-trash">Delete All</i>
    </a>
<?php
    }else{
      echo"";
    }

    ?>
  </section>
</div>