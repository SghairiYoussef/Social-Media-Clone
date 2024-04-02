<?php
    require_once "./DataBase.php";
    function getUser($user_id){
          
          $connexion = ConnexionBD::getInstance();
          $user_id = $connexion->quote($user_id);
        $query="select * from userdata
            where userID = $user_id
        ";
        $result = $connexion->query($query)->fetch(PDO::FETCH_ASSOC);
        return json_encode($result,true);
    }
    
?>