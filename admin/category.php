<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
session_start();
include('../middleware/adminMiddleware.php');
include('includes/ahead.php');
include('includes/aside.php');
?>

<!--Center-->
<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Categories</h4>
                </div>
                <div class="card-body" id="category_table">
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
                            $category = getAll("categories");
                            if ($category && mysqli_num_rows($category) > 0) {
                                // Process the results
                                foreach ($category as $items) {

                            ?>
                                    <tr>
                                        <td><?= $items['id']; ?></td>
                                        <td><?= $items['name']; ?></td>
                                        <td><img src="../uploads/<?= $items['image']; ?>" width="100px" height="100px" alt="<?= $items['name']; ?>"></td>
                                        <td><?= $items['status'] == '0' ? "Visible" : "Hidden" ?></td>
                                        <td>
                                            <a href="edit-category.php?id=<?= $items['id']; ?>" class="btn btn-sm btn-primary">Edit</a>

                                            <!--form
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                    <button type="submit" class="btn btn-danger" name="delete_category_btn">Delete</button>
                                                </form>
                                                
                                    -->



                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-danger delete_category_btn" value="<?= $items['id']; ?>">Delete</button>
                                        </td>

                                    </tr>



                            <?php

                                }
                            } else {
                                echo "<tr><td>No categories found.</td></tr>";
                            }



                            ?>




                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
<!--End Center-->


<?php include('includes/afooter.php'); ?>