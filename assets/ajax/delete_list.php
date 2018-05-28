<?php
	require_once('../config.php');
	if (isset($_POST['list_id'])) {
		$list_id = mysql_real_escape_string($_POST['list_id']);
		try {
			$stmt = $db->prepare("DELETE FROM word_lists WHERE list_id = :list_id");
			$stmt->execute(array(':list_id' => $list_id));
		} catch (PDOException $ex) { }
		
		try {
			$stmt = $db->prepare("DELETE FROM words WHERE list_id = :list_id");
			$stmt->execute(array(':list_id' => $list_id));
		} catch (PDOException $ex) { }
		
		header("Location: http://localhost/dashboard/learn.php");
		die();
	}
?>
