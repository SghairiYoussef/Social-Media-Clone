<?php
    require_once "./DataBase.php";
    function addReact($post_id, $user_id) {
        $connexion = ConnexionBD::getInstance();
        $post_id = $connexion->quote($post_id);
        $user_id = $connexion->quote($user_id);
    
        $query = "SELECT * FROM reacts WHERE User_ID = $user_id AND Post_ID = $post_id";
        $result = $connexion->query($query);
    
        if ($result->rowCount() == 0) {
            $query = "INSERT INTO reacts (User_ID, Post_ID) VALUES ($user_id, $post_id)";
            $connexion->exec($query);
    
            $query = "UPDATE post SET React_Count = React_Count + 1 WHERE Post_ID = $post_id";
            $connexion->exec($query);
            return true;
        } else { 
            $query = "DELETE FROM reacts WHERE User_ID = $user_id AND Post_ID = $post_id";
            $connexion->exec($query);    
            $query = "UPDATE post SET React_Count = React_Count - 1 WHERE Post_ID = $post_id";
            $connexion->exec($query);
            return true;
        }
    }
    
?>