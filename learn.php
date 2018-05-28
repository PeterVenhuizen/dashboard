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

                $word_lists = mysql_query("SELECT *, (SELECT COUNT(*) FROM words WHERE list_id = word_lists.list_id) AS n_words, (SELECT ROUND(sum(correct)/(sum(correct)+sum(incorrect))*100) FROM words WHERE words.list_id = word_lists.list_id) AS test_rate FROM word_lists");
                while ($l = mysql_fetch_array($word_lists)) {

                    echo '  <div class="card">
                                <div class="card-header">' . $l['list_name'] . ' (' . $l['n_words'] . ')</div>
                                <div class="card-body">
                                    <div class="list_test_rate" num="' . $l['test_rate'] . '"></div>
                                </div>
                                <div class="card-footer">
                                    <a href="list.php?list_id=' . $l['list_id'] . '"><span class="oi oi-eye" title="eye" aria-hidden="true"></span> View</a>
                                    <a href="list.php?list_id=' . $l['list_id'] . '&action=edit"><span class="oi oi-pencil" title="pencil" aria-hidden="true"></span> Edit</a>
                                    <a href=""><span class="oi oi-list" title="list" aria-hidden="true"></span> Test</a>
                                </div>
                            </div>';

                }

            ?>

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