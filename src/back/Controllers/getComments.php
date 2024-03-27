<?php
    require_once "./DataBase.php";
    function getComments($Post_ID){
          
          $connexion = ConnexionBD::getInstance();
          $Post_ID = $connexion->quote($Post_ID);
        $query="select U.User_ID, U.Username, U.image, C.* from comment C
        inner join profile U on U.User_ID = C.User_ID
        where C.Post_ID = $Post_ID
        order by C.Date_posted desc";
        $result = $connexion->query($query);
        $comments = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = $row;
        }
        return $comments;
    }
    
?>