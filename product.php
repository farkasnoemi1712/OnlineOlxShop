<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'views/header.php';
include 'admin/include/db/categories.class.php';
include 'admin/include/db/products.class.php';
include 'admin/include/db/product_photos.class.php';

try {
    $categoriesDb = new Categories();
    $categories= $categoriesDb->getAll();

    $productsDb = new Products();
    $product_photos = new ProductPhotos();

    if (isset($_GET['id']) ){
        $category = $categoriesDb->get($_GET['id']);
        $categoryName = $category['name'];

        $product = $productsDb->get($_GET['id']);
        $productPhotos = $product_photos->get($_GET['id']);

        $categoriesDb = new Categories();//?
        $category = $categoriesDb->get($product['category_id']);
    }

    else{
        $categoryName = "Lista produse";
        $product = $productsDb->getAll();
    }
} catch(Exception $e) {
    $categories = [];

    $error = true;
}

?>

<body class="bg-white">

<?php include 'views/top.php'?>

<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <p>Home/Shop/Product</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--================Single Product Area =================-->

<div class="product_image_area section_padding">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-4">

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <?php $i = 0; ?>
                    <ol class="carousel-indicators">
                        <?php foreach($productPhotos as $photo): ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>" class="active"></li>
                            <? $i++; ?>
                        <?php endforeach;?>
                    </ol>
                    <div class="carousel-inner">
                        <?php $i = 1; ?>
                        <?php foreach($productPhotos as $photo): ?>
                            <?php if ($i == 1): ?>
                                <div class="carousel-item active">
                                    <img src="images/<?=$photo['photo']; ?> " class="d-block w-100" alt="...">
                                </div>
                            <?php else: ?>
                                <div class="carousel-item ">
                                    <img src="images/<?=$photo['photo']; ?> " class="d-block w-100" alt="...">
                                </div>
                            <?php endif; ?>
                        <?php $i++; ?>
                        <?php endforeach;?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" style="box-shadow: 0 3px 6px #002221" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" style="box-shadow: 0 3px 6px #002221" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
            <div class="col-lg-6 offset-lg-1">
                   <div class="s_product_text">
                        <h3><?=$product['name']?></h3>
                        <h2><?=$product['price']?> lei</h2>
                        <ul class="list">
                            <li>
                                <a class="active" href="#">
                                    <span>Category</span> : <?=$category['name'] ?></a>
                            </li>
                            <li>
                                <a class="active" href="#">
                                    <span>Phone</span> : 0743569712 </a>
                            </li>
                        </ul>
                        <p>
                            <?=$product['description'] ?>
                        </p>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?=$product['id']?>" />
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->


<!-- shipping details part end-->
<section class="shipping_details section_padding border_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single_shopping_details">
                    <img src="assets/img/icon/icon_1.png" alt="">
                    <h4>Free shipping</h4>
                    <p>Divided face for bearing the divide unto seed winged divided light Forth.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_shopping_details">
                    <img src="assets/img/icon/icon_2.png" alt="">
                    <h4>Verification list</h4>
                    <p>Divided face for bearing the divide unto seed winged divided light Forth.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_shopping_details">
                    <img src="assets/img/icon/icon_3.png" alt="">
                    <h4>Free shipping</h4>
                    <p>Divided face for bearing the divide unto seed winged divided light Forth.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_shopping_details">
                    <img src="assets/img/icon/icon_4.png" alt="">
                    <h4>Free shipping</h4>
                    <p>Divided face for bearing the divide unto seed winged divided light Forth.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shipping details part end-->

<?php include 'views/footer.php'?>
<script>
    $('.carousel').carousel();
</script>
</body>
</html>