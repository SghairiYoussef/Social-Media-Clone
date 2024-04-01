<?php
    require_once "./DataBase.php";
    include "Controllers/getComments.php";
    function getPostsForFeed(){
          
          $connexion = ConnexionBD::getInstance();
        $query="select U.User_ID, U.Username, U.image, P.* from post P
        inner join profile U on U.User_ID = P.User_ID
        order by P.Date_published desc";
        $result = $connexion->query($query);
        $posts = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $row['Post_ID'];
            $comments = getComments($post_id);
            $row['Comments']= json_decode($comments, true);
            $posts[] = $row;
        }
        return json_encode($posts,true);
    }
    
?>