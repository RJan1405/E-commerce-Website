
<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/ahead.php');
include('includes/aside.php');
?>




        <!--Center-->
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body" id="products_table">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $products = getAll("products");
                                if ($products && mysqli_num_rows($products) > 0) {
                                    // Process the results
                                    foreach ($products as $items) {

                                ?>
                                        <tr>
                                            <td><?= $items['id']; ?></td>
                                            <td><?= $items['name']; ?></td>
                                            <td><img src="../uploads/<?= $items['image']; ?>" width="100px" height="100px" alt="<?= $items['name']; ?>"></td>
                                            <td><?= $items['status'] == '0' ? "Visible" : "Hidden" ?></td>
                                            <td>
                                                <a href="edit-product.php?id=<?= $items['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td> 
                                                    <button type="submit" class="btn btn-sm btn-danger delete_product_btn" value="<?= $items['id']; ?>">Delete</button>
                                            </td>

                                        </tr>



                                <?php

                                    }
                                } else {
                                    echo "<tr><td>No records found.</td></tr>";
                                }



                                ?>




                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <!--End Center-->

<?php include('includes/afooter.php') ?>