<?php
    // include '../../includes/header.inc.php';
    // include '../../includes/navbar.inc.php';
    //include $_SERVER['DOCUMENT_ROOT'] . '/G19BCSY3A/includes/header.inc.php';
    //include $_SERVER['DOCUMENT_ROOT'] . '/G19BCSY3A/includes/navbar.inc.php';
    // if(isset($_POST['email'])){
    //     echo $_POST['email'];
    // }
    $nameErr = $usernameErr = $passErr = $confirmPassErr = "";
    $name = $username = $pass= "";
    if(isset($_POST['name'], $_POST['username'],$_POST['pass'], $_POST['confirmPass'])){
        $name = trim($_POST['name']);
        $username = trim($_POST['username']);
        $pass = $_POST['pass'];
        $confirmPass = trim($_POST['confirmPass']);
        if(empty($name)){
            $nameErr = "Please input name";
        }
        if(empty($username)){
            $usernameErr = "Please input username";
        }
        if(empty($pass)){
            $passErr = "Please input password";
        }
        if($pass !=$confirmPass){
            $confirmPassErr = "Not match password!";
        }
        

        if(usernameExist($username)){
            $usernameErr = "Please choose another username!";
        }
        if(empty($nameErr) && empty($usernameErr) && empty($passErr)){
            if(userRegister($name, $username, $pass, null)){
                echo '<div class="alert alert-success" role="alert">
                        Register successfully!
                    </div>';
                $name = $username = $pass = "";
            }
            else{
                echo '<div class="alert alert-danger" role="alert">
                        Register failed!
                    </div>';
            }
        };
        
    }
?>
    

    
    <form class="col-lg-5 col-sm-5 mx-auto" method="post" action="./?page=register ">
        <h1>Register page</h1>
        <div class="mb-3">
            <label  class="form-label">Name</label>
            <input name="name" type="text" class="form-control <?= empty($nameErr) ? '':'is-invalid'; ?>" value="<?= $name ?>" id="exampleInputEmail1">
            <div class="invalid-feedback"><?= $nameErr ?></div>
        </div>
        <div class="mb-3">
            <label  class="form-label">Username</label>
            <input name="username" type="text" class="form-control <?= empty($usernameErr) ? '':'is-invalid'; ?>"  value="<?= $username ?>" id="exampleInputEmail1">
            <div class="invalid-feedback"><?= $usernameErr ?></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="pass" type="password" class="form-control <?= empty($passErr) ? '':'is-invalid'; ?>" value="<?= $pass ?>" id="exampleInputPassword1">
            <div class="invalid-feedback"><?= $passErr ?></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm password</label>
            <input name="confirmPass" type="password" class="form-control <?= empty($confirmPassErr) ?'':'is-invalid' ?> ?>" id="exampleInputPassword1">
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>





