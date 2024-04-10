<?php
    require_once "./DataBase.php";
    function addPost($user_id, $Caption, $Media ){
          $connexion = ConnexionBD::getInstance();
          $user_id = $connexion->quote($user_id);
          $Caption = $connexion->quote($Caption);
          $Media = $connexion->quote($Media);
        $query="insert into post(User_ID, Caption, Media) values ($user_id, $Caption,$Media )";
        $result = $connexion->exec($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
?>