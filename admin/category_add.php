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

if(isset($_POST['submit']) && !empty($_POST['catname']) ){
    if (strlen($_POST['catname'])>=3 ) {
        try {
            $categoriesDb = new Categories();
            $categoriesDb->create($_POST['catname']);
            header("Location: category_list.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    else {
        echo "<script>
                alert('Category name should be more than 2 characters');
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
                <h5 class="mb-3">Add new Category</h5>
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Category name</label>
                            <input type="text" name="catname" class="form-control">
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