<?php
session_start();
include 'views/header.php';
include 'admin/include/db/categories.class.php';
include 'admin/include/db/products.class.php';

try {
    $categoriesDb = new Categories();
    $categories= $categoriesDb->getAll();
    $productsDb = new Products();

    $products = $productsDb->getLastSixProducts();

    if (isset($_GET['id']) ){
        $category = $categoriesDb->get($_GET['id']);
        $categoryName = $category['name'];
    }
    else{
        $categoryName = "Lista produse";
    }
} catch(Exception $e) {
    $categories = [];
    $error = true;
}
?>

<body>
    <?php include 'views/top.php';
    ?>
    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="banner_slider">
                        <div class="single_banner_slider">
                            <div class="banner_text">
                                <div class="banner_text_iner">
                                    <h5>Winter Fasion</h5>
                                    <h1>Fashion Collection 2019</h1>
                                    <a href="#" class="btn_1">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start innen-->

    <section class="cat_product_area section_padding border_top">
        <div class="container">
            <div class="row">

                        <?php foreach($products as $product): ?>
                            <div class="col-lg-2 col-sm-4">
                                <div class="single_category_product">
                                    <div class="single_category_img">
                                        <div class="img_wrapper">
                                            <a href="product.php?id=<?=$product['id']?>">
                                                <img src="images/<?=$product['photo']; ?> " alt="">
                                            </a>
                                        </div>
                                        <div class="category_product_text">
                                            <a href="product.php?id=<?=$product['id']?>"><h5><?=$product['name'] ?></h5></a>
                                            <p><?=$product['price']?> lei</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
            </div>
        </div>
    </section>

    <!-- free shipping here eddig-->
    <section class="shipping_details section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single_shopping_details">
                        <img src="assets/img/icon/icon_1.png" alt="">
                        <h4>Free delivery</h4>
                        <p>Get Free Shipping on all orders!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_shopping_details">
                        <img src="assets/img/icon/icon_2.png" alt="">
                        <h4>Verification list</h4>
                        <p>You can check on delivery</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_shopping_details">
                        <img src="assets/img/icon/icon_3.png" alt="">
                        <h4>Online payment services</h4>
                        <p>Credit card payments/Paypal</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_shopping_details">
                        <img src="assets/img/icon/icon_4.png" alt="">
                        <h4>Call service</h4>
                        <p>24/7 Customer Service</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- free shipping end -->


 <?php include 'views/footer.php'?>
</body>

</html>