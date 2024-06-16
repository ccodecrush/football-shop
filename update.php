<?php
  include './cfg/dbconnect.php';
  if(isset($_POST['update_product']))
  {
    $update_product_id=$_POST['update_product_id'];
    $update_product_name=$_POST['update_product_name'];
    $update_price=$_POST['update_price'];
    $sources=$_POST['sources'];
    $update_product_image=$_FILES['update_product_image']['name'];
    $update_product_image_tmp_name=$_FILES['update_product_image']['tmp_name'];  
    $update_product_image_folder='images/'.$update_product_image;

    $update_products=mysqli_query($conn, "UPDATE `footballboots` SET name='$update_product_name',  price='$update_price', producer_id='$sources', image='$update_product_image' where boots_id=$update_product_id");

    if($update_products)
    {
      move_uploaded_file($update_product_image_tmp_name, $update_product_image_folder);
      header("location: view_products.php");
    }else{
      $display_message = "Error";
    }
  }
  include 'header.php';
?>
<link rel="stylesheet" href="./css/forms.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<div class="container">
  <?php
    if(isset($display_message)) {
      echo "<div class='display_message'>
              <span>$display_message</span>
              <i class='fas fa-times' onclick='this.parentElement.style.display=`none`;'></i>
            </div>";
    }
  ?>
</div>
<div class="container-update">
<section class="box ">
  <?php
      if(isset($_GET['edit']))
      {
          $edit_id=$_GET['edit'];
          $edit_query=mysqli_query($conn, "Select * from `footballboots` where boots_id=$edit_id");

          if(mysqli_num_rows($edit_query)>0){
            $fetch_date=mysqli_fetch_assoc($edit_query);     
  ?> 
  
  
  <form action="" method="post" enctype="multipart/form-data">
    <img class="product__img img-upload" src="images/<?php echo $fetch_date['image'] ?>" alt="<?php echo $fetch_date['name'] ?>">
    <div class="inputBox">
      <input type="hidden" value="<?php echo $fetch_date['boots_id'] ?>" name="update_product_id">
      <input class="top" type="text" value="<?php echo $fetch_date['name'] ?>" name="update_product_name" required>
    </div>
    <div class="inputBox">
      <input type="number" value="<?php echo $fetch_date['price'] ?>" name="update_price" required>
    </div>
    <select name="sources" id="sources" class="custom-select sources" placeholder="Producer">
      <?php 
        $categories = mysqli_query($conn, "Select * from producers");
        while($c = mysqli_fetch_array($categories)){
      ?>
        <option value="<?php echo $c['producer_id'] ?>"><?php echo $c['producer_name'] ?></option>
        <?php } ?>    
    </select>
<input type="file" name="update_product_image" required accept="image/png, image/jpg, image/jpeg" class="block w-full text-sm text-white border-2 border-blue-300 rounded cursor-pointer bg-transparent dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input">

    <div class="btns__edit">
      <input class="upload__btn" type="submit" name="update_product">
      <input class="cancel__btn" type="reset" id="close-edit" value="reset">
    </div>
  </form>
  <?php
          }
      }
  ?>
  <script src="./js/select-option.js"></script>
</section>
</div>