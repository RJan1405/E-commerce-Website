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


<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-md-12">
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
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    <a href="index.php" class="btn btn-primary float-end"><i class="fa fa-reply"></i> Back</a><br><br><br><br>
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0">Select Category</label>
                                <select name="category_id" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px;" mb-2>
                                    <option selected>Select Category</option>
                                    <?php
                                    $categories = getAll("categories");
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $item) {
                                    ?>
                                            <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>


                                    <?php

                                        }
                                    } else {
                                        echo "No category available";
                                    }

                                    ?>

                                </select>

                            </div><br><br><br>
                            <div class="col-md-6">
                                <label class="mb-0">Name</label>
                                <input type="text" name="name" placeholder="Enter category Name" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px" mb-2>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Slug</label>
                                <input type="text" name="slug" placeholder="Enter slug" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px" mb-2>
                            </div><br><br>
                            <div><br>
                                <label class="mb-0">Small Description</label><br>
                                <textarea rows="5" cols="110" name="small_description" placeholder="Enter small Description" style="border:1px solid #b3a1a1 !important;border :8px 10px" mb-2></textarea>
                            </div>
                            <div><br>
                                <label class="mb-0">Description</label><br>
                                <textarea rows="5" cols="110" name="description" placeholder="Enter Description" style="border:1px solid #b3a1a1 !important;border :8px 10px" mb-2></textarea>
                            </div><br><br>
                            <div class="col-md-6"><br>
                                <label class="mb-0">Original Price</label>
                                <input type="text" name="original_price" placeholder="Enter Original Price" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px" mb-2>
                            </div>
                            <div class="col-md-6"><br>
                                <label class="mb-0">Selling Price</label>
                                <input type="text" name="selling_price" placeholder="Enter Selling Price" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px" mb-2>
                            </div>
                            <div><br>
                                <label class="mb-0">Upload Image</label><br>
                                <input type="file" name="image" style="padding: 8px 10px;border:1px solid #b3a1a1 !important" mb-2>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><br>
                                    <label class="mb-0">Quantity</label>
                                    <input type="text" required name="qty" placeholder="Enter Quantity" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px" mb-2>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Status</label>
                                    <input type="checkbox" name="status" value="1">
                                </div>
                                <div class="col-md-3">
                                    <label for="trending">Trending</label>
                                    <input type="checkbox" name="trending" value="1">
                                </div>
                            </div>
                            <div>
                                <br>
                                <label class="mb-0">Meta_Title</label><br>
                                <input type="text" name="meta_title" placeholder="Enter Meta title" style="padding: 8px 10px;border:1px solid #b3a1a1 !important" mb-2>
                            </div>
                            <div><br>
                                <label class="mb-0">Meta_Description</label><br>
                                <textarea rows="3" cols="110" name="meta_description" placeholder="Enter Meta Description" style="padding: 8px 10px;border:1px solid #b3a1a1 !important" mb-2></textarea>
                            </div>
                            <div><br>
                                <label class="mb-0">Meta_Keywords</label><br>
                                <textarea rows="3" cols="110" name="meta_keywords" placeholder="Enter  Meta_Keywords" style="padding: 8px 10px;border:1px solid #b3a1a1 !important" mb-2></textarea>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>








<?php include('includes/afooter.php'); ?>