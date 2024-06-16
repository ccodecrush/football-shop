<?php
session_start();
if(isset($_SESSION['name'])){
    header("Location: shop.php");
    exit;
}
  include "./cfg/dbconnect.php";
  $name = $email = $pwd = $conf_pwd = "";
  $name_err = $email_err = $pwd_err = $conf_pwd_err = "";
  $error = false; 
  $err_msg = "";
  
  if (isset($_POST['submit'])){
  
      $name = trim($_POST['name']);
      $email = trim($_POST['email']);
      $pwd = trim($_POST['pwd']);
      $conf_pwd = trim($_POST['conf_pwd']);
      
      if ($name == ""){
          $name_err = "Name is mandatory";
          $error = true;
      }
  
      if ($email == ""){
          $email_err = "Email is mandatory";
          $error = true;
      }
      elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
              $email_err = "Invalid Email format";
              $error = true;
          }
      else{   // check if email already registered
          $sql = "select * from users where email = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s",$email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows >0){
              $email_err = "Email already registered";
              $error = true;
          } 
      }
  
      if ($pwd == ""){
          $pwd_err = "Passqword is mandatory";
          $error = true;
      }
      elseif (strlen($pwd) < 6) {
          $pwd_err = "Password must be atleast 6 characters";
          $error = true;
          }
      
      if ($conf_pwd == ""){
          $conf_pwd_err = "Confirm Password is mandatory";
          $error = true;
      }
  
      if ($pwd !="" && $conf_pwd !=""){
          if ($pwd != $conf_pwd){
              $conf_pwd_err = "Passwords do not match";
              $error = true;
          }
      }
  
        // all validations passed
        if (!$error){
          $pwd = password_hash($pwd, PASSWORD_DEFAULT);
  
          $sql = "insert into users (name, email, password) value(?, ?, ?)";
          try{
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sss", $name, $email, $pwd);
              $stmt->execute();
              $succ_msg = "Registration successful. Please <a href='login.php'>login</a>";
              $name = $email ="";
          }
          catch(Exception $e){
              $error_msg = $e->getMessage();
          }
  
      }
  }
  include "header.php";
  ?>
  <link rel="stylesheet" href="css/form-logins.css">

  <div class="container">
          <?php if (!empty($succ_msg)){ ?>
              <div class="display_message sukces">
                  <?= $succ_msg?>
                  <i class='fas fa-times' onclick='this.parentElement.style.display=`none`;'></i>
              </div>
          <?php } ?>
  
          <?php if (!empty($error_msg)){ ?>
              <div class="display_message error">
                  <?= $error_msg?>
                  <i class='fas fa-times' onclick='this.parentElement.style.display=`none`;'></i>
              </div>
          <?php } ?>
    </div>



  <div class="container__main">
    <div class="box"> 
      <h2>Sign UP</h2>
      <form action="" method="post">
          <div class="inputBox">
              
              <input
                  type="text"
                  name="name"
                  autocomplete="off"
                  required 
                  value="<?=$name?>"
                  onkeyup="this.setAttribute('value', this.value);"
              />
              <label for="name">Name</label>
              <div class="input-err text-danger"><?= $name_err?></div>
              
          </div>
  
          <div class="inputBox">
              
              <input
                  type="text"
                  name="email"
                  autocomplete="off"
                  required 
                  value="<?=$email?>"
                  onkeyup="this.setAttribute('value', this.value);" 
              />
              <label for="email">Email</label>
              <div class="input-err text-danger"><?= $email_err?></div>
              
              
          </div>
  
          <div class="inputBox">
              
              <input
                  type="password"
                  name="pwd"
                  id="pwd"
                  autocomplete="off"
                  required 
                  value="" 
                  onkeyup="this.setAttribute('value', this.value);"
              />
              <label for="pwd">Password</label>
              <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
              <div class="input-err text-danger"><?= $pwd_err?></div>
              
          </div>
  
          <div class="inputBox">
             
              <input
                  type="password"
                  name="conf_pwd"
                  id="conf_pwd"
                  autocomplete="off"
                required 
                value="" 
                onkeyup="this.setAttribute('value', this.value);"
              /> 
              <label for="conf_pwd">Confirm Password</label>
              <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
              <div class="input-err text-danger"><?= $conf_pwd_err?></div>
              
          </div>
          <div class="reg-button text-center mt-3">
              <button
                  type="submit"
                  name = "submit"
                  class="btn btn-primary">
                  Register
              </button>
          </div>
          <hr class="hr-text" data-content="OR"></hr>
          <p>Already Registered? Login <a href="login.php">here</a></p>
      </form>
  </div>
<script src="js/form-login.js"></script>
  </body>
  </html>    
