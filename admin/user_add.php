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

if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])
    && !empty($_POST['confirmpassword']) && $_POST['password'] == $_POST['confirmpassword'] ) {
    if (strlen($_POST['username'])>=4 ) {
        try {
            $isAdmin = isset($_POST['isadmin'])?1:0;
            $userDb = new User();
            $userDb->create($_POST['username'],$_POST['password'],$isAdmin);
            header("Location: user_list.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    else {
        echo "<script>
                alert('Username should be more than 4 characters');
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
                <h5 class="mb-3">Add new User</h5>
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
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
                            <input type="text" name="confirmpassword" class="form-control">
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
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>