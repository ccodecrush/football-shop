<?php
  include "header.php";
?>
<link rel="stylesheet" href="./css/form.css">
<div class="container">
  <?php
    if(isset($_SESSION['display_message'])) {
      echo "<div class='display_message'>
              <span>{$_SESSION['display_message']}</span>
              <i class='fas fa-times' onclick='this.parentElement.style.display=`none`;'></i>
            </div>";
      unset($_SESSION['display_message']);
    }
  ?>
</div>
<div class="container__main">
<div class="box form-container">
  <h2>Add Products</h2>
  <form action="forms-insert-script.php" method="post" enctype="multipart/form-data">
    <div class="inputBox">
      <input type="text" name="product_name" autocomplete="off" required value="" onkeyup="this.setAttribute('value', this.value);">
      <label for="name">Enter product name</label>
    </div>
    <div class="inputBox">
      <input type="number" name="price" id="price" autocomplete="off" min="0" required value="" onkeyup="this.setAttribute('value', this.value);">
      <label for="price">Enter product price</label>
    </div>
    <select name="sources" id="sources" class="custom-select sources" placeholder="Producer">
      <?php 
        include './cfg/dbconnect.php'; 

        $categories = mysqli_query($conn, "Select * from producers");
        while($c = mysqli_fetch_array($categories)){
      ?>
        <option value="<?php echo $c['producer_id'] ?>"><?php echo $c['producer_name'] ?></option>
        <?php } ?>    
      </select>

    <div class="upload">
      <button type="button" class="btn-warning">
        <i class="fa-solid fa-upload"></i>Upload File
        <input name="product_image" type="file" required accept="image/png, image/jpg, image/jpeg">
      </button>
    </div>
    <button type="submit" name="add_product" class="button">
      <ul>
        <li><i class="fa-solid fa-arrow-right"></i></li>
      </ul>
      
      
    </button>
  </form></div>
</div>
<?php
include 'footer.php';
?>
<script src="./js/display_message.js"></script>
<script src="./js/select-option.js"></script>
</body>
</html>