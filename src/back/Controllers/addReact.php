<?php
    require_once "./DataBase.php";
    function addReact($post_id,$user_id){
        $connexion = ConnexionBD::getInstance();
        $post_id = $connexion->quote($post_id);
        //add to reacts table
        $query="insert into reacts(User_ID, Post_ID) values ($user_id, $post_id)";
        $result = $connexion->exec($query);
        if($result){
            //get the current react count
        $sql = "SELECT React_Count FROM post WHERE Post_ID = $post_id";
        $result = $connexion->query($sql);
        $reactCount = $result->fetch(PDO::FETCH_ASSOC);
        $reactCount = $reactCount['React_Count'];
        $reactCount++;
        //update react count
        $query="UPDATE post
        SET React_Count = $reactCount
        WHERE Post_ID = $post_id";
        $result = $connexion->exec($query);
        //add to reacts table
        $query="insert into reacts(User_ID, Post_ID) values ($user_id, $post_id)";
        $result = $connexion->exec($query);
        if($result){
            return true;
        }else{
            return false;
        }
        }else{
            return false;
        }
        
    }
    
?>