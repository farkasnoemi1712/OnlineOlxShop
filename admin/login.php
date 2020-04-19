<?php
    session_start();
    if(isset($_SESSION['auth'])) {
        header("Location: product_list.php");
    }

    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        include 'include/db/users.class.php';

        $userClass = new User();
        $loggedUser = $userClass->getLogin($_POST['username'],$_POST['password']);

        if($loggedUser) {
            $_SESSION['auth'] = true;
            $_SESSION['username'] = $loggedUser['name'];
            $_SESSION['userId'] = $loggedUser['id'];
            $_SESSION['admin'] = $loggedUser['is_admin'];
            header("Location: product_list.php");
        }
    }

    include 'include/views/head.php';
?>
<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="/licenta/admin/logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control input_user" value="" placeholder="username">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="button" class="btn login_btn">Login</button>
                        </div>
                    </form>
                </div>
                <div class="mt-4">
                </div>
            </div>
        </div>
    </div>
</body>