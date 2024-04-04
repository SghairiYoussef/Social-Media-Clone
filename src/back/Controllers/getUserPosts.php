<?php
    function getUserPosts($user_id){
          
        $connexion = ConnexionBD::getInstance();
        $user_id = $connexion->quote($user_id);
        $query="select U.userID, U.userName, U.image, P.* from post P
        inner join userdata U on U.userID = P.User_ID
        where P.User_ID = $user_id
        order by P.Date_published desc";
        $result = $connexion->query($query);
        $posts = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $row['Post_ID']; 
            $row['comments'] = getComments($post_id); 
            $posts[] = $row;
        }
        return json_encode($posts,true);
    }
    
?>