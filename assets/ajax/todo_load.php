<?php

	require_once('../config.php');
    require_once('../../functions.php');
	if (isset($_POST['list_id'])) {
		$list_id = mysql_real_escape_string($_POST['list_id']);	
        
        try {
            $stmt = $db->prepare("SELECT * FROM todo_lists WHERE list_id = :list_id");
            $stmt->execute(array(':list_id' => $list_id));
        } catch (PDOException $ex) { }
        if ($stmt->rowCount() > 0) { $list_info = $stmt->fetch(PDO::FETCH_ASSOC); }
        
        $list_body = '<ul class="list-group list-group-flush">';
        $total_count = 0;
        $done_count = 0;
        
		try {
            $stmt = $db->prepare("SELECT * FROM todo_items WHERE list_id = :list_id ORDER BY added_on DESC");
            $stmt->execute(array(':list_id' => $list_id));
		} catch (PDOException $ex) { }
        if ($stmt->rowCount() > 0) {
            
            foreach ($stmt as $row) {
                
                $total_count++;
                if ($row['done']) { $done_count++; }
                
                $list_body .= '<div class="list-group-item d-flex align-items-center list-group-item-action" item-id="' . $row['item_id'] . '">
                            <span class="oi mr-3 ' . ($row['done'] ? 'oi-circle-check' : 'not-done') . '"></span>
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0 ' . ($row['done'] ? 'done' : '') . '">' . $row['description'] . '</h6>
                                <small class="text-muted text-right">' . time_elapsed_string($row['added_on']) . '</small>
                            </div>
                        </div>';
                
            }
            
        }
        
        $list_body .= '<div class="list-group-item d-flex align-items-center add-stuff">
                <span class="oi oi-plus mr-3"></span>
                <h6 class="mb-0">Add new</h6>
            </div>
        </ul>';
            
        $list_header = '<div id="list-header" list-id="' . $list_id . '">
                    <div class="d-flex w-100 justify-content-between">
                        <h2>' . $list_info['list_name'] . '</h2>
                        <small class="text-muted text-right">Created ' . time_elapsed_string($list_info['list_creation']) . '</small>
                    </div>
                    <span id="done-count">' . $done_count . '</span>/<span id="total-count">' . $total_count . '</span> done
                </div>';
        
        echo $list_header . ' ' . $list_body;
        
	}
?>