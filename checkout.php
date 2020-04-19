<?php
session_start();
include 'admin/include/db/categories.class.php';
include 'admin/include/db/products.class.php';
include 'admin/include/db/orders.class.php';
include 'admin/include/db/order_products.class.php';

if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['address'])
    && !empty($_POST['email']) && !empty($_POST['phone'])){
        try {
            $ordersDb = new Orders();
            $orderId = $ordersDb->create($_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['email'], $_POST['phone']);

            print_r($_SESSION[cart]);

            $productsDb = new Products();
            $orderProductsDb = new OrderProducts();

            foreach($_SESSION['cart'] as $productId => $qty)
            {
                $product = $productsDb->get($productId);
                $orderProductsDb->create($productId, $product['price'], $qty, $orderId );
            }
//          unset($_SESSION['cart']) //itt

        } catch (Exception $e) {
            echo $e->getMessage();
        }
}

include 'views/header.php';
?>

<body class="bg-white">
<?php include 'views/top.php'?>

    <!--================Checkout Area =================-->
    <section class="checkout_area section_padding">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="first" name="firstname" />
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="last" name="lastname" />
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>
                            <div class="col-md-8 form-group p_star">
                                <input type="text" class="form-control" id="address" name="address" />
                                <span class="placeholder" data-placeholder="Address"></span>
                            </div>
                            <div class="col-md-8 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" />
                                <span class="placeholder" data-placeholder="Email"></span>
                            </div>
                            <div class="col-md-7 form-group">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"/>
                            </div>
                            <div class="col-md-7 form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="#">Product
                                        <span>Total</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Fresh Blackberry
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Fresh Tomatoes
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Fresh Brocoli
                                        <span class="middle">x 02</span>
                                        <span class="last">$720.00</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a href="#">Subtotal
                                        <span>$2160.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Shipping
                                        <span>Flat rate: $50.00</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Total
                                        <span>$2210.00</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="selector" />
                                    <label for="f-option5">Check payments</label>
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Please send a check to Store Name, Store Street, Store Town,
                                    Store State / County, Store Postcode.
                                </p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="selector" />
                                    <label for="f-option6">Paypal </label>
                                    <img src="img/product/single-product/card.jpg" alt="" />
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Please send a check to Store Name, Store Street, Store Town,
                                    Store State / County, Store Postcode.
                                </p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector" />
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms & conditions*</a>
                            </div>
                            <a class="btn_3" href="#">Proceed to Paypal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->

    <!-- subscribe_area part start-->
    <section class="instagram_photo">
        <div class="container-fluid>
          <div class="row">
        <div class="col-lg-12">
            <div class="instagram_photo_iner">
                <div class="single_instgram_photo">
                    <img src="img/instagram/inst_1.png" alt="">
                    <a href="#"><i class="ti-instagram"></i></a>
                </div>
                <div class="single_instgram_photo">
                    <img src="img/instagram/inst_2.png" alt="">
                    <a href="#"><i class="ti-instagram"></i></a>
                </div>
                <div class="single_instgram_photo">
                    <img src="img/instagram/inst_3.png" alt="">
                    <a href="#"><i class="ti-instagram"></i></a>
                </div>
                <div class="single_instgram_photo">
                    <img src="img/instagram/inst_4.png" alt="">
                    <a href="#"><i class="ti-instagram"></i></a>
                </div>
                <div class="single_instgram_photo">
                    <img src="img/instagram/inst_5.png" alt="">
                    <a href="#"><i class="ti-instagram"></i></a>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <?php include 'views/footer.php'?>
</body>
