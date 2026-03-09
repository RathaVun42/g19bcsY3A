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
?>