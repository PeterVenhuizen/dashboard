<?php
    require_once('../config.php');
	//require_once('../../functions.php');

    if (isset($_POST['tags']) && isset($_POST['colors'])) {
        
        // Add tags to db
        $tags = explode(';', $_POST['tags']);
        $colors = $_POST['colors'];
        
        for ($i = 0; $i < sizeof($tags); $i++) {
            $query = "INSERT IGNORE INTO tags (tag, color) VALUES (:tag, :color)";
            $query_params = array(':tag' => $tags[$i], ':color' => $colors[$i]);
            try {
                $stmt = $db->prepare($query);
                $stmt->execute($query_params);
            } catch (PDOException $ex) { die(); }
        }
    }
        
    # Check for lonely tags
    # Get all tags from the tags table
    $tag_count = array();
    try { 
        $stmt = $db->prepare("SELECT tag FROM tags");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt as $row) { $tag_count[$row['tag']] = 0; }
        }
    } catch (PDOException $ex) { die(); }

    # Count tags
    try {
        $stmt = $db->prepare("SELECT tags FROM notes");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt as $row) {
                $tags = explode(';', $row['tags']);
                foreach ($tags as &$tag) {
                    if (isset($tag_count[$tag])) {
                        $tag_count[$tag]++; 
                    }
                }
            }
        }
    } catch (PDOException $ex) { die(); }

    # Check for tags with zero counts
    foreach ($tag_count as $k => $v) {
        if ($v == 0) {
            try {
                $stmt = $db->prepare("DELETE FROM tags WHERE tag = :tag");
                $stmt->bindValue('tag', $k);
                $stmt->execute();
            } catch (PDOException $ex) { die(); }
        }
    }

?>