<?php

include('functions/userfunctions.php');
include('includes/header.php');



$product = $_GET['product_ID'];
$query = "SELECT * from products WHERE id='$product'";
$query_run = mysqli_query($conn, $query);
$item = mysqli_fetch_array($query_run);

?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" style="text-decoration: none;" href="index.php">
                Home /
            </a>
            <a class="text-white" style="text-decoration: none;" href="categories.php">
                Collections /
            </a>
            <?= $item['name']; ?> /
            Book a Test Drive
        </h6>
    </div>
</div>
<br><br>
<div class="container">
    <div class="card">
        <div class="card-body shadow">
            <form action="functions/placeorder.php" method="POST">
                <div class="row justify-content-center">
                    <div class="col-md-5">
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
                    <div class="col-md-3">
                        <h5>Booking Details</h5>
                        <hr>
                        <div class="row">
                            <div>
                                <label style="color: #d6dbdf;" for="bookdate"><b>Date of Booking</b></label>
                                <input type="date" placeholder="Enter the Date of Booking" name="bookdate" required value="<?= $date ?>">
                            </div>
                            
                        </div>

                    </div>
                    <div class="col-md-4">
                        <h5>Order Details</h5>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h6>Product</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Price</h6>
                            </div>
                        </div>
                        <div class="card product_data shadow-sm mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <img src="uploads/<?= $item['image'] ?>" alt="Image" class="w-500" width="80px" height="80px">
                                </div>
                                <div class="col-md-3">
                                    <h5><?= $item['name'] ?></h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <input type="hidden" name="payment_mode" value="COD">
                            <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100">Pay and Conform your order</button>
                        </div>


                    </div>
                </div>
            </form>

        </div>


    </div>

</div>