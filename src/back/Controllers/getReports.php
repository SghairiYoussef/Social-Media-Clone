<?php
    require_once "./DataBase.php";
    function getReports(){
          
        $connexion = ConnexionBD::getInstance();
        $query="select * from report
        order by date desc";
        $result = $connexion->query($query);
        $reports = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $reports[] = $row;
        }
        return json_encode($reports,true);
    }
    
?>