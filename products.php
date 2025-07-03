<!--header-->

<?php

include('functions/userfunctions.php');
include('includes/header.php');

if (isset($_GET['category'])) {
    $category_slug = $_GET['category'];
    $category_data = getSlugActive("categories", $category_slug);
    $category = mysqli_fetch_array($category_data);

    if ($category) {
        $cid = $category['id'];

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
                    <?= $category['name']; ?>
                </h6>
            </div>
        </div>
        <div class="py-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <!--header End-->
                        <h2><?= $category['name']; ?></h2>
                        <hr>
                        <div class="row">

                            <?php
                            $products = getProductByCategory($cid);

                            if (mysqli_num_rows($products) > 0) {

                                foreach ($products as $items) {


                            ?>
                                    <div class="col-md-3 mb-2">
                                        <a href="product_view.php?product=<?= $items['slug']; ?>">
                                            <div class="card shadow">
                                                <div class="card-body">

                                                    <img src="uploads/<?= $items['image']; ?>" alt="Product Image" class="w-100" style="height:200px;weight: 10px;">

                                                    <h4 class="text-center"><?= $items['name']; ?></h4>

                                                </div>
                                            </div>
                                        </a>
                                    </div>



                            <?php
                                }
                            } else {
                                echo "No Products found";
                            }

                            ?>


                        </div>



                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

<?php

    } else {
        echo "Something Went Wrong";
    }
} else {
    echo "Something Went Wrong";
}


include('includes/footer.php'); ?>