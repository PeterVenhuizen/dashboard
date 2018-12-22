<?php
	require_once('../config.php');
	try {
		$stmt = $db->prepare("SELECT * FROM tags");
		$stmt->execute();
	} catch (PDOException $ex) {}
	if ($stmt->rowCount() > 0) {
		foreach ($stmt as $row) {
			echo '<span class="db-tag" tag-name="' . $row['tag'] . '" tag-color="' . $row['color'] . '"></span>';
		}
	}
?>