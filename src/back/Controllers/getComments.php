<?php
    require_once "./DataBase.php";
    function getComments($Post_ID){
          
          $connexion = ConnexionBD::getInstance();
          $Post_ID = $connexion->quote($Post_ID);
        $query="select U.userID, U.userName, U.img, C.* from comment C
        inner join userdata U on U.userID = C.User_ID
        where C.Post_ID = $Post_ID
        order by C.Date_posted desc";
        $result = $connexion->query($query);
        $comments = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = $row;
        }
        return json_encode($comments,true);
    }
    
?>