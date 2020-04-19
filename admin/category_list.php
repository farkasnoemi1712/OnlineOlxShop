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

try {
    $categoriesDb = new Categories();
    $categories= $categoriesDb->getAll();
} catch(Exception $e) {
    $categoriess = [];
    $error = true;
}

if(!empty($_GET['delete_categ'])){
    $categoriesDb->delete($_GET['delete_categ']);
    header("Location: category_list.php?id=".$_GET['id']);
}

?>
<body>
    <?php
    include 'include/views/menu.php';
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-5">
                    <h3 class="mb-3">Categories</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($categories as $categ): ?>
                                    <tr>
                                        <td><?php echo $categ['name'] ?></td>
                                        <td><a href="category_edit.php?id=<?=$categ['id']?>">Edit</a></td>
                                        <td>
                                            <a href="category_list.php?id=<?=$categ['id']?>&delete_categ=<?=$categ['id']?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <a href="category_add.php?id=<?=$categ['id']?>">Add</a>
                </div>
            </div>
        </div>
</body>