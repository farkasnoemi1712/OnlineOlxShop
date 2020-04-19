<?php
session_start();
include 'admin/include/db/categories.class.php';
include 'admin/include/db/products.class.php';

$subTotal = 0;

try {
    $categoriesDb = new Categories();
    $categories= $categoriesDb->getAll();

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

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if(!empty($_POST['pqty'])){
   $_SESSION['cart'] = $_POST['pqty'];
}

if(!empty($_POST['product_id']) && !empty($_POST['qty'])) {
    $productId = $_POST['product_id'];
    $qty = $_POST['qty'];
    $_SESSION['cart'][$productId] = $qty;

}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

include 'views/header.php';
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
                          <p>Home/Shop/Single product/Cart list</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Cart Area =================-->
  <section class="cart_area section_padding">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
        <form method="post">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>

             <?php foreach($_SESSION['cart'] as $productId => $qty):?>
               <?php //select product by id
                 $productsDb = new Products();
                 $products = $productsDb->get($productId);
               ?>
              <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                      <img src="img/arrivel/arrivel_1.png" alt="" />
                    </div>
                    <div class="media-body">
                        <p><?=$products['name'];?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5><?=$products['price'];?></h5>
                </td>
                <td>
                  <div class="product_count">
                    <input class="input-number" name="pqty[<?=$products['id']?>]" value="<?=$qty?>" type="number" value="1" min="0" max="10">
                  </div>
                </td>
                <td>
                  <h5><?php
                      $subTotal = $subTotal + $products['price'] * $qty;
                      echo $products['price'] * $qty;
                      ?></h5>
                </td>
              </tr>
              <?php endforeach?>

              <tr class="bottom_button">
                <td>
                    <input type="submit" value="Update Cart" class="btn_1">
                </td>
                <td></td>
                <td></td>
                <td>
                  <div class="cupon_text float-right">
                    <a class="btn_1" href="#">Close Coupon</a>
                  </div>
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>Subtotal</h5>
                </td>
                <td>
                  <h5><?=$subTotal?></h5>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="#">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1" href="checkout.php">Proceed to checkout</a>
          </div>
        </div>
      </div>
  </section>
 <?php include 'views/footer.php'?>
</body>

</html>