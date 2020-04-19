<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['auth'])) {
    header('Location: login.php');
}
if(empty($_SESSION['admin'])){
    header("Location: product_list.php");
}

include 'include/views/head.php';
include 'include/db/order_products.class.php';
include 'include/db/orders.class.php';

try {
    $orderProductsDb = new OrderProducts();
    $orderProducts= $orderProductsDb->getByOrderId($_GET['id']);
    $orderClass = new Orders();
    $order = $orderClass->get($_GET['id']);
//    echo '<pre>';
//    print_r($orderProducts);
} catch(Exception $e) {
    $orderProducts = [];
    $error = true;
}

?>
<body>
    <?php
    include 'include/views/menu.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-5">
                <h5>Order </h5>
                <?php echo $order['firstname'] ?> <br>
                <?php echo $order['lastname'] ?> <br>
                <?php echo $order['address'] ?> <br>
                <?php echo $order['email'] ?> <br>
                <?php echo $order['phone'] ?> <br>
                <?php echo $order['date'] ?> <br>
                <br><br>

                <h3 class="mb-3">Order view</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th class="text-right" scope="col">Qty</th>
                        <th class="text-right" scope="col">Price</th>
                        <th class="text-right" scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0;?>
                    <?php foreach($orderProducts as $orderProduct): ?>
                        <tr>
                            <td ><?php echo $orderProduct['name'] ?></td>
                            <td align="right"><?php echo $orderProduct['qty'] ?></td>
                            <td align="right"><?php echo $orderProduct['price'] ?></td>
                            <td align="right">
                                <?php
                                    $subtotal = $orderProduct['qty']*$orderProduct['price'];
                                    $total += $subtotal;
                                    echo $subtotal;
                                ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" align="right">
                                <b>Total general:</b> <?=$total?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>