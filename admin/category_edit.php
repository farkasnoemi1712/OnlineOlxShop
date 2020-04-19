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
include 'include/db/categories.class.php';

$categoriesDb = new Categories();

if(isset($_GET['id'])) {
    $currentCategory = $categoriesDb->get($_GET['id']);
}


if(isset($_POST['submit']) && !empty($_POST['cname'])) {

    try {
        $categoriesDb->update($_GET['id'], $_POST['cname']); //post?
        header("Location: category_list.php");
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
                <h5 class="mb-3">Edit Category</h5>
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Category Name</label>
                            <input type="text" name="cname" value="<?=$currentCategory['name']?>" class="form-control">
                        </div>
                    </div>
                    <div>
                        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>