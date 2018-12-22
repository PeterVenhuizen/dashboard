<?php

	require_once('../config.php');
	require_once('../../functions.php');
	if (isset($_POST['list_id']) && isset($_POST['desc'])) {

		$next_id = $mysqli->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'dashboard' AND TABLE_NAME = 'todo_items'")->fetch_object()->AUTO_INCREMENT;

		$list_id = mysql_real_escape_string($_POST['list_id']);	
        $desc = mysql_real_escape_string($_POST['desc']);
		try {
            $stmt = $db->prepare("INSERT INTO todo_items (item_id, list_id, description) VALUES (:next_id, :list_id, :desc)");
            $stmt->execute(array(':next_id' => $next_id, ':list_id' => $list_id, ':desc' => $desc));
		} catch (PDOException $ex) { }

        date_default_timezone_set('Europe/Amsterdam');
		$now = new DateTime();
        // See if $now->date or $now->format('Y-m-d H:i:s') works on mijndomein
        echo '<div class="list-group-item d-flex align-items-center list-group-item-action" item-id="' . $next_id . '">
        		<span class="oi mr-3 not-done"></span>
        		<div class="d-flex w-100 justify-content-between">
        			<h6 class="mb-0">' . $desc . '</h6>
        			<small class="text-muted text-right">' . time_elapsed_string($now->format('Y-m-d H:i:s')) . '</h6>
        		</div>
        	</div>';

	}
?>