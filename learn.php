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
        .iwt { display: inline-block; }
    </style>
  </head>
  <body>
        <?php include('header.php'); ?>

        <div class="container-fluid">

            <div class="row">

            <?php

                $word_lists = mysql_query("SELECT *, (SELECT COUNT(*) FROM words WHERE list_id = word_lists.list_id) AS n_words, (SELECT ROUND(sum(correct)/(sum(correct)+sum(incorrect))*100) FROM words WHERE words.list_id = word_lists.list_id) AS test_rate FROM word_lists");
                while ($l = mysql_fetch_array($word_lists)) {

                    echo '  <div class="col-sm-4 col-md-3 col-lg-2 mt-4">
                                <div class="card text-center">
                                    <div class="card-header">' . $l['list_name'] . ' (' . $l['n_words'] . ')</div>
                                    <div class="card-body">
                                        <div class="list_test_rate" num="' . $l['test_rate'] . '"></div>
                                    </div>
                                    <div class="card-footer">
                                        <span class="iwt mr-2"><a href="list.php?list_id=' . $l['list_id'] . '"><span class="oi oi-eye" title="eye" aria-hidden="true"></span> View</a></span>
                                        <span class="iwt mr-2"><a href="list.php?list_id=' . $l['list_id'] . '&action=edit"><span class="oi oi-pencil" title="pencil" aria-hidden="true"></span> Edit</a></span>
                                        <span class="iwt mr-2"><a href="quiz.php?list_id=' . $l['list_id'] . '"><span class="oi oi-list" title="list" aria-hidden="true"></span> Test</a></span>
                                    </div>
                                </div>
                            </div>';

                }

            ?>

                <div class="col-sm-4 col-md-3 col-lg-2 mt-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h1><a href="list.php?action=new"><span class="oi oi-plus" title="plus" aria-hidden="true"></span><br>Create a new list</a></h1>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/CSSpie.js"></script>
        <!--
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        -->
        <script src="bootstrap4-offline-docs-master/assets/js/vendor/popper.min.js"></script>
        <script src="bootstrap4-offline-docs-master/dist/js/bootstrap.min.js"></script>

        <script>
            $('.list_test_rate').each(function() {
                var perc = $(this).attr('num'),
                    donut_color = "#4AC948";
                if (perc <= 33) { donut_color = "#DB2929"; }
                else if (perc > 33 && perc <= 67) { donut_color = "#FFA500"; }
                $(this).append(createPie("", "100px", "white", 1, [perc], [donut_color], perc));
            });
        </script>


    </body>
</html>