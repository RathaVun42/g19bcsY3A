<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $targetUser = readUser($id);
        if($targetUser == null || $targetUser->level == 'admin'){
            header("Location: ./?page=user/list");
        }else{
            if(deleteUser($id)){
                header("Location: ./?page=user/list&status=1");exit;
            }else{
                header("Location: ./?page=user/list&status=0");exit;
            }
        }
    }
?>