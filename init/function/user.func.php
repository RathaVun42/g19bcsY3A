<?php
    function createUser($name,$username,$passwd,$image)  {
        global $con;
        $imagePath = null;
        if(!empty($image['name'])){
            $imagePath = uploadImage($image);
        }
        $query = $con->prepare("insert into tbl_user (name, username, passwd, image) values(?,?,?,?)");
        $query->bind_param('ssss',$name,$username,$passwd,$imagePath);// the first s is for the first param that have data type as string
        $query->execute();
        if($query->affected_rows){// this will check whether query can insert to db or not
            return true;
        }
        return false;
        
    }
    function getUsers(){
        global $con;
        $query = $con->prepare("SELECT * FROM tbl_user WHERE level <> 'admin'"); // <> means is not
        $query->execute();
        $result = $query->get_result(); // get_result() will select all the record that are matched to the condition, but it is not object
        if($result->num_rows){
            return $result;
        }else{
            return null;
        }
    }
    function readUser($id){
        global $con;
        $query = $con->prepare("SELECT * FROM tbl_user WHERE UserID = ?"); // <> means is not
        $query->bind_param("i",$id);
        $query->execute();
        $result = $query->get_result(); // get_result() will select all the record that are matched to the condition, but it is not object
        if($result->num_rows >0){
            return $result->fetch_object();
        }else{
            return null;
        }
    }
    function updateUser($id, $name, $username, $pass, $photo ){
        global $con;
        $user = readUser($id);
        $photoPath = null;
        if(!empty($photo['name'])){
            $photoPath = uploadImage($photo);
        }else{
            $photoPath = $user->image ?? './assets/uploads/emptyuser.png';
        }
        if(!empty($user->image) && $user->image !== './assets/uploads/emptyuser.png'){
            if(file_exists($user->image)){
                unlink($user->image);
            }
        }
        $query = $con->prepare("UPDATE `tbl_user` SET `Name`=?,`UserName`=?,`passwd`=?,`image`=? WHERE UserID = ?");
        $query->bind_param("ssssi", $name, $username, $pass, $photoPath, $id);
        $query->execute();
        if($query->affected_rows){
            return true;
        }else{
            return false;
        }
    }
    function deleteUser($id){
        global $con;
        $user = readUser($id);
        if(!empty($user->image)){
            unlink($user->image);
        }
        $query = $con->prepare('DELETE FROM `tbl_user` WHERE UserID = ?');
        $query->bind_param('i', $id);
        $query->execute();
        if($query->affected_rows){
            return true;
        }else{
            return false;
        }
    }
?>