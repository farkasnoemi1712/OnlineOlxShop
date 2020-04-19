<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['auth'])) {
    header('Location: login.php');
}

include 'include/views/head.php';
include 'include/db/product_photos.class.php';
include 'include/db/products.class.php';

$productPhotosDb = new ProductPhotos();
$productsDb = new Products();

if(!empty($_GET['photo_id_delete'])) {
    try {
        $photo = $productPhotosDb->getPhoto($_GET['photo_id_delete']); // ['photo' => 'c1.png']

        $productMainPhoto = $productsDb->isMain($_GET['product_id']);
        $productPhotosDb->delete($_GET['photo_id_delete']);

        if ($productMainPhoto["photo_id"] == $_GET['photo_id_delete']){
            $productsDb->deleteMainPhoto($_GET['product_id']);
        }
        @unlink('../images/'.$photo['photo']);
        header("Location: product_edit.php?id=".$_GET['product_id']);
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

if(!empty($_GET['photo_id_main'])){
    try {
        $productsDb->setMainPhoto($_GET['product_id'], $_GET['photo_id_main']);
        header("Location: product_edit.php?id=".$_GET['product_id']);
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
</body>