<?php
    require_once "./DataBase.php";
    function getPost($Post_ID){
          
        $connexion = ConnexionBD::getInstance();
        $Post_ID = $connexion->quote($Post_ID);
        $query = "SELECT * FROM post WHERE Post_ID = $Post_ID";
        $result = $connexion->query($query);
        if($result){
            return $result->fetch();
        }else{
            return false;
        }
    }
    
?>