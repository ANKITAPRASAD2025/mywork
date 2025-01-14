 <?php
    session_start();
    include('../config/function.php');
    common_page('header', ["page_title_here" => "signin-page"]);

    ?>
 <?php
    $erremail = '';
    $erremail_preg = '';
    $errpassword = '';
    $errpassword_length = '';
    $ep = '';
    $login_error = '';
    if (isset($_POST['submit'])) {



        include('../config/conn.php');


        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_enc = md5($password);
        echo "<br>";
        echo $password_enc;
        echo "<br>";




        //email preg
        $email_two = trim($email);
        $email_preg = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";


        //password
        $password_length = strlen($password);
        $password_two = trim($password);
        $especial_character = "/[!@#$%]/"; //special character
        $enumber = "/\d/";
        $euppercase = "/[A-Z]/";
        $elowercase = "/[a-z]/";




        if (empty($email)) {
            $erremail = "please enter the email";
            echo "<br>";
        } elseif (!preg_match($email_preg, $email_two)) {
            $erremail_preg = "Invalid email ";
        } elseif (empty($password)) {
            $errpassword = "please enter the password";
        } elseif ($password_length < 8) {
            $errpassword_length = "password must be in 8 digit";
            echo "<br>";
        } elseif (!preg_match($especial_character, $password_two)) {
            $ep = " 1 special charcter";
        } elseif (!preg_match($euppercase, $password_two)) {
            $ep = "1 upercase ";
        } elseif (!preg_match($enumber, $password_two)) {
            $ep = "1 digit ";
        } elseif (!preg_match($elowercase, $password_two)) {
            $ep = " 1 lowercase ";
        } else {


            $sql = "SELECT * FROM signup_users WHERE  email='$email' AND password='$password_enc'";
            $query = mysqli_query($conn, $sql);
            $exit_data = mysqli_num_rows($query);
            echo "<br>";
            echo $exit_data;
            if ($exit_data > 0) {
                echo "<br>";
                // echo "login";
                // $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                if (isset($_SESSION['email'])) {
                    header('location:./admin_dashboard/admin_dashboard.php');
                    // header('location:admin_dashboard.php');
                    // echo "login";
                    // echo "email : " . $_SESSION['email'];
                }
            } else {
                $login_error = "please check your password";
            }
        }
    }
    ?>


 <div class="registration-form">
     <div class="form-header">
         <h2>Login Your Account</h2>
         <p>Sign in to get started!</p>
     </div>
     <form method="POST" action="" enctype="multipart/form-data">
         <div class="mb-3">
             <label for="email" class="form-label">Email Address</label>
             <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php
                                                                                                            if (isset($_POST['submit'])) {


                                                                                                                echo $email;
                                                                                                            }

                                                                                                            ?>">
             <span class="text-danger"><?php echo $erremail; ?> </span>
             <span class="text-danger"><?php echo $erremail_preg; ?> </span>
         </div>

         <div class="mb-3">
             <label for="password" class="form-label">Password</label>
             <input type="password" class="form-control" id="password" name="password" placeholder="enter a password" value="<?php
                                                                                                                                if (isset($_POST['submit'])) {


                                                                                                                                    echo $password;
                                                                                                                                }

                                                                                                                                ?>">
             <span class="text-danger"><?php echo $errpassword; ?> </span>
             <span class="text-danger"><?php echo $errpassword_length; ?> </span>
             <span class="text-danger"><?php echo $ep; ?> </span>
         </div>







         <button type="submit" class="btn btn-custom w-100" name="submit">Sign In</button>
         <span class="text-danger"> <?php echo $login_error; ?></span>
     </form>
     <div class="text-muted">
         Forgot Password ? <a href="signup.php" class="text-primary">Sign Up</a>
     </div>
 </div>

 <?php
    common_page('footer');

    ?>