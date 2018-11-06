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
        
        <title>To-do</title>
        <style>
            .list-group-item { cursor: pointer; }
            .oi-circle-check { color: forestgreen; }
            .not-done { width: 16px; }
            .done { text-decoration: line-through; }
            #todo-overview .list-group-item {
                padding: .75rem .5rem;
            }
        </style>
    </head>
    <body>
        <?php include('header.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-3" id="todo-overview">
                    <ul class="list-group list-group-flush">
                        <?php
                            try {
                                $stmt = $db->prepare("SELECT * FROM todo_lists");
                                $stmt->execute();
                            } catch (PDOException $ex) {}
                            if ($stmt->rowCount() > 0) {
                                foreach ($stmt as $row) {
                                    echo '<li class="list-group-item list-group-item-action" list-id="' . $row['list_id'] . '" created-on="' . $row['list_creation'] . '"><span class="oi oi-list"></span> ' . $row['list_name'] . '</li>';
                                }
                            }
                        ?>
                        <li class="list-group-item add-stuff"><span class="oi oi-plus"></span> Create to-do list</li>
                    </ul>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-9" id="todo-content">
                    
                    <!--<div id="list-header" list-id="1">
                        <div class="d-flex w-100 justify-content-between">
                            <h2>General things</h2>
                            <small class="text-muted text-right">Created on 05-11-2018</small>
                        </div>
                        <span id="done-count">2</span>/<span id="total-count">4</span> done
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center list-group-item-action" item-id="a">
                            <span class="oi mr-3 not-done"></span>
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">Vestibulum efficitur</h5>
                                <small class="text-muted text-right">31-10-2018</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center" item-id="b">
                            <span class="oi mr-3 not-done"></span>
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">Pellentesque pharetra nec sem volutpat rutrum.</h5>
                                <small class="text-muted text-right">Three days ago</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center" item-id="c">
                            <span class="oi mr-3 not-done"></span>
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>
                                <small class="text-muted">Yesterday</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center" item-id="d">
                            <span class="oi mr-3 not-done"></span>
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">ac mollis eros felis at magna.</h5>
                                <small class="text-muted">Today</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center add-stuff">
                            <span class="oi oi-plus mr-3"></span>
                            <h5 class="mb-0">Add new</h5>
                        </div>
                    </ul>-->

                </div>
            </div>
        </div>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur, diam vel maximus finibus, dolor dui efficitur dolor, ac mollis eros felis at magna. In eu ex laoreet, elementum purus id, vulputate mi. Duis vestibulum scelerisque urna, sit amet placerat lorem sagittis a. Fusce dignissim nisi viverra orci pretium sagittis. Proin convallis ligula nunc, nec efficitur velit maximus non. Aenean euismod volutpat justo eget tempor. Nulla nisi ante, ultricies at rhoncus at, pharetra elementum libero. Curabitur magna leo, malesuada nec porta sed, sodales in ex. Cras efficitur enim ut convallis dictum. Donec vel ante quam. Sed a neque placerat, efficitur massa ac, sagittis eros. Vestibulum eleifend auctor sem faucibus consectetur. Quisque viverra ipsum quis sagittis maximus. Pellentesque pharetra nec sem volutpat rutrum. Donec vel justo eget ex porta molestie. Curabitur pretium nisi nisi, sit amet maximus sem lacinia sed.</p>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <!--
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        -->
        <script src="bootstrap4-offline-docs-master/assets/js/vendor/popper.min.js"></script>
        <script src="bootstrap4-offline-docs-master/dist/js/bootstrap.min.js"></script>
        <script>
            
            $(document).on('click', '#todo-overview .list-group-item', function() {
                if ($(this).hasClass('add-stuff')) {
                    // Create a new to-do list
                } else {
                    var list_id = $(this).attr('list-id');
                    $.post("assets/ajax/todo_load.php", { list_id: list_id }).done(function(data) {
                        $('#todo-content').html(data); 
                    });
                                                                                   
                }
            });
            
            // Change status and add new stuff
            $(document).on('click', '#todo-content  .list-group-item', function() {
                var list_id = $('#list-header').attr('list-id'),
                    item_id = $(this).attr('item-id');
                
                if ($(this).hasClass('add-stuff')) {
                    // Add new todo thing
                    var add_stuff = '<div class="list-group-item new-stuff">\
                                        <div class="input-group">\
                                            <span class="input-group-addon"><span class="oi oi-check title="Save" aria-hidden="true"></span></span>\
                                            <input type="text" class="form-control">\
                                        </div>\
                                    </div>';
                    $('#todo-content .add-stuff').before(add_stuff);
                } else if ($(this).hasClass('add-stuff')) {
                    // Do nothing
                } else {
                    // Toggle done/not done
                    $(this).find('h5').toggleClass('done');
                    $(this).find('span').toggleClass('not-done');
                    $(this).find('span').toggleClass('oi-circle-check');
                }
                
                $.post("assets/ajax/todo_done.php", { item_id: item_id });
                
                // Update "done" counter
                $('#done-count').html($('h5.done').length);
                
            });
            
            // Save new to-do
            
            // Delete to-do list
            
        </script>
    </body>
</html>