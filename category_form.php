 <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location:signin.php');
    }
    include('../config/function.php');
    common_page('admin_dashboard_head', ["page_title_here" => "admin-page"]);
    common_page('admin_dashboard_navbar', ["page_title_here" => "admin-page"]);
    common_page('admin_dashboard_sidebar', ["page_title_here" => "admin-page"]);




    //valdation for form



    $errname = '';
    $errdesc = '';
    $errslug = '';
    $errfile = '';
    $errfile_type = '';


    if (isset($_POST['submit'])) {

        include('../config/conn.php');


        if (isset($_POST['submit'])) {

            // include('../config/conn.php');
            $name = $_POST['name'];

            $desc = $_POST['desc'];
            $slug = $_POST['slug'];


            $str_replace = str_replace('', '', $name);
            echo $str_replace;

            $file_upload = $_FILES['myfile'];
            if ($_FILES['myfile']['name']) {

                $myfile = $_FILES['myfile']['name'];
                $filename = pathinfo($myfile,  PATHINFO_FILENAME) . "_" . time() . "_" . rand();
                $file_ext = strtolower(pathinfo($myfile,  PATHINFO_EXTENSION));
                $myfile = $filename . "." . $file_ext;

                $myfileTmp = $_FILES['myfile']['tmp_name'];

                $upload_path = "../assets/images/category/" . $myfile;


                $move_file_path = move_uploaded_file($_FILES['myfile']['tmp_name'], $upload_path);

                $extensions = array("jpeg", "jpg", "png");
            } else {
                $myfile = '';
            }




            if (empty($name)) {
                $errname = " enter your name ";
            } elseif (empty($myfile)) {
                $errfile = "please choose the file";
                echo "<br>";
            } elseif (in_array($file_ext, $extensions) === false) {

                $errfile_type = "file always png and jpg and jpeg format";
                echo "<br>";
            } else {
                $sql = "INSERT INTO `category`( `name`, `desc`, `slug`, `category_image`) VALUES ('$name','$desc','$slug','$myfile')";
                $query = mysqli_query($conn, $sql);
                if (!$query) {
                    echo "no insert";
                } else {
                    echo " insert";
                    // header('location:category_form.php');
                }
            }
        }
    }


    ?>

 <body>
     <main id="main" class="main">

         <div class="pagetitle">
             <h1>Form Elements</h1>
             <nav>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                     <li class="breadcrumb-item">Forms</li>
                     <li class="breadcrumb-item active">Elements</li>
                 </ol>
             </nav>
         </div><!-- End Page Title -->

         <section class="section">
             <div class="row">
                 <div class="col-lg-12

                     <div class=" card">
                     <div class="card-body">
                         <h5 class="card-title">General Form Elements</h5>

                         <!-- General Form Elements -->
                         <form method="POST" action="" enctype="multipart/form-data">
                             <div class="row mb-3">
                                 <label for="inputText" class="col-sm-2 col-form-label">NAME</label>
                                 <div class="col-sm-10">
                                     <input type="text" class="form-control" name="name" value="<?php
                                                                                                if (isset($_POST['submit'])) {


                                                                                                    echo $name;
                                                                                                }

                                                                                                ?>">
                                     <h4 class="text-denger"><?php echo $errname; ?></h4>
                                 </div>

                             </div>
                             <div class="row mb-3">
                                 <label for="inputText" class="col-sm-2 col-form-label">DESCRIPTION</label>
                                 <div class="col-sm-10">
                                     <input type="text" class="form-control" name="desc" value="<?php
                                                                                                if (isset($_POST['submit'])) {


                                                                                                    echo $desc;
                                                                                                }

                                                                                                ?>">
                                     <h4 class="text-denger"><?php echo $errdesc; ?></h4>
                                 </div>
                             </div>
                             <div class="row mb-3">
                                 <label for="inputText" class="col-sm-2 col-form-label">SLUG</label>
                                 <div class="col-sm-10">
                                     <input type="text" class="form-control" name="slug" value="<?php
                                                                                                if (isset($_POST['submit'])) {


                                                                                                    echo $slug;
                                                                                                }

                                                                                                ?>">
                                     <h4 class="text-denger"><?php echo $errslug; ?></h4>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                 <div class="col-sm-10">
                                     <input class="form-control" type="file" id="formFile" name="myfile">
                                     <h4 class="text-denger"><?php echo $errfile; ?></h4>
                                     <h4 class="text-denger"><?php echo $errfile_type; ?></h4>
                                 </div>
                             </div>



                             <div class="row mb-3">
                                 <label class="col-sm-2 col-form-label">Submit Button</label>
                                 <div class="col-sm-10">
                                     <button type="submit" class="btn btn-primary" name="submit">Submit Form</button>
                                 </div>
                             </div>

                         </form><!-- End General Form Elements -->

                     </div>
                 </div>

             </div>


             </div>
         </section>

     </main><!-- End #main -->

     <?php
        common_page('admin_dashboard_footer', ["page_title_here" => "admin-page"]);
        ?>