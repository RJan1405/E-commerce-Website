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
                    
                    <?php
                    if (isset($_GET['id'])) {

                        $id = $_GET['id'];
                        $category = getByID("categories", $id);

                        if (mysqli_num_rows($category) > 0) {

                            $data = mysqli_fetch_array($category);





                    ?>


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
                                    <h4>Edit category</h4>
                                </div>
                                
                                <div class="card-body">
                                <a href="category.php" class="btn btn-primary float-end"><i class="fa fa-reply"></i> Back</a><br><br><br><br>
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                                <label for="">Name</label>
                                                <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter category Name" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Slug</label>
                                                <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter slug" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px">
                                            </div><br><br>
                                            <div>
                                                <label for="">Description</label><br>
                                                <textarea rows="5" cols="110" name="description" placeholder="Enter Description" style="border:1px solid #b3a1a1 !important;border :8px 10px"><?= $data['description'] ?></textarea>
                                            </div>
                                            <div>
                                                <label for="">Upload Image</label><br>
                                                <input type="file" name="image" style="padding: 8px 10px;border:1px solid #b3a1a1 !important">
                                                <br><br><label for="">Current Image</label><br>
                                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                                <img src="../uploads/<?= $data['image'] ?>" height="100px" width="100px" alt="">
                                            </div>
                                            <div>
                                                <br>
                                                <label for="">Meta_Title</label><br>
                                                <input type="text" name="meta_tittle" value="<?= $data['meta_tittle'] ?>" placeholder="Enter Meta title" style="padding: 8px 10px;border:1px solid #b3a1a1 !important">
                                            </div>

                                            <div>
                                                <label for="">Meta_Description</label><br>
                                                <textarea rows="3" cols="110" name="meta_description" placeholder="Enter Meta Description" style="padding: 8px 10px;border:1px solid #b3a1a1 !important"><?= $data['meta_description'] ?></textarea>
                                            </div>
                                            <div>
                                                <label for="">Meta_Keywords</label><br>
                                                <textarea rows="3" cols="110" name="meta_keywords" placeholder="Enter  Meta_Keywords" style="padding: 8px 10px;border:1px solid #b3a1a1 !important"><?= $data['meta_keywords'] ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Status</label>
                                                <input type="checkbox" <?= $data['status'] ? "checked" : "" ?> name="status">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Popular</label>
                                                <input type="checkbox" <?= $data['popular'] ? "checked" : "" ?> name="popular">
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                    <?php
                        } else {
                            echo "Category Not found";
                        }
                    } else {
                        echo "Id missing from url";
                    }


                    ?>
                </div>
            </div>
        </div>
        <!--End Center-->

 <?php include('includes/afooter.php'); ?>

       