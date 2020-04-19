<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'admin/include/db/categories.class.php';
include 'admin/include/db/products.class.php';

try {
    $productsDb = new Products();
    $categoriesDb = new Categories();
    $categories= $categoriesDb->getAll();

    if (isset($_GET['id']) ){
        //cand exista categorie
        $category = $categoriesDb->get($_GET['id']);
        $categoryName = $category['name'];
        $products = $productsDb->getAllByCategoryId($_GET['id']);

    } else  {
        //cand nu exista categorie
        $categoryName = "Lista produse";
        $products = $productsDb->getAll();
    }

} catch(Exception $e) {
    $categories = [];
    $error = true;
}

?>
<?php
    include 'views/header.php';
?>
<body class="bg-white">

<?php include 'views/top.php'?>
<!--================Home Banner Area =================-->
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <p>Home / Category</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_padding border_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                        <div class="l_w_title">
                            <h3>Browse Categories</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <?php foreach($categories as $categ): ?>
                                    <li>
                                        <a href="category.php?id=<?=$categ['id']?>">
                                           <?=$categ['name']?>
                                        </a>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </aside>

                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_top_bar d-flex justify-content-between align-items-center">
                            <div class="single_product_menu product_bar_item">
                                <h2><?php echo $categoryName?> </h2>
                            </div>
                        </div>
                    </div>


                    <?php foreach($products as $product): ?>
                        <div class="col-lg-4 col-sm-6">
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
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->

<!-- free shipping here -->
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
                    <h4>Free shipping</h4>
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
<!-- free shipping end -->

<!-- subscribe_area part start-->
<section class="instagram_photo">
    <div class="container-fluid>
            <div class="row">
    <div class="col-lg-12">
        <div class="instagram_photo_iner">
            <div class="single_instgram_photo">
                <img src="assets/img/instagram/inst_1.png" alt="">
                <a href="#"><i class="ti-instagram"></i></a>
            </div>
            <div class="single_instgram_photo">
                <img src="assets/img/instagram/inst_2.png" alt="">
                <a href="#"><i class="ti-instagram"></i></a>
            </div>
            <div class="single_instgram_photo">
                <img src="assets/img/instagram/inst_3.png" alt="">
                <a href="#"><i class="ti-instagram"></i></a>
            </div>
            <div class="single_instgram_photo">
                <img src="assets/img/instagram/inst_4.png" alt="">
                <a href="#"><i class="ti-instagram"></i></a>
            </div>
            <div class="single_instgram_photo">
                <img src="assets/img/instagram/inst_5.png" alt="">
                <a href="#"><i class="ti-instagram"></i></a>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<!--::subscribe_area part end::-->

<?php include 'views/footer.php'?>
</body>

</html>