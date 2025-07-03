<!--header-->

<?php

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white" style="text-decoration: none;">
                Home /
            </a>
            <a href="checkout.php" class="text-white" style="text-decoration: none;">
                Cart
            </a>

        </h6>
    </div>
</div>
<div class="py-5">
    <!--<?php /*if (isset($_SESSION['alert'])) {
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey</strong><?= $_SESSION['alert']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['alert']);
    }*/
    ?>-->
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/placeorder.php" method="POST">
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold ">Name</label>
                                    <input type="text" name="name" required placeholder="Enter your full name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold ">E-mail</label>
                                    <input type="email" name="email" required placeholder="Enter your email" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold ">Phone</label>
                                    <input type="text" name="phone" required placeholder="Enter your phone number" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold ">Pin code</label>
                                    <input type="text" name="pincode" required placeholder="Enter your pin code" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold ">Address</label>
                                    <textarea name="address" required class="form-control" rows="5"></textarea>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <h6>Product</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Price</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Quantity</h6>
                                </div>

                            </div>


                            <?php $items = getCartItems();
                            $totalPrice = 0;
                            foreach ($items as $citem) {
                            ?>
                                <div class="card product_data shadow-sm mb-3">


                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="uploads/<?= $citem['image'] ?>" alt="Image" class="w-500" width="80px" height="80px">
                                        </div>
                                        <div class="col-md-3">
                                            <h5><?= $citem['name'] ?></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>Rs <?= $citem['selling_price'] ?></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>x <?= $citem['prod_qty'] ?></h5>
                                        </div>


                                    </div>
                                </div>
                            <?php
                                $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                            }
                            ?>
                            <hr>
                            <h5>Total Price : <span class="float-end fw-bold"><?= $totalPrice ?></span></h5>
                            <div class="">
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100">Confirm and place order | COD</button>
                            </div>


                        </div>
                    </div>
                </form>

            </div>


        </div>

    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<?php include('includes/footer.php'); ?>