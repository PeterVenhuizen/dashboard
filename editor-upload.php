<?php
    if (empty($_FILES['file'])) {
        exit();
    }
    
    $img_uploads = './img-uploads/';

    $tmp_file = explode('.', $_FILES['file']['name']);
    $new_file = $img_uploads . $_FILES['file']['name'];
    while (file_exists($new_file)) {
        $new_file = $img_uploads . round(microtime(true)) . '.' . end($tmp_file);
    }
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $new_file)) {
        echo "Error uploading the image!";
    } else {
        echo $new_file;
    }
    
?>