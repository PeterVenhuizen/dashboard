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
        <link rel="stylesheet" href="assets/css/style.css">
        <style>
            .row { 
                margin-right: 0px; 
                margin-left: 0px;
            }
            .list-group { margin-bottom: 1em; }
            .new-item { padding: 0.25em !important; }
            .oi-trash:hover { 
                color: orangered; 
                cursor: pointer; 
            }
            .list-group-item > .oi-plus:hover { 
                color: forestgreen; 
                cursor: pointer; 
            }
            .input-group-addon { cursor: pointer; }
            .input-group-addon:hover > .oi-check {
                color: royalblue;
            }
            button { cursor: pointer; }
            
            #sticky-sidebar { background-color: red; }
            
        </style>
        <title>To-do</title>
    </head>
  <body>
        <?php include('header.php'); ?>
      
        <div class="container">
            <div class="row">
                
                <?php
                    try {
                        $list = $db->prepare("SELECT * FROM todo_lists");
                        $list->execute();
                    } catch (PDOException $ex) {}
                    if ($list->rowCount() > 0) {
                        
                        foreach ($list as $l) {
                        
                            $list_body = '';
                            $total_count = 0;
                            $done_count = 0;

                            try {
                                $items = $db->prepare("SELECT * FROM todo_items WHERE list_id = :list_id ORDER BY done");
                                $items->bindValue(':list_id', (int)$l["list_id"], PDO::PARAM_INT);
                                $items->execute();
                            } catch (PDOException $ex) {}
                            if ($items->rowCount() > 0) {
                                foreach ($items as $i) {
                                    if ($i["done"]) {
                                        $done_count++;
                                        $list_body .= '<li class="list-group-item done" item-id="' . $i["item_id"] . '"><s>' . $i["description"] . '</s></li>';
                                    } else {
                                        $list_body .= '<li class="list-group-item" item-id="' . $i["item_id"] . '">' . $i["description"] . '</li>';
                                    }
                                    $total_count++;
                                }
                            }
                            
                            echo '  <ul class="list-group col-sm-6 col-md-4 col-lg-3">
                                        <li class="list-group-item list-group-item-primary text-center list-header" list-id="' . $l['list_id'] . '">' . $l['list_name'] . ' (<span class="done-count">' . $done_count . '</span>/<span class="total-count">' . $total_count . '</span>)</li>'
                                        . $list_body . '
                                        <li class="list-group-item list-footer">
                                            <span class="oi oi-trash float-left" title="Delete" aria-hidden="true"></span>
                                            <span class="oi oi-plus float-right" title="Add item" aria-hidden="true"></span>
                                        </li>
                                    </ul>';
                            
                        }
                    }
                ?>
                
            </div>
            
            <button type="button" class="btn btn-primary"><span class="oi oi-plus"></span> Add new</button>
            <form class="form-inline">
                <label class="mr-sm-2" for="listName">List name</label>
                <input type="text" class="form-control" id="listName">
                <button type="submit" class="btn btn-primary">Create list</button>
            </form>
            
        </div>

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
            $(document).ready(function() {
                
                // Add something to list                
                $(".oi-plus").click(function() {
                    var list_id = $(this).parent().closest('.list-group').find('.list-header').attr('list-id'),
                        new_item = '<li class="list-group-item new-item">\
                                        <div class="input-group">\
                                            <input type="text" class="form-control">\
                                                <span class="input-group-addon"><span class="oi oi-check" title="Save" aria-hidden="true"></span></span>\
                                        </div>\
                                    </li>';
                    $(this).closest('.list-group').find('.list-footer').before(new_item);
                    console.log(list_id);
                });
                
                $(document).on('click', '.input-group-addon', function() {
                    var to_do = $(this).siblings('.form-control').val(),
                        list_id = $(this).closest('.list-group').find('.list-header').attr('list-id');

                    if (to_do.length > 0) {
                    
                        // Update list total numbers
                        $(this).closest('.list-group').find('.total-count').html($(this).closest('.list-group').find('.list-group-item').length-2);

                        // Add to DB
                        console.log(list_id, to_do);
                        $.post("assets/ajax/todo_insert.php", { list_id: list_id, desc: to_do });

                        // Remove input
                        $(this).closest('.list-group-item').html(to_do).removeClass('new-item');
                        
                    }
                    
                });
                
                $(".oi-trash").click(function() {
                    var list_id = $(this).closest('.list-group').find('.list-header').attr('list-id');
                    
                    // Ask for confirmation
                    
                    // Delete list and items from DB
                    
                });
                
                $(".list-group-item").click(function() {
                    
                    //console.log($(this).attr("class"));
                    
                    var list_id = $(this).closest('.list-group').find('.list-header').attr('list-id'),
                        item_id = $(this).attr('item-id');
                    
                    // Ignore group header and footer
                    if ($(this).attr("class").includes("list-footer") || $(this).attr("class").includes("list-header") || $(this).attr("class").includes("new-item")) {
                        
                        // Do nothing
                        
                    } else {
                    
                        // Get list-group-item id

                        if ($(this).text() === $(this).html()) {
                            $(this).html("<s>"+$(this).text()+"</s>");
                            $(this).toggleClass("done");
                            // Set status
                        } else {
                            $(this).html($(this).text());
                            $(this).toggleClass("done");
                            // Set status
                        }

                        // Update list-group-item status in database
                        console.log(list_id, item_id);
                        $.post("assets/ajax/todo_done.php", { item_id: item_id });

                        // Update "done" counter in the list header
                        $(this).parent().find('.done-count').html($(this).parent().find('.done').length);
                        
                    }
                    
                });
            });
        </script>

    </body>
</html>