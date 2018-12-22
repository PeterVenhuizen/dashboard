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
                margin-bottom: 0.25rem;
            }
            #btn-create-new { width: 100%; }
            .current-tag { margin: 0.25rem 0.25rem 0 0; }
            #newNote { display: none; }

        </style>
    </head>
    <body>
        <?php include('header.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-3" id="notes-sidebar">
                    <button type="button" class="btn tag-category">
                        food <span class="badge badge-light">11</span>
                    </button>
                    <button type="button" class="btn tag-category">
                        math <span class="badge badge-light">5</span>
                    </button>
                    <button type="button" class="btn tag-category">
                        shell <span class="badge badge-light">7</span>
                    </button>
                    <button type="button" class="btn tag-category">
                        statistics <span class="badge badge-light">5</span>
                    </button>
                    <button type="button" class="btn tag-category">
                        python <span class="badge badge-light">3</span>
                    </button>
                    <button type="button" class="btn btn-success tag-category" id="btn-create-new">
                        <span class="oi oi-plus"></span> Create new note
                    </button>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-9" id="notes-content">
                    <!--
                    <article>
                        <header class="d-flex w-100 justify-content-between" id="note-header" note-id="1">
                            <h2>Lorem ipsum dolor sit amet</h2>
                            <small class="text-muted text-right">Created super long ago</small>
                        </header>
                        <div id="note-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur, diam vel maximus finibus, dolor dui efficitur dolor, ac mollis eros felis at magna. In eu ex laoreet, elementum purus id, vulputate mi. Duis vestibulum scelerisque urna, sit amet placerat lorem sagittis a. Fusce dignissim nisi viverra orci pretium sagittis.</p>
                            <p>Proin convallis ligula nunc, nec efficitur velit maximus non. Aenean euismod volutpat justo eget tempor. </p>
                        </div>
                        <footer id="note-footer">
                            <button type="button" class="btn">Lorem ipsum</button>
                            <span class="oi oi-trash"></span><span class="oi oi-pencil"></span>
                        </footer>
                    </article>
                    -->
                    <form id="newNote">
                        <div class="form-group">
                            <label for="noteTopic">Note topic</label>
                            <input type="text" class="form-control" id="noteTopic">
                        </div>
                        <div class="form-group">
                            <label for="newTag">Tags</label>
                            <div class="input-group ui-widget">
                                <input type="text" class="form-control" id="newTag">
                                <span class="input-group-addon" id="addTag">Add</span>
                            </div>
                            <div id="noteTags"></div>
                            <!--<small id="tagsHelp" class="form-text text-muted">Tags must be separated by semicolons</small>-->
                        </div>
                        <div id="summernote"></div>
                        <button type="submit" class="btn btn-primary mt-2">Make note</button>
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
            $('#summernote').summernote({
                height: 400
            });

            /* NEW NOTE CREATION */
            $('#btn-create-new').click(function() {

                // Get the tags already in the DB
                $.post("assets/ajax/notes_get_tags.php").done(function(tags) {
                    $('#dbTags').html(tags);

                    // Display new note form
                    $('#newNote').show();

                    $(function() {
                        var db_tags = jQuery.map(jQuery('.db-tag'), function(element) { return jQuery(element).attr('tag-name'); });
                        $('#newTag').autocomplete({
                            source: db_tags
                        });
                    });

                });

            });

            // Add a tag
            $(document).on('click', '#addTag', function() {

                // Get the tag
                var new_tag = $('#newTag').val(),
                    active_tags = jQuery.map(jQuery('.current-tag'), function(element) { return jQuery(element).attr('tag'); }),
                    db_tags = jQuery.map(jQuery('.db-tag'), function(element) { return jQuery(element).attr('tag-name'); });
                console.log(new_tag, active_tags);

                // Check if the tag isn't empty and isn't already in the active tags
                if (new_tag.length > 0 && !active_tags.includes(new_tag)) {

                    // Add the tag to the active tags
                    if (db_tags.includes(new_tag)) {
                        var tag_color = $('.db-tag[tag-name="'+new_tag+'"]').attr('tag-color');
                        $('#noteTags').append('<button type="button" class="btn current-tag" tag="'+new_tag+'" style="background-color: '+tag_color+'">'+new_tag+' <span class="oi oi-circle-x delete-tag"></span></button>');
                    } else {
                        $('#noteTags').append('<button type="button" class="btn current-tag" tag="'+new_tag+'">'+new_tag+' <span class="oi oi-circle-x delete-tag"></span></button');
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

            // Image upload -> https://a1websitepro.com/store-image-uploads-on-server-with-summernote-not-base-64/

        </script>
    </body>
</html>