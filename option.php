<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<select name="sources" id="sources" class="custom-select sources" placeholder="Producer">
  <?php 
    include './cfg/dbconnect.php'; 

    $categories = mysqli_query($conn, "SELECT * FROM producers"); 
    while($c = mysqli_fetch_array($categories)){ 
  ?>
    <option value="<?php echo $c['producer_id'] ?>"><?php echo $c['name'] ?></option>
  <?php } ?>    
</select>
</body>
</html>