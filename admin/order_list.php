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
include 'include/db/orders.class.php';

try {
    $order_listDb = new Orders();
    $order_list= $order_listDb->getAll();
} catch(Exception $e) {
    $order_list = [];
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
                <h3 class="mb-3">Orders</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="'col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($order_list as $ord_list): ?>
                        <tr>
                            <td><?php echo $ord_list['date'] ?></td>
                            <td><?php echo $ord_list['firstname'] ?></td>
                            <td><?php echo $ord_list['lastname'] ?></td>
                            <td><?php echo $ord_list['address'] ?></td>
                            <td><?php echo $ord_list['email'] ?></td>
                            <td><?php echo $ord_list['phone'] ?></td>
                            <td><a href="order_view.php?id=<?=$ord_list['id']?>">View</a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>