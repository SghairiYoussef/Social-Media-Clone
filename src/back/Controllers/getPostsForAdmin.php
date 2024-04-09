<?php
    require_once "./DataBase.php";
    require_once "Controllers/getComments.php";
    function getPostsForAdmin(){
          
        $connexion = ConnexionBD::getInstance();
        $query="select U.userID, U.userName, U.img, P.* from post P
        inner join userdata U on U.userID = P.User_ID
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