<?php

include('functions/userfunctions.php');
include('includes/header.php');

if (isset($_GET['product'])) {

    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products", $product_slug);
    $product = mysqli_fetch_array($product_data);

    if ($product) {
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
                    <?= $product['name']; ?>
                </h6>
            </div>
        </div>
        <div class="bg-light py-4">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <br><img src="uploads/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                        </div>

                    </div>
                    <div class="col-md-8"><br>
                        <h4 class="fw-bold"><?= $product['name']; ?>
                            <span class="float-end text-danger">
                                <?php if ($product['trending'] == 1) {
                                    echo "Trending";
                                } ?>
                            </span>


                        </h4>
                        <hr>
                        <p><?= $product['small_description']; ?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Rs <span class="text-success fw-bold"> <?= $product['selling_price']; ?></span></h5>

                            </div>
                            <div class="col-md-6">
                                <h5>Rs <s class="text-danger"><?= $product['original_price']; ?></s></h5>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width: 130px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text decrement-btn">-</span>
                                    </div>
                                    <input type="text" class="form-control bg-white text-center input-qty" value="1" disabled min="1">
                                    <div class="input-group-append">
                                        <span class="input-group-text increment-btn">+</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary px-4 addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="productID">
                                <button class="btn btn-success px-4 " onclick="location.href='slot.php?product_ID=<?= $product['id']; ?>'" value="<?= $product['id']; ?>"><i class="fa fa-car me-2"></i>Book a test drive</button>
                            </div>
                            
                        </div>


                        <hr>
                        <h6>Product Description</h6>
                        <p><?= $product['description']; ?></p>

                    </div>
                </div>
            </div>
        </div>


<?php

    } else {
        echo "Product Not Found";
    }
} else {
    echo "Something Went Wrong";
}


include('includes/footer.php'); ?>