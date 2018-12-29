<?php
    require_once('../config.php');

    if (isset($_POST['id'])) {

        // Delete note
        try {
            $stmt = $db->prepare("DELETE FROM notes WHERE id = :id");
            $stmt->bindValue('id', $_POST['id'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $ex) { }
        
    }
?>