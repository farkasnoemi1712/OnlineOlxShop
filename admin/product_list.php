<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['auth'])) {
    header('Location: login.php');
}

include 'include/views/head.php';
include 'include/db/products.class.php';

try {
    $productsDb = new Products();

    if(!empty($_SESSION['admin'])) { //daca e admin
        $products= $productsDb->getAll(null);
    }
    else {
        $products= $productsDb->getAll($_SESSION['userId']);
    }

} catch(Exception $e) {
    $products = [];
    $error = true;
}

if(!empty($_GET['delete_prod'])){
    $productsDb->delete($_GET['delete_prod']);
    header("Location: product_list.php");
}

?>
<body>
    <?php
    include 'include/views/menu.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-5">
                <h3 class="mb-3">Products</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($products as $products1): ?>
                        <tr>
                            <td><?php echo $products1['name'] ?></td>
                            <td><?php echo $products1['code'] ?></td>
                            <td><?php echo $products1['price'] ?></td>
                            <th><?php echo $products1['category_name'] ?></th>
                            <td><a href="product_edit.php?id=<?=$products1['id']?>">Edit</a></td>
<!--                            <td><a href="product_delete.php?id=--><?//=$products1['id']?><!--">Delete</a></td>-->
                            <td>
                                <a href="product_list.php?id=<?=$products1['id']?>&delete_prod=<?=$products1['id']?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <?php if(empty($_SESSION['admin'])):?>
                    <a href="product_add.php?id=<?=$products1['id']?>">Add</a>
                <?php endif;?>
            </div>
        </div>
    </div>
</body>