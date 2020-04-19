<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['auth'])) {
    header('Location: login.php');
}

include 'include/views/head.php';
include 'include/db/products.class.php';
include 'include/db/categories.class.php';

$productsDb = new Products();
$categoryDb = new Categories();

$allCategories = $categoryDb->getAll();

if(isset($_POST['submit']) && !empty($_POST['catid']) && !empty($_POST['name']) && !empty($_POST['code'])
    && !empty($_POST['price']) && !empty($_POST['descr'])){
    if (strlen($_POST['name'])>=3 ) {
        try {
            $productsDb->create($_POST['catid'],$_POST['name'],$_POST['code'],$_POST['price'],$_POST['descr'],$_SESSION['userId']);
            header("Location: product_list.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    else {
        echo "<script>
                alert('Product name should be more than 2 characters');
              </script>";
    }
}
?>
<body>
    <?php
    include 'include/views/menu.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-5">
                <h5 class="mb-3">Add new Product</h5>
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Category Id</label>
                            <select class="form-control" name="catid">
                                <?php foreach($allCategories as $category):?>
                                    <option value="<?=$category['id']?>">
                                        <?=$category['name']?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Description</label>
                            <input type="text" name="descr" class="form-control">
                        </div>
                    </div>
                    <div>
                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>