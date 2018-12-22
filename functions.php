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

    # https://designschool.canva.com/blog/100-color-combinations/ (24)
    $colors = array('#F98866', '#FF420E', '#80DB9E', '#89DA59', '#90AFC5', '#336B87', '#2A3132', '#763626', '#505160', '#68829E', 
                    '#AEBD38', '#598234', '#003B46', '#07575B', '#66A5AD', '#C4DFE6', '#2E4600', '#486B00', '#A2C523', '#375E97', 
                    '#FB6542', '#FFBB00', '#3F681C', '#F18D9E', '#324851', '#86AC41', '#34675C', '#7DA3A1', '#4CB5F5', '#B7B8B6', 
                    '#34675C', '#B3C100', '#F4CC70', '#DE7A22', '#20948B', '#6AB187', '#C99E10', '#1E434C', '#F1F1F2', '#BCBABE', 
                    '#A1D6E2', '#1995AD', '#9A9EAB', '#5D535E', '#EC96A4', '#DFE166', '#011A27', '#063852', '#F0810F', '#E6DF44',
                    '#75B1A9', '#D9B44A', '#4F6457', '#ACD0C0', '#EB8A44', '#F9DC24', '#4B7447', '#8EBA43', '#363237', '#2D4262',
                    '#73605B', '#D09683', '#F52549', '#FA6775', '#FFD64D', '#9BC01C', '#34888C', '#7CAA2D', '#F5E356', '#CB6318');

?>