<?php
    function addPost($user_id, $Caption, $Title,$Media ){
          $connexion = ConnexionBD::getInstance();
          $user_id = $connexion->quote($user_id);
          $Caption = $connexion->quote($Caption);
          $Title = $connexion->quote($Title);
          $Media = $connexion->quote($Media);
        $query="insert into post(User_ID, Caption, Title, Media) values ($user_id, $Caption, $Title,$Media )";
        $result = $connexion->exec($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
?>