<?php
$nameErr = $usernameErr = $passErr = $confirmPassErr = "";
$name = $username = $pass = "";

if (isset($_POST['name'], $_POST['username'], $_POST['pass'], $_FILES['photo'])) {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $image = $_FILES['photo'];
    $pass = $_POST['pass'];
    // if (empty($image['tmp_name'])) {
    //     $imagePath = './assets/uploads/emptyuser.png';
    // } else {
    //     $imagePath = $image['name'];
    // }
    if (empty($name)) {
        $nameErr = "Please input name";
    }
    if (empty($username)) {
        $usernameErr = "Please input username";
    }
    if (empty($pass)) {
        $passErr = "Please input password";
    }

    if (usernameExist($username)) {
        $usernameErr = "Please choose another username!";
    }
    if (empty($nameErr) && empty($usernameErr) && empty($passErr)) {
        try {
            if (createUser($name, $username, $pass, $image)) {
                echo '<div class="alert alert-success" role="alert">
                        Register successfully!
                        <a href="./?page=user/list" >Click here for list</a>
                    </div>';
                $name = $username = $pass = "";
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        Register failed!
                    </div>';
            }
        }catch(Exception $e){
            echo '<div class="alert alert-danger" role="alert">
                        '.$e->getMessage().'
                    </div>';
        }
    }
    ;

}


?>
<form class="col-lg-5 col-sm-5 mx-auto" method="post" action="./?page=user/create" enctype="multipart/form-data">
    <h1>Create User</h1>
    <div class="d-flex justify-content-center">
        <input name="photo" type="file" id="profileUpload" hidden>
        <label role="button" for="profileUpload">
            <img src="./assets/uploads/emptyuser.png" class="rounded img-thumbnail" style="max-width: 200px;">
        </label>
    </div>
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" type="text" class="form-control <?= empty($nameErr) ? '' : 'is-invalid'; ?>"
            value="<?= $name ?>" id="exampleInputEmail1">
        <div class="invalid-feedback"><?= $nameErr ?></div>
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" type="text" class="form-control <?= empty($usernameErr) ? '' : 'is-invalid'; ?>"
            value="<?= $username ?>" id="exampleInputEmail1">
        <div class="invalid-feedback"><?= $usernameErr ?></div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="pass" type="password" class="form-control <?= empty($passErr) ? '' : 'is-invalid'; ?>"
            value="<?= $pass ?>" id="exampleInputPassword1">
        <div class="invalid-feedback"><?= $passErr ?></div>
    </div>
    <!-- <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm password</label>
            <input name="confirmPass" type="password" class="form-control <?= empty($confirmPassErr) ? '' : 'is-invalid' ?> ?>" id="exampleInputPassword1">
        </div> -->
    <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>