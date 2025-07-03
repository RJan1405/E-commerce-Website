<!--header-->

<?php

include('functions/userfunctions.php');
include('includes/header.php');
include('includes/slider.php');

?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h4>Trending Products</h4>
                <div class="underline mb-2"></div>

                <div class="owl-carousel">



                    <?php

                    $trendingProducts = getAllTrending();
                    if (mysqli_num_rows($trendingProducts) > 0) {
                        foreach ($trendingProducts as $items) {
                    ?>
                            <div class=" item">
                                <a href="product_view.php?product=<?= $items['slug']; ?>">
                                    <div class="card shadow">
                                        <div class="card-body">

                                            <img src="uploads/<?= $items['image']; ?>" alt="Product Image" class="w-100" style="height:200px;weight: 10px;">

                                            <h6 class="text-center"><?= $items['name']; ?></h6>

                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php

                        }
                    }



                    ?>
                </div>


            </div>
        </div>
    </div>
</div>




<div class="py-5 bg-f2f2f2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h4>About Us</h4>
                <div class="underline mb-2"></div>
                <p>We provide best vehicles in area</p>
            </div>
        </div>
    </div>
</div>





<div class="py-5 bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <h4 class="text-white">Akshar Motors</h4>
                <div class="underline mb-2"></div>
                <a href="index.php" class="text-white"><i class="fa fa-angle-right"></i>Home</a> <br>
                <a href="#" class="text-white"><i class="fa fa-angle-right"></i>About Us</a> <br>
                <a href="cart.php" class="text-white"><i class="fa fa-angle-right"></i>My Cart</a> <br>
                <a href="categories.php" class="text-white"><i class="fa fa-angle-right"></i>Our Collections</a>
            </div>
            <div class="col-md-3">
                <h4 class="text-white">Address</h4>
                <p class="text-white">
                    At Post.Valvada Near N.H. No.48,St.Karambeli,
                    Tal.Umargam Dist.Valsad,(Gujarat) Pin-396105
                </p>

                <a href="tel:+919054183126" class="text-white"><i class="fa fa-phone"></i> +91 9054183126</a><br>
                <a href="mailto:akshar.motors55@gmail.com" class="text-white"><i class="fa fa-envelope"></i> akshar.motors55@gmail.com</a>
            </div>
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d957950.3971093737!2d72.4162031!3d20.3005263!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be0d27514f5aefd%3A0x8cb702267918b295!2sKarambele%2C%20Gujarat%20396105!5e0!3m2!1sen!2sin!4v1730797526395!5m2!1sen!2sin" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </div>
    </div>
</div>
<div class="py-2 bg-danger">
    <div class="text-center">
        <p class="mb-0 text-white">All right reserved.Copyright @ RJ -<?= date('Y') ?></p>
    </div>
</div>






<!-- Optional JavaScript; choose one of the two! -->

<?php include('includes/footer.php'); ?>
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
</script>