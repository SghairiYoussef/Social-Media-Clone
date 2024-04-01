<?php
    require_once "./DataBase.php";
    function addReact($post_id){
        $connexion = ConnexionBD::getInstance();
        $post_id = $connexion->quote($post_id);
        //get the current react count
        $sql = "SELECT React_Count FROM post WHERE Post_ID = $post_id";
        $result = $connexion->query($sql);
        $reactCount = $result->fetch(PDO::FETCH_ASSOC);
        $reactCount = $reactCount['React_Count'];
        $reactCount++;
        $query="UPDATE post
        SET React_Count = $reactCount
        WHERE Post_ID = $post_id";
        $result = $connexion->exec($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
?>