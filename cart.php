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
            <a href="cart.php" class="text-white" style="text-decoration: none;">
                Cart
            </a>

        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div id="mycart">
                    <?php $items = getCartItems();
                    if (mysqli_num_rows($items) > 0) {
                    ?>
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
                            <div class="col-md-2">
                                <h6>Remove</h6>
                            </div>
                        </div>
                        <div id="">
                            <?php
                            foreach ($items as $citem) {
                            ?>
                                <div class="card product_data shadow-sm mb-3">


                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="uploads/<?= $citem['image'] ?>" alt="Image" class="w-50" width="80px" height="80px">
                                        </div>
                                        <div class="col-md-3">
                                            <h5><?= $citem['name'] ?></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>Rs <?= $citem['selling_price'] ?></h5>
                                        </div>
                                        <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                                        <div class="col-md-2">
                                            <div class="input-group mb-3" style="width: 130px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text decrement-btn updateQty">-</span>
                                                </div>
                                                <input type="text" class="form-control bg-white text-center input-qty" value="<?= $citem['prod_qty'] ?>" disabled min="1">
                                                <div class="input-group-append">
                                                    <span class="input-group-text increment-btn updateQty">+</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-danger btn-sm deleteItem" value="<?= $citem['cid'] ?>"> <i class="fa fa-trash me-2"></i>Remove</button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="float-end">
                            <a href="checkout.php" class="btn btn-outline-primary">Proceed to checkout</a>
                        </div>
                    <?php
                    }
                    else{
                        ?>
                        <div class="card card-body shadow text-center">
                            <h4 class="py-3">Your cart is empty</h4>
                        </div>



                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<?php include('includes/footer.php'); ?>