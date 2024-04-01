<?php
    require_once "./DataBase.php";
    function deleteUser($user_id){
          $connexion = ConnexionBD::getInstance();
          $user_id = $connexion->quote($user_id);
        $query="DELETE FROM profile WHERE User_ID = $user_id";
        $result = $connexion->exec($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
?>