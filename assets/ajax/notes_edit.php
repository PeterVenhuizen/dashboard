<?php
    require_once('../config.php');

    if (isset($_POST['topic']) && isset($_POST['tags']) && isset($_POST['note']) && isset($_POST['id'])) {

        // Add note to db
        $note4db = ( get_magic_quotes_gpc() ? htmlspecialchars(stripslashes($_POST['note'])) : htmlspecialchars($_POST['note']) );
        $query = "UPDATE notes SET topic=:topic, tags=:tags, note=:note WHERE id = :id";
        $query_params = array(':topic' => $_POST['topic'], ':tags' => $_POST['tags'], ':note' => $note4db, ':id' => $_POST['id']);
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
        } catch (PDOException $ex) { die(); }
        
    }

?>