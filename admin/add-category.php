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
          <h4>Add category</h4>
        </div>
        <div class="card-body">
        <a href="index.php" class="btn btn-primary float-end"><i class="fa fa-reply"></i> Back</a><br><br><br><br>
          <form action="code.php" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <label for="">Name</label>
                <input type="text" name="name" placeholder="Enter category Name" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px">
              </div>
              <div class="col-md-6">
                <label for="">Slug</label>
                <input type="text" name="slug" placeholder="Enter slug" style="padding: 8px 10px;border:1px solid #b3a1a1 !important;border:8px 10px">
              </div><br><br>
              <div>
                <label for="">Description</label><br>
                <textarea rows="5" cols="110" name="description" placeholder="Enter Description" style="border:1px solid #b3a1a1 !important;border :8px 10px"></textarea>
              </div>
              <div>
                <label for="">Upload Image</label><br>
                <input type="file" name="image" style="padding: 8px 10px;border:1px solid #b3a1a1 !important">
              </div>
              <div>
                <br>
                <label for="">Meta_Title</label><br>
                <input type="text" name="meta_title" placeholder="Enter Meta title" style="padding: 8px 10px;border:1px solid #b3a1a1 !important">
              </div>
              <div>
                <label for="">Meta_Description</label><br>
                <textarea rows="3" cols="110" name="meta_description" placeholder="Enter Meta Description" style="padding: 8px 10px;border:1px solid #b3a1a1 !important"></textarea>
              </div>
              <div>
                <label for="">Meta_Keywords</label><br>
                <textarea rows="3" cols="110" name="meta_keywords" placeholder="Enter  Meta_Keywords" style="padding: 8px 10px;border:1px solid #b3a1a1 !important"></textarea>
              </div>
              <div class="col-md-6">
                <label for="">Status</label>
                <input type="checkbox" name="status" value="1">
              </div>
              <div class="col-md-6">
                <label for="">Popular</label>
                <input type="checkbox" name="popular" value="1"> 
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!--End Center-->

<?php include('includes/afooter.php') ?>