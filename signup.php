 <?php
    //function here  (page and page_title)
    include('../config/function.php');
    common_page('header', ["page_title_here" => "signup-page"]);
    ?>
 <?php

    $errUsername = '';
    $errGender = '';
    $errphone = '';
    $errphone_length = '';
    $erremail = '';
    $erremail_preg = '';
    $errpassword = '';
    $errpassword_length = '';
    $ep = '';
    $errconfirm_password = '';
    $errconfirm_password_check = '';
    $errfile = '';
    $errfile_type = '';




    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_enc = md5($password);
        $confirm_password = $_POST['confirm-password'];
        $file_upload = $_FILES['myfile'];



        //length of phone number
        $phone_length = strlen($phone);
        // echo $phone_length;



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



        if ($_FILES['myfile']['name']) {

            $myfile = $_FILES['myfile']['name'];
            $filename = pathinfo($myfile,  PATHINFO_FILENAME) . "_" . time() . "_" . rand();
            $file_ext = strtolower(pathinfo($myfile,  PATHINFO_EXTENSION));
            $myfile = $filename . "." . $file_ext;

            $myfileTmp = $_FILES['myfile']['tmp_name'];
            // echo "<br>";
            // echo $myfileTmp;
            // echo "<br>";

            $upload_path = "../images/profiles/" . $myfile;
            // echo "<br>";
            // echo "file upload" . $upload_path;
            // echo "<br>";

            $move_file_path = move_uploaded_file($_FILES['myfile']['tmp_name'], $upload_path);
            // echo "file path : " . $move_file_path;
            // echo "<br>";
            // echo "<br>";
            $extensions = array("jpeg", "jpg", "png");
        } else {
            $myfile = '';
        }




        if (empty($username)) {
            $errUsername = "please enter your name ";
        } elseif (empty($gender)) {
            $errGender = "please choose the gender ";
        } elseif (empty($phone)) {
            $errphone = "please enter the phone number ";
        } elseif ($phone_length > 11) {
            $errphone_length = "only 10 digits are available";
        } elseif (empty($email)) {
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
        } elseif (empty($confirm_password)) {
            $errconfirm_password = "please enter the confirm password";
        } elseif (empty($myfile)) {
            $errfile = "please choose the file";
            echo "<br>";
        } elseif (in_array($file_ext, $extensions) === false) {

            $errfile_type = "file always png and jpg and jpeg format";
            echo "<br>";
        } else {
            if ($password == $confirm_password) {
                //connection file include
                include('../config/conn.php');
                // echo  $username;
                // echo "<br>";
                // echo  $gender;
                // echo "<br>";
                // echo $phone;
                // echo "<br>";
                // echo  $email;
                // echo "<br>";
                // echo  $password;
                // echo "<br>";
                // echo  $confirm_password;
                // echo "<br>";
                // print_r($myfile);

                $sql = "INSERT INTO signup_users(username, gender, phone, email, password, confirm_password, profile_pic, profile_path) VALUES ('$username','$gender','$phone','$email','$password_enc','$confirm_password','$myfile','$upload_path')";
                $query = mysqli_query($conn, $sql);
                if (!$query) {
                    echo "no insert";
                } else {
                    echo " upload/insert";
                    header('location:signin.php');
                }
            } else {
                $errconfirm_password_check = "please check your confirm password";
            }
        }
    }


    ?>


 <div class="registration-form">
     <div class="form-header">
         <h2>Create Your Account</h2>
         <p>Sign up to get started!</p>
     </div>
     <form method="POST" action="" enctype="multipart/form-data">
         <div class="mb-3">
             <label for="username" class="form-label">Username</label>
             <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                 value="<?php
                        if (isset($_POST['submit'])) {


                            echo $username;
                        }

                        ?>">
             <span class="text-danger"><?php echo $errUsername; ?> </span>
         </div>


         <div class="mb-3">
             <label for="gender" class="form-label">GENDER :</label>
             <input type="radio" name="gender" value="male" <?php if (isset($_POST['submit'])) echo $gender == "male" ? "checked" : "" ?>>Male
             <input type="radio" name="gender" value="female" <?php if (isset($_POST['submit'])) echo $gender == "female" ? "checked" : "" ?>>female
             <input type="radio" name="gender" value="other" <?php if (isset($_POST['submit'])) echo $gender == "female" ? "checked" : "" ?>>other
             <br>

             <span class="text-danger"><?php echo $errGender; ?> </span>
         </div>

         <div class="mb-3">
             <label for="phone" class="form-label">Phone</label>
             <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php
                                                                                                                            if (isset($_POST['submit'])) {


                                                                                                                                echo $phone;
                                                                                                                            }

                                                                                                                            ?>">
             <span class="text-danger"><?php echo $errphone; ?> </span>
             <span class="text-danger"><?php echo $errphone_length; ?> </span>
         </div>


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
             <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" value="<?php
                                                                                                                                if (isset($_POST['submit'])) {


                                                                                                                                    echo $password;
                                                                                                                                }

                                                                                                                                ?>">
             <span class="text-danger"><?php echo $errpassword; ?> </span>
             <span class="text-danger"><?php echo $errpassword_length; ?> </span>
             <span class="text-danger"><?php echo $ep; ?> </span>
         </div>


         <div class="mb-3">
             <label for="confirm-password" class="form-label">Confirm Password</label>
             <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password" value="<?php
                                                                                                                                                    if (isset($_POST['submit'])) {


                                                                                                                                                        echo $confirm_password;
                                                                                                                                                    }

                                                                                                                                                    ?>">
             <span class="text-danger"><?php echo $errconfirm_password; ?> </span>
             <span class="text-danger"><?php echo $errconfirm_password_check; ?> </span>

         </div>

         <div class="mb-3">
             <input type="file" class="form-control" id="myfile" name="myfile" placeholder="">
             <span class="text-danger"><?php echo $errfile; ?> </span>
             <span class="text-danger"><?php echo $errfile_type; ?> </span>
         </div>




         <div class="mb-3 form-check">
             <input type="checkbox" class="form-check-input" id="terms" required>
             <label class="form-check-label" for="terms">I agree to the <a href="#" class="text-primary">terms and conditions</a></label>
         </div>



         <button type="submit" class="btn btn-custom w-100" name="submit">Register</button>
     </form>
     <div class="text-muted">
         Already have an account? <a href="signin.php" class="text-primary">Sign In</a>
     </div>
 </div>

 <?php
    common_page('footer');

    ?>