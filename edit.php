<?php
include './cfg/dbconnect.php';
include 'shop.php';
?>


    <link rel="stylesheet" href="./css/form.css">


  
  <div class="container__main">
<div class="box form-container">
  <?php 
    if(isset($_GET['edit'])){
      $edit_id=$_GET['edit'];
      $edit_query=mysqli_query($conn, "SELECT * FROM `footballboots` where boots_id=$edit_id");

      if(mysqli_num_rows($edit_query)>0){
        $fetch_date=mysqli_fetch_assoc($edit_query);
        
         ?>
         <form action="#" method="post" enctype="multipart/form-data">
    <div class="inputBox">
      <img class="product__img img-upload" src="images/<?php echo $fetch_date['image'] ?> " alt="">
      <input type="hidden" value="<?php echo $fetch_date['boots_id'] ?>" name="update_product_id">
      <input class="top" type="text" name="update_product_name" autocomplete="off" required value="<?php echo $fetch_date['name'] ?>"  >
    </div>
    <div class="inputBox">
      <input type="number" name="update_price" id="price" autocomplete="off" min="0" required value="<?php echo $fetch_date['price'] ?>">
    </div>
    <select name="sources" id="sources" class="custom-select sources" placeholder="Producer">
      <?php 

        $categories = mysqli_query($conn, "Select * from producers");
        while($c = mysqli_fetch_array($categories)){
      ?>
        <option value="<?php echo $c['producer_id'] ?>"><?php echo $c['name'] ?></option>
        <?php } ?>    
      </select>
    <div class="upload">
      <button type="button" class="btn-warning ">
        <i class="fa-solid fa-upload"></i>Upload File
        <input name="update_product_image" type="file" required accept="image/png, image/jpg, image/jpeg">
      </button>
    </div>
    <div class="btns__edit">
      <input type="submit" class="upload__btn" value="Update Product" name="update_product">
      <input type="reset" id="close__edit" class="cancel__btn" value="Reset">
    </div>
    
    </form>
         <?php
                }
              }
           
         ?>
     
  
  <script src="./js/select-option.js"></script>
 
  <!-- <h2>Add Products</h2> -->
  
</div>
</div>
</body>
</html>