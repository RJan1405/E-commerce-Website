<!--header-->

<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/ahead.php');
include('includes/aside.php');
 



?>

<div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Order History
                            <a href="orders.php" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body" id="">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Tracking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $orders = getOrderHistory();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $items) {

                                    ?>

                                        <tr>
                                            <td><?=$items['id']; ?></td>
                                            <td><?=$items['name']; ?></td>
                                            <td><?=$items['tracking_no']; ?></td>
                                            <td><?=$items['total_price']; ?></td>
                                            <td><?=$items['created_at']; ?></td> 
                                            <td>
                                                <a href="view-order.php?t=<?=$items['tracking_no']; ?>" class="btn btn-primary">View Details</a>
                                            </td>
                                        </tr>

                                    <?php
                                }
                            } else {
                                ?>

                                        <tr>
                                            <td colspan="5">No orders yet</td>
                                            
                                        </tr>

                                    <?php
                               
                            }
                            ?>

                        </tbody>
                    </table>


                </div>
            </div>

        </div>

    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

