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
    function updateUser($name, $username, $pass, $photo ){

    }
?>