<?php
    require_once "./DataBase.php";
    function getAllUsers(){
          
          $connexion = ConnexionBD::getInstance();
        $query="select * from userdata where email != 'insatsocialclubadm1n@gmail.com' ";
        $result = $connexion->query($query);
        $users = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
            $users[] = $row;
        }
        return json_encode($users,true);
    }
    
?>