<?php
session_start();
if(isset($_SESSION['name'])){
    header("Location: shop.php");
    exit;
}
include "./cfg/dbconnect.php";
$email = $pwd = "";
$email_err = $pwd_err = "";
$error = false; 
$err_msg = "";

if (isset($_POST['submit'])){
    $email = trim($_POST['email']);
    $pwd = trim($_POST['pwd']);

    if (isset($_POST['remember']))
        $remember = $_POST['remember'];
   
    // validate fields

    if ($email == ""){
        $email_err = "Email is mandatory";
        $error = true;
    }

    if ($pwd == ""){
        $pwd_err = "Password is mandatory";
        $error = true;
    }


     // all validations passed
     if (!$error){

        $sql = "select * from users where email = ?";
        try{
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows >0){
                $row = $result->fetch_assoc();
                $stored_pwd = $row['password'];
                if (password_verify($pwd, $stored_pwd)){
                    // login successful
                    if (isset($_POST['remember'])){
                       
                        setcookie("remember_email", $email, time()+365*24*3600);
                        setcookie("remember", $remember, time()+365*24*3600);
                    }
                    else{
                        setcookie("remember_email", $email, time() - 365*24*3600);
                        setcookie("remember", $remember, time() - 365*24*3600);
                    }
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("location: shop.php");
                }
                else{
                    $error_msg = "Incorrect Password";
                }

            }
            else {
                $error_msg = "Email id not registered";
            }

          
        }
        catch(Exception $e){
            $error_msg = $e->getMessage();
        }

    }
}
include "header.php";
?>
<link rel="stylesheet" href="css/form-logins.css">
<link rel="stylesheet" href="css/logins.css">
 <div class="container">
        <?php if (!empty($error_msg)){ ?>
            <div class="display_message error">
                <?= $error_msg?>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`;'></i>
            </div>
        <?php } ?>
    </div>

 <div class="container__main">
    <div class="box"> 
      <h2>Log IN</h2>
   
    <form action="" method="post">
            <?php
             $display_email = isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : $email;

             $checked = !empty($remember) ? "checked" : (isset($_COOKIE['remember']) ? "checked" : "");
            ?>
        <div class="inputBox">
            
            <input
                type="text"
                name="email"
                class="login_email"
                autocomplete="off"
                required 
                value="<?=$display_email?>"
                onkeyup="this.setAttribute('value', this.value);"
            />
            <label for="email">Email</label>
            <div class="input-err text-danger"><?= $email_err?></div>
           
        </div>

        <div class="inputBox">
            <input
                type="password"
                class="password"
                name="pwd"
                id="pwd"
                autocomplete="off"
                required 
                value="" 
                onkeyup="this.setAttribute('value', this.value);"
            />
            <label for="pwd">Password</label>
            <span class="password-toggle-icon toggle-icon"><i class="fas fa-eye"></i></span>
            <div class="input-err text-danger"><?= $pwd_err?></div>
        </div>
       <div class="form-check">
        <input
            class="form-check-input"
            name="remember"
            id=""
            type="checkbox"
            value="checkedValue"
            aria-label="Remember Me"
            <?= $checked?>
        />Remember Me
       </div>
       
        <div class="reg-button text-center mt-3">
            <button
                type="submit"
                name = "submit"
                class="btn btn-primary">
                Log IN
            </button>
        </div>
        <hr class="hr-text" data-content="OR"></hr>
        <p>Not Registered? Click <a href="register.php">here</a> to register</p>
    </form>
</div>
<script src="js/form-login.js"></script>
</body>
</html>