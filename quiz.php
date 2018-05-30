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
        <title>Quiz</title>
    </head>
    <body>
        <?php include('header.php'); ?>

        <div class="container-fluid">

            <?php

                if (isset($_GET['list_id'])) {

                    $list_id = $_GET['list_id'];
                    $switch = isset($_GET['switch']) ? 'true' : 'false';
                    $mode = (in_array($_GET['mode'], array("write", "flipcard"))) ? $_GET['mode'] : "flipcard";

                    $query = "SELECT * FROM words WHERE list_id = :list_id ORDER BY RAND()";
                    try {
                        $stmt = $db->prepare($query);
                        $stmt->bindValue(':list_id', mysql_real_escape_string($list_id), PDO::PARAM_STR);
                        $stmt->execute();
                    } catch (PDOException $ex) {}
                    if ($stmt->rowCount() > 0) {

                        echo '  <form action="" method="POST" id="">
                                    <div class="col-sm-6 col-lg-4 mx-auto">
                                        <div class="card text-center">
                                            <div class="card-header">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><span id="questions_left"></span></div>
                                                </div>
                                            </div>
                                            <div class="card-body">';

                        foreach ($stmt as $q) {
                            if ($mode == "write") {

                                    echo '          <div class="question" done="false">

                                                        <input type="hidden" name="word_id[]" value="' . $q['id'] . '">
                                                        <input type="hidden" name="correct[]" class="correct" value="' . $q['correct'] . '">
                                                        <input type="hidden" name="incorrect[]" class="incorrect" value="' . $q['incorrect'] . '">
                                                        <input type="hidden" name="last_tested[]" class="last_tested" value="">

                                                        <h2>' . $q['question'] . '</h2>
                                                        <input type="text" class="form-control answer" id="">
                                                        <span class="correct_answer" onclick="responsiveVoice.speak(\'' . $q['answer'] . '\');">' . $q['answer'] . '</span>

                                                    </div>';
                                               

                            } else if ($mode == "flipcard") {

                                    echo '          <div class="flipcard question" done="false">

                                                        <input type="hidden" name="word_id[]" value="' . $q['id'] . '">
                                                        <input type="hidden" name="correct[]" class="correct" value="' . $q['correct'] . '">
                                                        <input type="hidden" name="incorrect[]" class="incorrect" value="' . $q['incorrect'] . '">
                                                        <input type="hidden" name="last_tested[]" class="last_tested" value="">

                                                        <h2>' . $q['question'] . '</h2>
                                                        <h3 class="correct_answer" onclick="responsiveVoice.speak(\'' . $q['answer'] . '\');">' . $q['answer'] . '</h3>
                                                    </div>';


                            }
                        }

                            if ($mode == "write") {
                                echo '  </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-primary float-left" id="check_answer">Check</button>
                                                <button type="button" class="btn btn-light float-right" id="next_question" disabled>Next <span class="oi oi-arrow-right" title="arrow-right" aria-hidden="true"></span></button>';
                            } else if ($mode == "flipcard") {
                                echo '  </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-danger float-left" id="btn_wrong">Wrong :(</button>
                                                <button type="button" class="btn btn-success float-right" id="btn_correct">Correct :)</button>';
                            }
                                echo '          <div id="test_result">
                                                    <h4 id="test_percentage"></h4>
                                                    <div class="progress">
                                                        <div id="bar_correct" class="progress-bar progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                                        <div id="bar_incorrect" class="progress-bar progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-right" name="save_test_result" id="save_test_result">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>';

                    }


                    if (isset($_POST['save_test_result'])) {
                    
                        # Upload test results
                        $query = "UPDATE words SET correct=:correct, incorrect=:incorrect, last_tested=:last_tested WHERE id = :word_id";
                        $zipped = array_map(null, $_POST["word_id"], $_POST["correct"], $_POST["incorrect"], $_POST["last_tested"]);
                        foreach ($zipped as $w) {
                            try {
                                $stmt = $db->prepare($query);
                                $stmt->execute( array(':word_id' => mysql_real_escape_string($w[0]), ':correct' => mysql_real_escape_string($w[1]), ':incorrect' => mysql_real_escape_string($w[2]), ':last_tested' => mysql_real_escape_string($w[3]) ) );
                            } catch(PDOException $ex) { }
                        }
                        
                        # Return to ...
                        header("Location: learn.php");
                        die();
                    
                    }

                }

            ?>

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

        <script src="assets/js/responsivevoice.js"></script>
        <script src="assets/js/quiz.js"></script>

    </body>
</html>