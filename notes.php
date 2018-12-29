<!doctype html>
<?php require_once("assets/config.php"); ?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
        <link rel="stylesheet" href="bootstrap4-offline-docs-master/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="open-iconic-master/font/css/open-iconic-bootstrap.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        
        <title>Notes</title>
        <style>
            #notes-sidebar {
                /*background-color: lightblue;*/
            }
            #notes-content {
                /*background-color: lightgreen;*/
            }
            .tag-category { 
                display: inline-block; 
                margin: 0 0.25rem 0.25rem 0;   
            }
            .note-footer .tag-category {
                margin-right: 0.25rem;
            }
            .note-setting { 
                margin-left: 0.25rem;
            }
            button { cursor: pointer; }
            #btn-create-new { width: 100%; }
            .current-tag { margin: 0.25rem 0.25rem 0 0; }
            #newNote { display: none; }

            .not-okay { color: red; display: none; }
            
            :fullscreen { 
                padding: 1rem;
                overflow: auto;
            }
            :fullscreen::backdrop { 
                background-color: #fff;
            }
            
        </style>
    </head>
    <body>
        <?php include('header.php'); ?>
        
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-3" id="notes-sidebar">
                    <?php
                        try {
                            $stmt = $db->prepare("SELECT x.tag, x.color, (SELECT COUNT(*) FROM notes y WHERE y.tags LIKE CONCAT('%', x.tag, '%')) AS N FROM tags x ORDER BY tag");
                            $stmt->execute();
                        } catch (PDOException $ex) { die(); }
                        if ($stmt->rowCount() > 0) {
                            foreach ($stmt as $tag) {
                                echo '<button type="button" class="btn tag-category" tag="' . $tag['tag'] . '" style="background-color: ' . $tag['color'] . '">' . $tag['tag'] . ' <span class="badge badge-light">' . $tag['N'] . '</span></button>';
                            }
                        }
                    ?>
                    <button type="button" class="btn btn-success" id="btn-create-new">
                        <span class="oi oi-plus"></span> Create new note
                    </button>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-9" id="notes-content">
                    <div id="old-notes">
                        <?php
                        
                            // Edit
                            if (isset($_GET['edit'])) {
                                try {
                                    $stmt = $db->prepare("SELECT * FROM notes WHERE id = :id LIMIT 1");
                                    $stmt->bindValue(':id', $_GET['edit'], PDO::PARAM_INT);
                                    $stmt->execute();
                                } catch (PDOException $ex) { $ex->getMessage(); }
                                if ($stmt->rowCount() > 0) {
                                    $note = $stmt->fetch();
                                    
                                    // Get the tags
                                    $tags = explode(';', $note['tags']);
                                    $tag_buttons = '';
                                    foreach ($tags as &$tag) {
                                        $color = $mysqli->query("SELECT color FROM tags WHERE tag = '$tag' LIMIT 1")->fetch_object()->color;
                                        $tag_buttons .= '<button type="button" class="btn current-tag" tag="' . $tag . '" style="background-color: ' . $color . '">' . $tag . ' <span class="oi oi-circle-x delete-tag"></span></button>';
                                    }
                                    
                                    echo '<form id="editNote">
                                        <div class="form-group">
                                            <label for="noteTopic">Note topic</label>
                                            <input type="text" class="form-control" id="noteTopic" name="noteTopic" value="' . $note['topic'] . '">
                                            <div class="not-okay">Please enter a topic</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="newTag">Tags</label>
                                            <div class="input-group ui-widget">
                                                <input type="text" class="form-control" id="newTag">
                                                <span class="input-group-addon" id="addTag">Add</span>
                                            </div>
                                            <div class="not-okay">Please add at least one tag</div>
                                            <div id="noteTags">' . $tag_buttons . '</div>
                                        </div>
                                        <div class="form-group">
                                            <textarea id="summernote">' . htmlspecialchars_decode($note['note']) . '</textarea>
                                            <div class="not-okay">Forgetting something?!</div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2" id="edit_note" note-id="' . $note['id'] . '">Edit note</button>
                                        <button type="button" class="btn btn-danger float-right" id="delete_note" note-id="' . $note['id'] . '"><span class="oi oi-trash"></span></button>
                                        <div id="dbTags" hidden></div>
                                    </form>';
                                    
                                }
                            } else {
                            
                                // Load single
                                if (isset($_GET['id'])) {
                                    $stmt = $db->prepare("SELECT * FROM notes WHERE id = :id");
                                    $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                                }

                                // Load category
                                else if (isset($_GET['tag'])) {
                                    $stmt = $db->prepare("SELECT * FROM notes WHERE tags LIKE :tag ORDER BY added DESC");
                                    $stmt->bindValue(':tag', '%'.$_GET['tag'].'%', PDO::PARAM_STR);
                                }

                                // Load last x
                                else {
                                    $stmt = $db->prepare("SELECT * FROM notes ORDER BY added DESC LIMIT 5");
                                }

                                try {
                                    $stmt->execute();
                                } catch (PDOException $ex) { $ex->getMessage(); }
                                if ($stmt->rowCount() > 0) {
                                    foreach ($stmt as $note) {

                                        // Get the tags
                                        $tags = explode(';', $note['tags']);
                                        $tag_buttons = '';
                                        foreach ($tags as &$tag) {
                                            $color = $mysqli->query("SELECT color FROM tags WHERE tag = '$tag' LIMIT 1")->fetch_object()->color;
                                            $tag_buttons .= '<button type="button" class="btn tag-category" tag="' . $tag . '" style="background-color: ' . $color . '">' . $tag . '</button>';
                                        }

                                        echo '  <article id="article' . $note['id'] . '">
                                                    <header class="d-flex w-100 justify-content-between note-header" note-id="' . $note['id'] . '">
                                                        <h2>' . $note['topic'] . '</h2>
                                                        <small class="text-muted text-right">' . time_elapsed_string($note['added']) . '</small>
                                                    </header>
                                                    <div id="note-body">' . html_entity_decode($note['note']) . '</div>
                                                    <footer class="note-footer">
                                                        ' . $tag_buttons . '
                                                        <button type="button" class="btn btn-outline-success float-right note-setting"><span class="oi oi-pencil" note-id="' . $note['id'] . '"></span></button>
                                                        <button type="button" class="btn btn-outline-primary float-right note-setting"><span class="oi oi-fullscreen-enter" note-id="' . $note['id'] . '"></span></button>
                                                    </footer>
                                                </article>
                                                <hr>';
                                    }
                                }
                            }
                        ?>
                    </div>
                    <form id="newNote">
                        <div class="form-group">
                            <label for="noteTopic">Note topic</label>
                            <input type="text" class="form-control" id="noteTopic" name="noteTopic">
                            <div class="not-okay">Please enter a topic</div>
                        </div>
                        <div class="form-group">
                            <label for="newTag">Tags</label>
                            <div class="input-group ui-widget">
                                <input type="text" class="form-control" id="newTag">
                                <span class="input-group-addon" id="addTag">Add</span>
                            </div>
                            <div class="not-okay">Please add at least one tag</div>
                            <div id="noteTags"></div>
                            <!--<small id="tagsHelp" class="form-text text-muted">Tags must be separated by semicolons</small>-->
                        </div>
                        <div class="form-group">
                            <textarea id="summernote"></textarea>
                            <div class="not-okay">Forgetting something?!</div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" id="create_note">Make note</button>
                        <div id="dbTags" hidden></div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/jquery-ui.js"></script>
        <!--
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        -->
        <script src="bootstrap4-offline-docs-master/assets/js/vendor/popper.min.js"></script>
        <script src="bootstrap4-offline-docs-master/dist/js/bootstrap.min.js"></script>
        <link href="summernote/dist/summernote-bs4.css" rel="stylesheet">
        <script src="summernote/dist/summernote-bs4.js"></script>
        <script>
            
            // NOTE DISPLAY
            // View single
            $(document).on('click', '.note-header', function() {
                var note_id = $(this).attr('note-id');
                window.location.replace('notes.php?id='+note_id);
            });
            
            // View category
            $(document).on('click', '.tag-category', function() {
                var tag = $(this).attr('tag');
                window.location.replace('notes.php?tag='+tag);
            });
            
            // Edit
            $(document).on('click', '.oi-pencil', function() {
                var note_id = $(this).attr('note-id');
                window.location.replace('notes.php?edit='+note_id);
            });

            // https://www.sitepoint.com/use-html5-full-screen-api/
            // Enter full screen
            $(document).on('click', '.oi-fullscreen-enter', function() {
                $(this).switchClass('oi-fullscreen-enter', 'oi-fullscreen-exit');
                var note_id = $(this).attr('note-id'),
                    elem = document.getElementById('article'+note_id);
                
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) { /* Firefox */
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) { /* IE/Edge */
                    elem.msRequestFullscreen();
                }
            });
            
            // Exit full screen
            $(document).on('click', '.oi-fullscreen-exit', function() {
                $(this).switchClass('oi-fullscreen-exit', 'oi-fullscreen-enter');
                var note_id = $(this).attr('note-id'),
                    elem = document.getElementById('article'+note_id);
                
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { /* Firefox */
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { /* IE/Edge */
                    document.msExitFullscreen();
                }
            });
            
            // Switch class when Esc is pressed
            document.addEventListener("fullscreenchange", function() { 
                if (document.fullscreenElement === null) {
                    $('span.oi-fullscreen-exit').switchClass('oi-fullscreen-exit', 'oi-fullscreen-enter'); 
                }
            });
            
            // Initialize and replace image upload
            // Image upload -> https://a1websitepro.com/store-image-uploads-on-server-with-summernote-not-base-64/
            $('#summernote').summernote({
                height: 400,
                callbacks: {
                    onImageUpload: function(files, editor, welEditable) {
                        for (var i = files.length - 1; i >= 0; i--) {
                            sendFile(files[i], this);
                        }
                    }
                }
            });
            
            function sendFile(file, el) {
                var form_data = new FormData();
                form_data.append('file', file);
                $.ajax({
                    data: form_data,
                    type: "POST",
                    url: "editor-upload.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        $(el).summernote('editor.insertImage', url);
                    }
                });
            }
            
            /* NOTE CREATE/EDIT/DELETE */
            $('#btn-create-new').click(function() {
                $('#old-notes').hide();
                $('#newNote').show();
            });

            // Tag autocomplete
            $(function() {
                var existing_tags = jQuery.map(jQuery('#notes-sidebar .tag-category'), function(element) { return jQuery(element).attr('tag'); });
                $('#newTag').autocomplete({
                    source: existing_tags
                });
            });
            
            function rgb2hex(rgb){
                var regexp = /^rgb\((\d+),\s+(\d+),\s+(\d+)\)$/g,
                    groups = regexp.exec(rgb);
                return '#' + 
                    ('0' + parseInt(groups[1],10).toString(16)).slice(-2) +
                    ('0' + parseInt(groups[2],10).toString(16)).slice(-2) +
                    ('0' + parseInt(groups[3],10).toString(16)).slice(-2);
            }
            
            // Add a tag
            $(document).on('click', '#addTag', function() {

                // Get the tag
                var new_tag = $('#newTag').val(),
                    active_tags = jQuery.map(jQuery('.current-tag'), function(element) { return jQuery(element).attr('tag'); }),
                    existing_tags = jQuery.map(jQuery('#notes-sidebar .tag-category'), function(element) { return jQuery(element).attr('tag'); });

                // Check if the tag isn't empty and isn't already in the active tags
                if (new_tag.length > 0 && !active_tags.includes(new_tag)) {
                    
                    // Add the tag to the active tags
                    if (existing_tags.includes(new_tag)) {
                        var tag_color = rgb2hex($('.tag-category[tag="'+new_tag+'"]').css('backgroundColor'));
                        $('#noteTags').append('<button type="button" class="btn current-tag" tag="'+new_tag+'" style="background-color: '+tag_color+'">'+new_tag+' <span class="oi oi-circle-x delete-tag"></span></button>');
                    } else {
                        $('#noteTags').append('<button type="button" class="btn current-tag" tag="'+new_tag+'">'+new_tag+' <span class="oi oi-circle-x delete-tag"></span></button>');
                    }

                    // Empty input field
                    $('#newTag').val('');

                } else {
                    // Display some error message (maybe)
                }
                
            });

            // Delete a tag
            $(document).on('click', '.delete-tag', function() {
                $(this).parent().remove();
            });
            
            // Submit note
            $(document).on('click', '#create_note, #edit_note', function(e) {
                var topic = $('#noteTopic').val(),
                    tags = $('.current-tag').map(function() { return $(this).attr('tag'); }).get().join(';'),
                    note = $('#summernote').summernote('code');
                
                // Check if topic was given
                if (topic.length === 0) {
                    $('#noteTopic').siblings('.not-okay').show();
                    e.preventDefault();
                } else {
                    $('#noteTopic').siblings('.not-okay').hide();
                }
                
                // Check if at least one tag was given
                if (tags.length === 0) {
                    $('#noteTags').siblings('.not-okay').show();
                    e.preventDefault();
                } else {
                    $('#noteTags').siblings('.not-okay').hide();
                }
                
                // Check if summernote thingie is still empty
                if ($('#summernote').summernote('.isEmpty')) {
                    $('#summernote').parent().find('.not-okay').show();
                    e.preventDefault();
                } else {
                    $('#summernote').parent().find('.not-okay').hide();
                }
                
                if ($(this).attr('id') === "create_note") {
                    $.post("assets/ajax/notes_create.php", { topic: topic, tags: tags, note: note });
                } else {
                    $.post("assets/ajax/notes_edit.php", { topic: topic, tags: tags, note: note, id: $(this).attr('note-id') });
                }

                // Update tags
                $.post("assets/ajax/notes_tags_update.php", { tags: tags });
            });
            
            // Delete note
            $(document).on('click', '#delete_note', function() {
                var note_id = $(this).attr('note-id');
                if (confirm("Are you sure you want to delete this note?")) {
                    $.post("assets/ajax/notes_delete.php", { id: note_id });
                    $.post("assets/ajax/notes_tags_update.php");
                    window.location.replace("notes.php");
                }
            });

        </script>
    </body>
</html>