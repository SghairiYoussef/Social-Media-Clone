<?php
    require_once "./DataBase.php";
    function deletePost($post_id){
          $connexion = ConnexionBD::getInstance();
          $post_id = $connexion->quote($post_id);
        $query="DELETE FROM post WHERE Post_ID = $post_id";
        $result = $connexion->exec($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
?>