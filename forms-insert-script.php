<?php 
include './cfg/dbconnect.php'; 
session_start(); 
if(isset($_POST['add_product'])) { 
    $product_name = $_POST['product_name']; 
    $price = $_POST['price']; 
    $product_image = $_FILES['product_image']['name']; 
    $product_image_temp_name = $_FILES['product_image']['tmp_name']; 
    $product_image_folder='images/'.$product_image; 
    $option = $_POST['sources'];
    $insert_query = "INSERT INTO footballboots (name, price, image, producer_id) VALUES ('$product_name', '$price', '$product_image', '$option')"; 
    if(mysqli_query($conn, $insert_query)) { 
        move_uploaded_file($product_image_temp_name, $product_image_folder); 
        $_SESSION['display_message'] = "successfully"; 
    } else { 
        $_SESSION['display_message'] = "Błąd ".mysqli_error($conn); 
    } 
    session_write_close(); 
    header("Location: addproducts.php"); 
    exit(); 
} 
?>
