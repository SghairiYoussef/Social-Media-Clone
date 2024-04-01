<?php
    require_once "./DataBase.php";
    function deleteReport($report_id){
          $connexion = ConnexionBD::getInstance();
          $report_id = $connexion->quote($report_id);
        $query="DELETE FROM report WHERE report_id = $report_id";
        $result = $connexion->exec($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
?>