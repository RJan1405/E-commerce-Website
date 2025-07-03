 <!--navbar-->
 <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark shadow">
    <div class="container">
      <a class="navbar-brand" href="index.php">Akshar Motors</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categories.php">Collections</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart</a>
          </li>


          <?php
          if (isset($_SESSION['auth']) && $_SESSION['auth']==true) {

          ?>

            <div class="dropdown">
              <a class="nav-link  dropdown-toggle" id="navbarDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['auth_user']['email']; ?>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="my-orders.php">My Orders</a></li>
                <li><a class="dropdown-item" href="my-TestDrive.php">My Bookings</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                <li><a class="dropdown-item" href="razorpay.php">Pay</a></li>
              </ul>
            </div>

          <?php
          }
          
          else {
          ?>

            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>

          <?php

          }
          ?>














        </ul>
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



  <!--navbar End-->