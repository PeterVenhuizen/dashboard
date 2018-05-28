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
    <title>Learn</title>
    <style>

    </style>
  </head>
  <body>
        <!-- https://useiconic.com/open/ -->
        <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #e3f2fd;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.html"><span class="oi oi-home" title="home" aria-hidden="true"></span> Home</a>
                    <a class="nav-item nav-link" href="books.php"><span class="oi oi-book" title="book" aria-hidden="true"></span> Books</a>
                    <a class="nav-item nav-link" href="#"><span class="oi oi-layers" title="layers" aria-hidden="true"></span> Notes</a>
                    <a class="nav-item nav-link" href="#"><span class="oi oi-list" title="list" aria-hidden="true"></span> Lists</a>
                    <a class="nav-item nav-link" href="money.php"><span class="oi oi-euro" title="euro" aria-hidden="true"></span> Money</a>
                    <a class="nav-item nav-link" href="#"><span class="oi oi-bell" title="bell" aria-hidden="true"></span> Reminders</a>
                    <a class="nav-item nav-link" href="learn.php"><span class="oi oi-info" title="info" aria-hidden="true"></span> Learn</a>
                </div>
            </div>
        </nav>

        <div id="reminders">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>

        <div class="container-fluid">

            <?php

				function calc_time_diff($now, $mysql_last_tested) {
					
					#$diff = (strtotime(date("Y-m-d H:i:s", time()))-strtotime($mysql_last_tested))
					$diff = ($now - $mysql_last_tested);
					
					if ($diff < 60) {
						$last = $diff . " seconds ago";
					} else if ($diff < 3600) {
						$last = floor($diff / 60) . " minutes ago";
					} else if ($diff < 86400) {
						$last = floor($diff / 3600) . " hours ago";
					} else if ($diff < 604800) {
						$last = floor($diff / 86400) . " days ago";
					} else if ($diff >= 604800) { 
						$last = floor($diff / 604800) . " weeks ago";
					}
					
					return $last;
				}
            
                if (isset($_GET['list_id'])) {
                    
                    $list_id = mysql_real_escape_string($_GET['list_id']);
                    $query = "SELECT * FROM word_lists WHERE list_id = :list_id LIMIT 1";
                    try { 
                        $stmt = $db->prepare($query);
                        $stmt->bindValue(':list_id', $list_id, PDO::PARAM_STR);
                        $stmt->execute();
                    } catch (PDOException $ex) {}
                    $list_info = $stmt->fetch();
                    
                    echo '  <h1>'. $list_info['list_name'] . '</h1>';
                    
                    if (isset($_GET['action'])) { // Edit or delete
                        
                        $action = mysql_real_escape_string($_GET['action']);
                        if ($action == "edit") {
                            
                            echo '  <form action="" method="POST" id="list" class="form-inline">
                                        <input type="hidden" id="list_id" name="list_id" value="' . $list_id . '">';

                            $query = "SELECT * FROM words WHERE list_id = :list_id";
                            try {
                                $stmt = $db->prepare($query);
                                $stmt->bindValue(':list_id', $list_id, PDO::PARAM_STR);
                                $stmt->execute();
                            } catch(PDOException $ex) {}
                            foreach ($stmt as $w) {
                                echo '  <div class="form-row">
                                            <div class="form-group">
                                                <div class="col">
                                                    <input type="hidden" name="id[]" class="id" value="' . $w['id'] . '">
                                                    <input type="text" name="question[]" class="form-control input_question" value="' . $w['question'] . '">
                                                </div>
                                                <div class="col"><span class="oi oi-arrow-right" title="arrow-right" aria-hidden="true"></span></div>
                                                <div class="col">
                                                    <input type="text" name="answer[]" class="form-control input_answer" value="' . $w['answer'] . '">
                                                </div>
                                                <div class="col delete_word" word_id="' . $w['id'] . '"><span class="oi oi-trash" title="trash" aria-hidden="true"></span></div>
                                            </div>
                                        </div>';
                            }
                            
                            echo '  
                                        <button type="button" class="btn btn-primary" id="add_field"><span class="oi oi-plus" title="plus" aria-hidden="true"></span></button>
                                        <a href="list.php?list_id=' . $list_id . '&action=delete" class="btn btn-danger" role="button"><span class="oi oi-trash" title="trash" aria-hidden="true"></span></a>
                                        <input type="submit" name="edit_list" id="edit_list" class="btn btn-success" value="SAVE">
                                    </form>';
                            
                        } else if ($action == "delete") {
                            
                        }
                        
                    } else { // View
                        
                        try {
                            $stmt = $db->prepare("SELECT id, answer, question, ROUND((correct/(correct+incorrect))*100) AS test_rate, last_tested FROM words WHERE list_id = :list_id");
                            $stmt->bindValue(':list_id', $list_id, PDO::PARAM_STR);
                            $stmt->execute();
                        } catch(PDOException $ex) { $ex->getMessage(); }
                        
                        if ($stmt->rowCount() > 0) {
                            echo '  <table class="table table-striped">
                                        <tbody>';
                            foreach ($stmt as $w) {
                                echo '  <tr>
                                            <td scope="row">' . $w['question'] . '</td>
                                            <td onclick="responsiveVoice.speak(\'' . $w['answer'] . '\');">' . $w['answer'] . '</td>
                                            <td><div class="word_test_rate" num="' . $w['test_rate'] . '"></div></td>
                                            <td class="word_last_tested">' . calc_time_diff(time(), $w['last_tested']) . '</td>
                                        </tr>';
                            }
                            echo '      </tbody>
                                    </table>';
                            
                            echo '  <a href="list.php?list_id=' . $list_id . '&action=edit" class="btn btn-primary" role="button"><span class="oi oi-pencil" title="pencil" aria-hidden="true"></span></a>';
                            echo '  <a href="list.php?list_id=' . $list_id . '&action=delete" class="btn btn-danger" role="button"><span class="oi oi-trash" title="trash" aria-hidden="true"></span></a>';
                        }
                        
                    }
                    
                } else if (isset($_GET['action'])) { // Add new
                    
                }
            
                if (isset($_POST['edit_list'])) {

					# Update list information
					$list_id = mysql_real_escape_string($_POST['list_id']);
					$list_name = mysql_real_escape_string($_POST['list_name']);
					//$q_lang = mysql_real_escape_string($_POST['question_lang']);
					//$a_lang = mysql_real_escape_string($_POST['answer_lang']);
                    $last_tested = time();
					$query = "UPDATE word_lists SET list_name=:list_name, last_tested=:last_tested WHERE list_id = :list_id";
                    $query_params = array(':list_name' => $list_name, ':list_id' => $list_id);
                    //$query = "UPDATE word_lists SET list_name=:list_name, q_lang=:q_lang, a_lang=:a_lang, last_tested=:last_tested WHERE list_id = :list_id";
					//$query_params = array(':list_name' => $list_name, ':q_lang' => $q_lang, ':a_lang' => $a_lang, ':list_id' => $list_id);
					
					try {
						$stmt = $db->prepare($query);
						$stmt->execute($query_params);
					} catch(PDOException $ex) { }
					
					# Update and insert new words
					$update_query = "UPDATE words SET question=:q, answer=:a WHERE id = :word_id";
					$insert_query = "INSERT INTO words (list_id, question, answer, last_tested) VALUES (:list_id, :q, :a, :last_tested)";
					$zipped = array_map(null, $_POST["id"], $_POST["question"], $_POST["answer"]);
					foreach ($zipped as $tuple) {
						if (empty($tuple[0])) {
							try {
								$stmt = $db->prepare($insert_query);
								$stmt->execute(array(':list_id' => $list_id, ':q' => $tuple[1], ':a' => $tuple[2], ':last_tested' => $last_tested));
							} catch(PDOException $ex) { }
						} else {
							try {
								$stmt = $db->prepare($update_query);
								$stmt->execute(array(':q' => $tuple[1], ':a' => $tuple[2], ':word_id' => $tuple[0]));
							} catch(PDOException $ex) { }
						}
					}
                    
                    header("Location: learn.php");
                    die();
                    
                }

            ?>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap4-offline-docs-master/assets/js/vendor/popper.min.js"></script>
        <script src="bootstrap4-offline-docs-master/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/CSSpie.js"></script>
        <!--
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        -->

        <script>
            $(document).ready(function() { 
                //responsiveVoice.setDefaultVoice("Russian Female");

                $('.word_test_rate').each(function() {
                    var perc = $(this).attr('num'),
                        donut_color = "#4AC948";
                    if (perc <= 33) { donut_color = "#DB2929"; }
                    else if (perc > 33 && perc <= 67) { donut_color = "#FFA500"; }
                    $(this).append(createPie("", "30px", "none", 1, [perc], [donut_color], ''));
                });
                
                jQuery.fn.extend({
                    is_empty: function() {
                        var text = $(this).val();
                        if (text.length == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                })
                
                // Add fields
                function add_word_field() {
                    $('.form-row:last').after(' <div class="form-row"> \
                            <div class="form-group"> \
                                <div class="col"> \
                                    <input type="hidden" name="id[]" class="id"> \
                                    <input type="text" name="question[]" class="form-control input_question"> \
                                </div> \
                                <div class="col"><span class="oi oi-arrow-right" title="arrow-right" aria-hidden="true"></span></div> \
                                <div class="col"><input type="text" name="answer[]" class="form-control input_answer"></div> \
                                <div class="col"><span class="oi oi-trash" title="trash" aria-hidden="true"></span></div> \
                            </div> \
                        </div>');
                    /*$(' <div class="form-row"> \
                            <div class="form-group"> \
                                <div class="col"> \
                                    <input type="hidden" name="id[]" class="id"> \
                                    <input type="text" name="question[]" class="form-control input_question"> \
                                </div> \
                                <div class="col"><span class="oi oi-arrow-right" title="arrow-right" aria-hidden="true"></span></div> \
                                <div class="col"><input type="text" name="answer[]" class="form-control input_answer"></div> \
                                <div class="col"><span class="oi oi-trash" title="trash" aria-hidden="true"></span></div> \
                            </div> \
                        </div>').insertAfter($('.form-row:last'));*/
                }
                
                $(document).on("keypress", function(e) {
                    if (e.ctrlKey && e.shiftKey && (e.which == 61)) {
                        add_word_field();
                    }
                });
                
                $('#add_field').click(function(e) {
                    e.preventDefault();
                    add_word_field();
                });
                
                // Check if forms are ready to be submitted
                $('#add_list, #edit_list').click(function(e) {
                    var prevent = false;

                    // Collect list information
                    $('.form-group').find('input[type="text"]').each(function() {
                        if ($(this).is_empty()) { $(this).addClass('is_empty'); prevent = true; }
                        else { $(this).removeClass('is_empty'); }
                    });

                    // Collect questions and answers
                    $('.form-group').each(function() {
                        
                        // Remove empty question-answer pairs
                        if ($(this).find('.input_question').is_empty() && $(this).find('.input_answer').is_empty()) { $(this).remove(); }

                        // Check if answer was given
                        if ($(this).find('.input_answer').is_empty()) { 
                            $(this).find('.input_answer').addClass('is_empty'); 
                            prevent = true;
                        } else { $(this).find('.input_answer').removeClass('is_empty'); }
                    });
                    
                    if (prevent) { e.preventDefault(); }

                });
                
                // Delete word --- CHECK THIS
                $('.delete_word').click(function(e) {
                    e.preventDefault();
                    if (confirm("Delete this question?")) {
                        var word_id = $(this).attr('word_id');
                        $.post("assets/ajax/delete_word.php", { word_id: word_id });
                        $(this).parent().remove();
                    }
                });
                
            });
        </script>


    </body>
</html>