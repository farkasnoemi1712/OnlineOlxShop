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
include 'include/db/users.class.php';

if(isset($_POST['submit']) && !empty($_POST['name']) &&
    !empty($_POST['password'])  && !empty($_POST['confpassword']) && $_POST['password'] == $_POST['confpassword'] ) {
    try {
        $isAdmin = isset($_POST['isadmin'])?1:0;
        $usersDb = new User();
        $usersDb->updateAll($_GET['id'], $_POST['name'], $_POST['password'], $isAdmin);
        header("Location: user_list.php");
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
                <h5 class="mb-3">Edit User</h5>
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Username</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Confirm password</label>
                            <input type="text" name="confpassword" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="isadmin" class="form-check-input">
                                <label class="form-check-label"  for="exampleCheck1">Admin</label>
                            </div>
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