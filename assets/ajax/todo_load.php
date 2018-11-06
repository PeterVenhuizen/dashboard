<?php
    # http://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
    function time_elapsed_string($datetime, $full = false) {
	    date_default_timezone_set('Europe/Amsterdam');
        $now = new DateTime();
        $ago = new DateTime($datetime, new DateTimeZone('CET'));
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

	require_once('../config.php');
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
            $stmt = $db->prepare("SELECT * FROM todo_items WHERE list_id = :list_id ORDER BY done");
            $stmt->execute(array(':list_id' => $list_id));
		} catch (PDOException $ex) { }
        if ($stmt->rowCount() > 0) {
            
            foreach ($stmt as $row) {
                
                $total_count++;
                if ($row['done']) { $done_count++; }
                
                $list_body .= '<div class="list-group-item d-flex align-items-center list-group-item-action" item-id="' . $row['item_id'] . '">
                            <span class="oi mr-3 ' . ($row['done'] ? 'oi-circle-check' : 'not-done') . '"></span>
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0 ' . ($row['done'] ? 'done' : '') . '">' . $row['description'] . '</h5>
                                <small class="text-muted text-right">' . time_elapsed_string($row['added_on']) . '</small>
                            </div>
                        </div>';
                
            }
            
        }
        
        $list_body .= '<div class="list-group-item d-flex align-items-center add-stuff">
                <span class="oi oi-plus mr-3"></span>
                <h5 class="mb-0">Add new</h5>
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