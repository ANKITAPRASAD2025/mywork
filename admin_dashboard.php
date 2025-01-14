 <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('location:./admin/signin.php');
        // location:./admin_dashboard/admin_dashboard.php
    }

    //function here  (page and page_title)
    include('function.php');
    admin_page('admin_dashboard_head', ["page_title_here" => "admin-page"]);
    admin_page('admin_dashboard_navbar', ["page_title_here" => "admin-page"]);
    admin_page('admin_dashboard_sidebar', ["page_title_here" => "admin-page"]);
    ?>
 <main id="main" class="main">

     <div class="pagetitle">
         <h1>Dashboard</h1>
         <nav>
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                 <li class="breadcrumb-item active">Dashboard</li>
             </ol>
         </nav>
     </div><!-- End Page Title -->

     <section class="section dashboard">
         <div class="row">

             <!-- Left side columns -->
             <div class="col-lg-12">
                 <div class="row">
                     <!-- display tjhe data -->
                     <div class="col-12">
                         <div class="card recent-sales overflow-auto">

                             <div class="filter">
                                 <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                     <li class="dropdown-header text-start">
                                         <h6>login users data</h6>
                                     </li>

                                     <li><a class="dropdown-item" href="#">Today</a></li>
                                     <li><a class="dropdown-item" href="#">This Month</a></li>
                                     <li><a class="dropdown-item" href="#">This Year</a></li>
                                 </ul>
                             </div>

                             <div class="card-body">
                                 <h5 class="card-title"><span>|login users data Today</span></h5>

                                 <table class="table table-borderless datatable">
                                     <thead>
                                         <tr>
                                             <th scope="col">id</th>
                                             <th scope="col">Username</th>
                                             <th scope="col">Gender</th>
                                             <th scope="col">Phone</th>
                                             <th scope="col">Email</th>
                                             <th scope="col">Profile</th>
                                             <th scope="col">Actions</th>

                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            include('conn.php');

                                            $sql = "SELECT*FROM signup_users";
                                            $query = mysqli_query($conn, $sql);
                                            $count = mysqli_num_rows($query);
                                            if ($count == 1) {
                                                while ($row = mysqli_fetch_assoc($query)) {
                                            ?>
                                                 <tr>
                                                     <th scope="row"><a href="#"><?php echo $row['id']; ?></a></th>
                                                     <td><?php echo $row['username']; ?></td>
                                                     <td><?php echo $row['gender']; ?></td>
                                                     <td><?php echo $row['phone']; ?></td>
                                                     <td><?php echo $row['email']; ?></td>
                                                     <td><img src="../assets/images/profiles/<?php echo $row['profile_pic']; ?> " alt="" srcset="" height=30>
                                                     </td>

                                                     <td><a href="update.php">Update</a></td>
                                                     <td><a href="delete.php">delete</a></td>
                                                 </tr>







                                         <?php
                                                }
                                            }
                                            ?>

                                     </tbody>
                                 </table>

                             </div>

                         </div>
                     </div><!-- End Recent Sales -->
                 </div>
             </div><!-- End Left side columns -->


         </div>
     </section>

 </main><!-- End #main -->




 <?php



    admin_page('admin_dashboard_footer', ["page_title_here" => "admin-page"]);


    ?>