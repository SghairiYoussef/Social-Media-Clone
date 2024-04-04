<?php
    require_once "./DataBase.php";
    function getAllUsers(){
          
          $connexion = ConnexionBD::getInstance();
        $query="select * from userdata";
        $result = $connexion->query($query);
        $users = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
            $users[] = $row;
        }
        return json_encode($users,true);
    }
    
?>