<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['auth'])) {
    header('Location: login.php');
}

include 'include/views/head.php';
include 'include/db/users.class.php';

try {
    $usersDb = new User();
    $users= $usersDb->getAll();
} catch(Exception $e) {
    $users = [];
    $error = true;
}

if(empty($_SESSION['admin'])){
    header("Location: product_list.php");
}

if(!empty($_GET['delete_user'])){
    $usersDb->delete($_GET['delete_user']);
    header("Location: user_list.php?id=".$_GET['id']);
}

?>
<body>
    <?php
    include 'include/views/menu.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-5">
                <h3 class="mb-3">Users</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $users1): ?>
                        <tr>
                            <td><?php echo $users1['name'] ?></td>
                            <td><?php echo $users1['is_admin'] ?></td>
                            <td><a href="user_edit.php?id=<?=$users1['id']?>">Edit</a></td>
                            <td>
                                <a href="user_list.php?id=<?=$users1['id']?>&delete_user=<?=$users1['id']?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <a href="user_add.php?id=<?=$users1['id']?>">Add</a>
            </div>
        </div>
    </div>
</body>