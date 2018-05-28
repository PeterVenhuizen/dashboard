<!doctype html>

<?php //require_once("assets/config.php"); ?>

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

                if (isset($_GET['list_id'])) {

                    $list_id = $_GET['list_id'];
                    $switch = isset($_GET['switch']) ? 'true' : 'false';
                    $mode = isset($_GET['mode']) ? $_GET['mode'] : 'flipcard';

                    if ($mode == "write") {

                        echo '  <div class="col-sm-6 mx-auto">
                                    <div class="card text-center writecard">
                                        <div class="card-header">
                                            <span id="words_left">10/22</span>
                                        </div>
                                        <div class="card-body word" done="false">

                                            <h2>Word here</h2>
                                            <input type="text" class="form-control" id="">

                                        </div>
                                        <div class="card-footer">
                                            <!--<button type="button" class="btn btn-dark float-left">
                                                Completed <span class="badge badge-light">10/22</span>
                                            </button>-->
                                            <button type="button" class="btn btn-primary float-left">Check</button>
                                            <button type="button" class="btn btn-light float-right" disabled>Next <span class="oi oi-arrow-right" title="arrow-right" aria-hidden="true"></span></button>
                                        </div>
                                    </div>
                                </div>';

                    } else if ($mode == "flipcard") {

                        echo '  <div class="col-sm-4 mx-auto">
                                    <div class="card text-center flipcard">
                                        <div class="card-header">
                                            <span id="words_left"></span>
                                        </div>
                                        <div class="card-body word" done="false">
                                            <h2 class="question">Word</h2>
                                            <h3 class="answer">Translation</h3>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger float-left">Wrong :(</button>
                                            <button type="button" class="btn btn-success float-right">Correct :)</button>
                                        </div>
                                    </div>
                                </div>';

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

        <script>
            $(document).ready(function() {
                var n_words = $('.word').length,
                    q_done = $('.word[done="true"]').length;
                $('.card-header').children('#words_left').html(q_done + '/' + n_words);
            });
        </script>

    </body>
</html>