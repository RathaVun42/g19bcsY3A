<?php
$nameErr = $usernameErr = $passErr = $confirmPassErr = "";
$name = $username = $pass = "";
if(isset($_GET['status'])){
    if($_GET['status'] == 1){
                        echo '<div class="alert alert-success" role="alert">
                         Update successfully!
                         <a href="./?page=user/list" >Click here for list</a>
                     </div>';
    }
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $targetUser = readUser($id);
    if($targetUser == null || $targetUser->level == 'admin'){
        header("Location: ./?page=user/list");
    }else{
        $name = $targetUser->Name;
        $username =$targetUser->UserName;
    }
}
if (isset($_POST['name'], $_POST['username'], $_POST['pass'], $_FILES['photo'])) {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $image = $_FILES['photo'];
    $pass = $_POST['pass'];
    if (empty($name)) {
        $nameErr = "Please input name";
    }
    if (empty($username)) {
        $usernameErr = "Please input username";
    }
    if (empty($pass)) {
        $pass = $targetUser->UserID;
    }

    if ($targetUser->UserName !== $username && usernameExist($username)) {
        $usernameErr = "Please choose another username!";
    }
    if (empty($nameErr) && empty($usernameErr)) {
        try {
            if(updateUser($id, $name, $username, $pass,$image)){
                header('location: ./?page=user/update&id='.$id.'&status=1'); // with header also similar to reload page in js
                                                                             // because it gives us new direction, when have new direction also have page reload
                                                                             // remember!! with header it will work as priority (work at first) and end with exit;
                exit;
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
<h1 class="mt-5" style="margin-left: 20px;">Update user</h1>
<form class="col-lg-5 col-sm-5 mx-auto" method="post" action="./?page=user/update&id=<?= $id ?>" enctype="multipart/form-data">
    <div class="d-flex justify-content-center imgContainer">
        <input name="photo" type="file" id="profileUpload" class="photo" hidden>
        <label role="button" for="profileUpload">
            <img src="<?php echo $targetUser->image ?? './assets/uploads/emptyuser.png'?>" class="img rounded img-thumbnail" style="max-width: 200px;">
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
        <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>