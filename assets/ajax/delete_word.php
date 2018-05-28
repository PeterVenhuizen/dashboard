<?php
	require_once('../config.php');
	if (isset($_POST['word_id'])) {
		$word_id = mysql_real_escape_string($_POST['word_id']);		
		try {
			$stmt = $db->prepare("DELETE FROM words WHERE id = :word_id");
			$stmt->execute(array(':word_id' => $word_id));
		} catch (PDOException $ex) { }
	}
?>