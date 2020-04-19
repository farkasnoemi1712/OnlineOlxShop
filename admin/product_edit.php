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
include 'include/db/product_photos.class.php';

$productsDb = new Products();
$categoryDb = new Categories();
$productPhotosDb = new ProductPhotos();

$allCategories = $categoryDb->getAll();

if($_GET['id']) {
    $currentProduct = $productsDb->get($_GET['id']);
}

$photos = $productPhotosDb->getAllByProductId($_GET['id']);

if(isset($_POST['submit']) && !empty($_POST['catid']) && !empty($_POST['name']) && !empty($_POST['code'])
    && !empty($_POST['price']) && !empty($_POST['descr'])) {
    try {
        $productsDb->update($_GET['id'], $_POST['catid'], $_POST['name'], $_POST['code'], $_POST['price'], $_POST['descr']);
        if(!empty($_FILES['image']['name']) ) {
            if(move_uploaded_file($_FILES['image']['tmp_name'],"../images/".$_FILES['image']['name'])){
                $productPhotosDb->create($_GET['id'],$_FILES['image']['name']);
            }
        }
        header("Location: product_edit.php?id=".$_GET['id']);
    }
    catch (Exception $e) {
        echo $e->getMessage();
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
                <h5 class="mb-3">Edit Product</h5>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Category Id</label>
                            <select class="form-control" name="catid">
                                <?php foreach($allCategories as $category):?>
                                <option value="<?=$category['id']?>" <?=($currentProduct['category_id'] == $category['id'])?"selected":""?>>
                                    <?=$category['name']?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text"  value="<?=$currentProduct['name']?>" name="name" class="form-control">
                            </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Code</label>
                            <input type="text" value="<?=$currentProduct['code']?>" name="code" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Price</label>
                            <input type="number" value="<?=$currentProduct['price']?>" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Description</label>
                            <textarea class="form-control" name="descr"><?=$currentProduct['description']?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="file" name="image" />
                        </div>
                    </div>
                    <div>
                        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>

                <?php foreach ($photos as $row): ?>
                    <div class="container">
                        <div class="left">
                            <p style="text-align:left"><img src="../images/<?=$row['photo']; ?> "/></p>
                        </div>
                        <div>
                            <a href="product_photo.php?product_id=<?=$row['product_id']?>&photo_id_delete=<?=$row['id']?>" class="btn btn-sm btn-primary">Delete</a>
                            <a href="product_photo.php?product_id=<?=$row['product_id']?>&photo_id_main=<?=$row['id']?>" class="btn btn-sm btn-primary">Set Main</a>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</body>