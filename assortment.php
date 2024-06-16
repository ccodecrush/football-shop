<?php
include './cfg/dbconnect.php';
include('header.php');


$per_page = 10; 


if(isset($_POST['search'])) {
    $searchName = $_POST['searchName'];
    $searchName = mysqli_real_escape_string($conn, $searchName); 
    $search_query = "SELECT * FROM `footballboots` WHERE `name` LIKE '%$searchName%'";
    $result = mysqli_query($conn, $search_query);
} else {
    $result = mysqli_query($conn, "SELECT * FROM `footballboots`");
}


if (!isset($_GET['page']) || !is_numeric($_GET['page']) || $_GET['page'] < 1) {
    $page = 1;
} else {
    $page = $_GET['page'];
}


$start = ($page - 1) * $per_page;


if(isset($_POST['search'])) {
    $searchName = $_POST['searchName'];
    $searchName = mysqli_real_escape_string($conn, $searchName);
    $search_query = "SELECT * FROM `footballboots` WHERE `name` LIKE '%$searchName%' LIMIT $start, $per_page";
    $result = mysqli_query($conn, $search_query);
} else {
    $result = mysqli_query($conn, "SELECT * FROM `footballboots` LIMIT $start, $per_page");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/view1.css">
  <link rel="stylesheet" href="./css/baza.css">
  <link rel="icon" type="image/x-icon" href="./img/logohead.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./js/view.js"></script>
  <title>Document</title>

</head>
<body>
  <div class="container__view">
    <div class="table">
      <div class="table__header">
        <p>Products</p>
        <div class="search-container">
          <form class="search-form" method="post" action="">
            <input class="email-search" type="text" name="searchName" id="searchName" placeholder="product search" autocomplete="off">
            <button class="submit-search" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="assortment.php" class="back-button"><i class="fa-solid fa-xmark"></i></a>
          </form>
        </div>
      </div>
      <section class="display__product">
        <table>
          <thead>
            <tr>
              <th>№</th>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Відображаємо дані
              $num = $start + 1;
              if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {    
            ?>
            <tr>
              <td><?php echo $num ?></td>
              <td><img src="images/<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>"></td>
              <td><?php echo $row['name'] ?></td>
              <td>$<?php echo $row['price'] ?></td>
              <td>
                <a href="update.php?edit=<?php echo $row['boots_id'] ?>"><i class="fa-solid fa-pen-to-square table-icons table-icons-edit"></i></a>
                <a href="delete.php?delete=<?php echo $row['boots_id'] ?>" class="delete-link"><i class="fa-solid fa-trash table-icons table-icons-delete"></i></a>
                <div class="confirmation-modal">
                  <div class="confirmation-modal-content">
                    <p>Are you sure you want to delete this product?</p>
                    <button class="confirm-yes">Ok</button>
                    <button class="confirm-no">Cancel</button>
                  </div>
                </div>
              </td> 
            </tr>
            <?php 
                $num++;
                }
            } else {
                print "<div class='empty_text'>No Products Available</div>";
            }
            ?>
          </tbody>
        </table>
        <!-- Пагінація -->
        <div class="pagination">
          <?php
            // Визначаємо кількість сторінок
            $total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `footballboots`")) / $per_page);

            // Виводимо посилання на попередню сторінку, якщо є
            if ($page > 1) {
              echo "<a href='?page=".($page - 1)."' class='pagination-btn'><i class='fa-solid fa-arrow-left'></i></a>";
            }
            
            // Виводимо посилання на наступну сторінку, якщо є
            if ($page < $total_pages) {
              echo "<a href='?page=".($page + 1)."' class='pagination-btn'><i class='fa-solid fa-arrow-right'></i></a>";
            }
          ?>
        </div>
      </section>
    </div>
  </div>
  <?php
    include('footer.php');
  ?>
</body>
</html>
