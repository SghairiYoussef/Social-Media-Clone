<?php
    include "DataBase.php";
    function getPostsForFeed($user_id){
          
          $connexion = ConnexionBD::getInstance();
          $user_id = $connexion->quote($user_id);
        $query="select U.User_ID, U.Username, U.image, P.* from post
        inner join profile U on U.User_ID = P.User_ID
        where P.User_ID <> $user_id
        order by P.Date_published desc";

        $result = $connexion->query($query);
        $posts = array();
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        return json_encode($posts,true);
    }
    
?>