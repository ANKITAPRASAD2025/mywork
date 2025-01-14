 <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location:signin.php');
    }
    include('../config/function.php');
    common_page('admin_dashboard_head', ["page_title_here" => "admin-page"]);
    common_page('admin_dashboard_navbar', ["page_title_here" => "admin-page"]);
    common_page('admin_dashboard_sidebar', ["page_title_here" => "admin-page"]);


    include('../config/conn.php');


    //fetch the data form database and update
    $id = $_GET['getid'];
    echo "id : " . $id;


    $sql = "SELECT*FROM category WHERE id={$id}";
    $query = mysqli_query($conn, $sql);


    $count = mysqli_num_rows($query);
    echo $count;

    $row = mysqli_fetch_assoc($query);

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
                         <form method="post" action="../config/rseult_update_category.php?getid=<?php echo $row['id']; ?>" enctype="multipart/form-data">


                             <div class="row mb-3">
                                 <label for="inputText" class="col-sm-2 col-form-label">NAME</label>
                                 <div class="col-sm-10">
                                     <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <label for="inputText" class="col-sm-2 col-form-label">DESCRIPTION</label>
                                 <div class="col-sm-10">
                                     <input type="text" class="form-control" name="desc" value="<?php

                                                                                                echo $row['desc'];
                                                                                                ?>">

                                 </div>
                             </div>
                             <div class="row mb-3">
                                 <label for="inputText" class="col-sm-2 col-form-label">SLUG</label>
                                 <div class="col-sm-10">
                                     <input type="text" class="form-control" name="slug" value="<?php
                                                                                                echo $row['slug'];

                                                                                                ?>">

                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                 <div class="col-sm-10">
                                     <input class="form-control" type="file" id="formFile" name="myfile" value=" <?php echo $row['category_image']; ?>">

                                 </div>
                             </div>



                             <div class="row mb-3">
                                 <label class="col-sm-2 col-form-label">Submit Button</label>
                                 <div class="col-sm-10">
                                     <button type="submit" class="btn btn-primary" name="update">Update Form</button>
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