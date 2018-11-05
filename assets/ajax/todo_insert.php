<?php
	require_once('../config.php');
	if (isset($_POST['list_id']) && isset($_POST['desc'])) {
		$list_id = mysql_real_escape_string($_POST['list_id']);	
        $desc = mysql_real_escape_string($_POST['desc']);
		try {
            $stmt = $db->prepare("INSERT INTO todo_items (list_id, description) VALUES (:list_id, :desc)");
            $stmt->execute(array(':list_id' => $list_id, ':desc' => $desc));
		} catch (PDOException $ex) { }
	}
?>