<!--header-->

<?php

include('functions/userfunctions.php');
include('includes/header.php');
include('authenticate.php');



    $trackingNo = $_GET['t'];
    $userId=$_SESSION['auth_user']['user_id'];

    $query="SELECT * FROM bookings WHERE tracking_no='$trackingNo' AND user_id='$userId' ";
    $query_run=mysqli_query($conn,$query);
    $data=mysqli_fetch_array($query_run);
    
    

?>
        
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white" style="text-decoration: none;">
                Home /
            </a>
            <a href="my-orders.php" class="text-white" style="text-decoration: none;">
                My Orders /
            </a>
            <a href="#" class="text-white" style="text-decoration: none;">
                View Orders
            </a>

        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                           <span class="text-white fs-4">View Order</span>
                            <a href="my-TestDrive.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Delivery Details</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Name</label>
                                            <div class="border p-1">
                                                <?= $data['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Email</label>
                                            <div class="border p-1">
                                                <?= $data['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone</label>
                                            <div class="border p-1">
                                                <?= $data['phone_no']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Tracking_No</label>
                                            <div class="border p-1">
                                                <?= $data['tracking_no']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Address</label>
                                            <div class="border p-1">
                                                <?= $data['address']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Pincode</label>
                                            <div class="border p-1">
                                                <?= $data['pincode']; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th>Slot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            

                                            <?php
                                            $prod_id=$data['prod_id'];

                                            $userId = $_SESSION['auth_user']['user_id'];

                                            $order_query = "SELECT * from products where id='$prod_id' ";

                                            $order_query_run = mysqli_query($conn, $order_query);

                                            if (mysqli_num_rows($order_query_run) > 0) {

                                                foreach ($order_query_run as $items) {
                                                    ?>

                                                    <tr>
                                                        
                                                        <td class="align-middle">
                                                            <img src="uploads/<?=$items['image'];?>" alt="<?=$items['name'];?>" width="80px" height="80px">
                                                            <?=$items['name'];?>
                                                        </td>
                                                        <td class="align-middle"><?=$data['booking_date'];?></td>
                                                        <td class="align-middle"><?=$data['booking_time'];?></td>
                                                    </tr>

                                                    <?php
                                                }
                                            }

                                            ?>

                                        </tbody>
                                    </table>

                                    <hr>
                                    <h5>Payment done :1000 <span class="float-end fw-bold"><?echo "1000";//= $data['total_price'];?></span></h5>
                                    <hr>

                                    <label class="fw-bold">Payment Mode</label>
                                    <div class="border p-1 mb-3">
                                        
                                        <?php echo "Online Mode";//=$data['payment_mode'];?>
                                    </div>
                                    <label class="fw-bold">Status</label>
                                    <div class="border p-1 mb-3">
                                        
                                        <?php 
                                         
                                        if($data['Status']==0)
                                        {
                                            echo "Under Process";

                                        }
                                        else if($data['Status']==1)
                                        {
                                            echo "Completed";

                                        }
                                        else if($data['Status']==2)
                                        {
                                            echo "Cancelled ";

                                        }
                                        
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            </div>

        </div>

    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<?php include('includes/footer.php'); ?>