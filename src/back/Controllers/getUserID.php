<?php
    require_once "./DataBase.php";
    function getUserID($username){
          
          $connexion = ConnexionBD::getInstance();
          $username = $connexion->quote($username);
        $query="select userID from userdata
            where username = $username
        ";
        $result = $connexion->query($query)->fetch(PDO::FETCH_ASSOC);
        return json_encode($result,true);
    }
    
?>