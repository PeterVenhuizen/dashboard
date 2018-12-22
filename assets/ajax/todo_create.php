<?php

	require_once('../config.php');
	require_once('../../functions.php');
	if (isset($_POST['list_name'])) {

		$next_id = $mysqli->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'dashboard' AND TABLE_NAME = 'todo_lists'")->fetch_object()->AUTO_INCREMENT;

        $list_name = mysql_real_escape_string($_POST['list_name']);
		try {
            $stmt = $db->prepare("INSERT INTO todo_lists (list_name) VALUES (:list_name)");
            $stmt->execute(array(':list_name' => $list_name));
		} catch (PDOException $ex) { }

        date_default_timezone_set('Europe/Amsterdam');
		$now = new DateTime();
        // See if $now->date or $now->format('Y-m-d H:i:s') works on mijndomein
        echo '<li class="list-group-item list-group-item-action" list-id="' . $next_id . '" created-on="' . $now->format('Y-m-d H:i:s') . '"><span class="oi oi-list"></span> ' . $list_name . '</li>';

	}
?>