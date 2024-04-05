<?php
    require_once "./DataBase.php";
    function verifyMedia($media){
        $connexion = ConnexionBD::getInstance();
        $media = $connexion->quote($media);
        $query = "SELECT count(*) FROM post WHERE Media = $media";
        $result = $connexion->query($query);
        if($result){
            $timesUsed = $result->fetchColumn();
            return $timesUsed == 1;
        }else{
            return false;
        }
    }
    
?>