<?php
    require_once "DataBase.php";
    function getUser($user_id){
          
          $connexion = ConnexionBD::getInstance();
          $user_id = $connexion->quote($user_id);
        $query="select * from profile
            where User_ID = $user_id
        ";
        $result = $connexion->query($query)->fetch(PDO::FETCH_ASSOC);
        return json_encode($result,true);
    }
    
?>