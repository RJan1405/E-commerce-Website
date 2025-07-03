<!--header-->

<?php

include('functions/userfunctions.php');
include('includes/header.php');

?>


<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">Home / Collections</h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <!--header End-->
                <h1>Our collections</h1>
                <hr>
                <div class="row">

                    <?php
                    $categories = getAllActive("categories");

                    if (mysqli_num_rows($categories) > 0) {

                        foreach ($categories as $items) {


                    ?>
                            <div class="col-md-3 mb-2">
                                <a href="products.php?category=<?= $items['slug']; ?>">
                                    <div class="card shadow">
                                        <div class="card-body">

                                            <img src="uploads/<?= $items['image']; ?>" alt="Category Image" class="w-100" style="height:200px;weight: 10px;">

                                            <h4 class="text-center"><?= $items['name']; ?></h4>

                                        </div>
                                    </div>
                                </a>
                            </div>



                    <?php
                        }
                    } else {
                        echo "No categories found";
                    }

                    ?>


                </div>



            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<?php include('includes/footer.php'); ?>