<?php
	require_once('../config.php');
	if (isset($_POST['item_id'])) {
		$item_id = mysql_real_escape_string($_POST['item_id']);	
		try {
            $stmt = $db->prepare("UPDATE todo_items SET done = NOT done WHERE item_id = :item_id");
            $stmt->execute(array(':item_id' => $item_id));
		} catch (PDOException $ex) { }
	}
?>