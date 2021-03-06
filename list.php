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
        <?php include('header.php'); ?>

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
                            
                            echo '  <form action="" method="POST" id="list">
                                        <input type="hidden" id="list_id" name="list_id" value="' . $list_id . '">
                                        <div class="form-group row">
                                            <label for="list_name" class="col-sm-3 col-lg-2 col-form-label">List name</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="list_name" name="list_name" class="form-control" value="' . $list_info['list_name'] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="question_lang" class="col-sm-3 col-lg-2 col-form-label">Question language</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="question_lang" name="question_lang" class="form-control" value="' . $list_info['q_lang'] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="answer_lang" class="col-sm-3 col-lg-2 col-form-label">Answer language</label>
                                            <div class="col-sm-3">
                                                <input type="text" id="answer_lang" name="answer_lang" class="form-control" value="' . $list_info['a_lang'] . '">
                                            </div>
                                        </div>';

                            $query = "SELECT * FROM words WHERE list_id = :list_id";
                            try {
                                $stmt = $db->prepare($query);
                                $stmt->bindValue(':list_id', $list_id, PDO::PARAM_STR);
                                $stmt->execute();
                            } catch(PDOException $ex) {}
                            foreach ($stmt as $w) {
                                echo '  <div class="form-row form-inline">
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
                                        <button type="button" id="delete_list" class="btn btn-danger" list_id="' . $list_id . '"><span class="oi oi-trash" title="trash" aria-hidden="true"></span></button>
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
                            echo '  <button type="button" id="delete_list" class="btn btn-danger" list_id="' . $list_id . '"><span class="oi oi-trash" title="trash" aria-hidden="true"></span></button>';
                        }
                        
                    }
                    
                } else if (isset($_GET['action'])) { // Add new

                   echo '  <form action="" method="POST" id="list">
                                <div class="form-group row">
                                    <label for="list_name" class="col-sm-3 col-lg-2 col-form-label">List name</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="list_name" name="list_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="question_lang" class="col-sm-3 col-lg-2 col-form-label">Question language</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="question_lang" name="question_lang" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="answer_lang" class="col-sm-3 col-lg-2 col-form-label">Answer language</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="answer_lang" name="answer_lang" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row form-inline">
                                    <div class="form-group">
                                        <div class="col">
                                            <input type="hidden" name="id[]" class="id">
                                            <input type="text" name="question[]" class="form-control input_question">
                                        </div>
                                        <div class="col"><span class="oi oi-arrow-right" title="arrow-right" aria-hidden="true"></span></div>
                                        <div class="col">
                                            <input type="text" name="answer[]" class="form-control input_answer">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="add_field"><span class="oi oi-plus" title="plus" aria-hidden="true"></span></button>
                                <input type="submit" name="add_list" id="add_list" class="btn btn-success" value="SAVE">
                            </form>';

                }

                if (isset($_POST["add_list"])) {
                    
                    # Add word list
                    $list_name = mysql_real_escape_string($_POST['list_name']);
                    $q_lang = mysql_real_escape_string($_POST['question_lang']);
                    $a_lang = mysql_real_escape_string($_POST['answer_lang']);
                    $query = "INSERT INTO word_lists (list_name, q_lang, a_lang) VALUES (:list_name, :q_lang, :a_lang)";
                    $query_params = array(':list_name' => $list_name, ':q_lang' => $q_lang, ':a_lang' => $a_lang);
                    
                    try {
                        $stmt = $db->prepare($query);
                        $stmt->execute($query_params);
                    } catch(PDOException $ex) { }
                    
                    # Get newly create word list id
                    $list_id = $mysqli->query("SELECT list_id FROM word_lists WHERE list_name = '$list_name'")->fetch_object()->list_id;
                    
                    # Add words
                    $query = "INSERT INTO words (list_id, question, answer, last_tested) VALUES (:list_id, :question, :answer, :last_tested)";
                    $zipped = array_map(null, $_POST["question"], $_POST["answer"]);
                    foreach($zipped as $tuple) {
                        try {
                            $stmt = $db->prepare($query);
                            $stmt->execute(array(':list_id' => $list_id, ':question' => $tuple[0], ':answer' => $tuple[1], ':last_tested' => time()));
                        } catch(PDOException $ex) { }  
                    }
                    
                    header("Location: index.php");
                    die();

                } else if (isset($_POST['edit_list'])) {

					# Update list information
					$list_id = mysql_real_escape_string($_POST['list_id']);
					$list_name = mysql_real_escape_string($_POST['list_name']);
					$q_lang = mysql_real_escape_string($_POST['question_lang']);
					$a_lang = mysql_real_escape_string($_POST['answer_lang']);
                    $last_tested = time();
                    $query = "UPDATE word_lists SET list_name=:list_name, q_lang=:q_lang, a_lang=:a_lang WHERE list_id = :list_id";
					$query_params = array(':list_name' => $list_name, ':q_lang' => $q_lang, ':a_lang' => $a_lang, ':list_id' => $list_id);
					
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
        <script src="assets/js/responsivevoice.js"></script>
        <!--
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        -->

        <script>
            $(document).ready(function() { 
                responsiveVoice.setDefaultVoice("Russian Female");

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
                    $('.form-row:last').after(' <div class="form-row form-inline"> \
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
                
                // Delete word
                $('.delete_word').click(function(e) {
                    e.preventDefault();
                    if (confirm("Delete this question?")) {
                        var word_id = $(this).attr('word_id');
                        $.post("assets/ajax/delete_word.php", { word_id: word_id });
                        $(this).parent().remove();
                    }
                });

                // Delete list
                $('#delete_list').click(function(e) {
                    if (confirm("Delete the list?")) {
                        e.preventDefault();
                        var list_id = $(this).attr('list_id');
                        $.post("assets/ajax/delete_list.php", { list_id: list_id });
                    }
                });
                
            });
        </script>


    </body>
</html>