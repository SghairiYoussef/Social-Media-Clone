<?php
    require_once "./DataBase.php";
    function isLikedByCurrentUser($user_id,$post_id){
        $connexion = ConnexionBD::getInstance();
        $Post_ID = $connexion->quote($post_id);
        $User_ID = $connexion->quote($user_id);
        $query = "SELECT * FROM reacts WHERE Post_ID = $Post_ID and User_ID=$User_ID";
        $result = $connexion->query($query);
        $rowCount = $result->rowCount();
        if($rowCount>0){
            return true;
        }else{
            return false;
        }
    }
    
?>