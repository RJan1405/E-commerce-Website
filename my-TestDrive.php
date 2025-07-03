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
            <a href="my-orders.php" class="text-white" style="text-decoration: none;">
                Test Drive
            </a>

        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No</th>
                                <th>Vehicle_name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = yourDrives();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $items) {

                                    ?>

                                        <tr>
                                            <td><?=$items['id']; ?></td>
                                            <td><?=$items['tracking_no']; ?></td>
                                            <td><?=$items['prod_name']; ?></td>
                                            <td><?=$items['booking_date']; ?></td> 
                                            <td><?=$items['booking_time']; ?></td>
                                            <td>
                                                <a href="view-TestDrive.php?t=<?=$items['tracking_no']; ?>" class="btn btn-primary">View Details</a>
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

<?php include('includes/footer.php'); ?>