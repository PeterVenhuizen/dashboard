<?php
    require_once('../config.php');

    if (isset($_POST['topic']) && isset($_POST['tags']) && isset($_POST['note'])) {

        // Add note to db
        $note4db = ( get_magic_quotes_gpc() ? htmlspecialchars(stripslashes($_POST['note'])) : htmlspecialchars($_POST['note']) );
        $query = "INSERT INTO notes (topic, tags, note) VALUES (:topic, :tags, :note)";
        $query_params = array(':topic' => $_POST['topic'], ':tags' => $_POST['tags'], ':note' => $note4db);
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
        } catch (PDOException $ex) { die(); }

    }
?>