<?php
	require_once('../config.php');
	if (isset($_POST['list_id'])) {
		$list_id = mysql_real_escape_string($_POST['list_id']);	
        
        // Delete items
		try {
            $stmt = $db->prepare("DELETE FROM todo_items WHERE list_id = :list_id");
            $stmt->execute(array(':list_id' => $list_id));
		} catch (PDOException $ex) { }
        
        // Delete to-do list
		try {
            $stmt = $db->prepare("DELETE FROM todo_lists WHERE list_id = :list_id");
            $stmt->execute(array(':list_id' => $list_id));
		} catch (PDOException $ex) { }
	}
?>