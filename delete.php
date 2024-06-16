<?php
include './cfg/dbconnect.php';

if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    
    $image_query = mysqli_query($conn, "SELECT image FROM footballboots WHERE boots_id=$delete_id");
    $image_row = mysqli_fetch_assoc($image_query);
    $image_path = 'images/' . $image_row['image'];
    
    $delete_query = mysqli_query($conn, "DELETE FROM footballboots WHERE boots_id=$delete_id") or die("Query failed");
    
    if($delete_query) {
        if(file_exists($image_path)) {
            unlink($image_path); 
        }
        header('location:assortment.php');
    } else {
        echo "Product not deleted";
        header('location:assortment.php');
    }
}
?>
