<?php
    require_once "./DataBase.php";
    function addComment($user_id, $post_id ,$Caption ){
          $connexion = ConnexionBD::getInstance();
          $user_id = $connexion->quote($user_id);
          $Caption = $connexion->quote($Caption);
          $post_id = $connexion->quote($post_id);
        $query="insert into comment(User_ID, Post_ID ,Content) values ($user_id, $post_id ,$Caption)";
        $result = $connexion->exec($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
?>