
<?php

$page= substr($_SERVER['SCRIPT_NAME'],strrpos($_SERVER['SCRIPT_NAME'],"/")+1);

?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">

        <span class="ms-1 font-weight-bold text-white">Akshar Motors</span>
      </a>
    </div>


    <hr class="horizontal light mt-0 mb-2">
    <!--Sidebar-->
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">


        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="index.php"? 'active bg-gradient-primary':'' ?>" href="../admin/index.php">

            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>

            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="category.php"? 'active bg-gradient-primary':'' ?>" href="category.php">

            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>

            <span class="nav-link-text ms-1">All Categories</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="add-category.php"? 'active bg-gradient-primary':'' ?>" href="add-category.php">

            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">add</i>
            </div>

            <span class="nav-link-text ms-1">Add Category</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="products.php"? 'active bg-gradient-primary':'' ?>" href="products.php">

            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>

            <span class="nav-link-text ms-1">All Products</span>
          </a>
        </li>


        

        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="add-product.php"? 'active bg-gradient-primary':'' ?>" href="add-product.php">

            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">add</i>
            </div>

            <span class="nav-link-text ms-1">Add Products</span>
          </a>
        </li>




        <li class="nav-item">
          <a class="nav-link text-white <?= $page=="orders.php"? 'active bg-gradient-primary':'' ?>" href="orders.php">

            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>

            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>


       


      </ul>
    </div>
    <!--Sidebar End-->

    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary w-100" href="../logout.php" type="button">Logout</a>
      </div>

    </div>

  </aside>
   <!-- Navbar -->
   <main class="main-content border-radius-lg ">
   
   <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
     <div class="container-fluid py-1 px-3">

       <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
         <div class="ms-md-auto pe-md-3 d-flex align-items-center">
           <div class="input-group input-group-outline">
             <label class="form-label">Type here...</label>
             <input type="text" class="form-control">
           </div>
         </div>
       </div>
     </div>
   </nav>
   <!-- End Navbar -->


<!--alert message-->
<?php if (isset($_SESSION['alert'])) {
    ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Hey</strong><?= $_SESSION['alert']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
      unset($_SESSION['alert']);
    }
    ?>
    