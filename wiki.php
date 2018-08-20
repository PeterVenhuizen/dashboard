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
    <title>Wiki</title>
    <style>
        .card { border-radius: 0; }
    </style>
  </head>
  <body>
        <?php include('header.php'); ?>

        <div class="container">

            <div class="card-columns">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Empanadillas de carne y aceitunas</h3>
                        <p class="card-text"><small class="text-muted">Last updated 7 months ago</small></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" role="button" class="btn btn-sm btn-primary">Food</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Muslitos de pollo con aceitunas verdes</h3>
                        <p class="card-text"><small class="text-muted">Last updated 7 months ago</small></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" role="button" class="btn btn-sm btn-primary">Food</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Python snippets</h3>
                        <p class="card-text"><small class="text-muted">Last updated 1 year ago</small></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" role="button" class="btn btn-sm btn-primary">python</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Empanadillas de carne y aceitunas</h3>
                        <p class="card-text"><small class="text-muted">Last updated 7 months ago</small></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" role="button" class="btn btn-sm btn-primary" style="background-color:#EC96A4; border-color: #EC96A4;">Food</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Muslitos de pollo con aceitunas verdes</h3>
                        <p class="card-text"><small class="text-muted">Last updated 7 months ago</small></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" role="button" class="btn btn-sm btn-primary">Food</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Python snippets</h3>
                        <p class="card-text"><small class="text-muted">Last updated 1 year ago</small></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" role="button" class="btn btn-sm btn-primary" style="background-color: #598234; border-color: #598234;">python</a>
                    </div>
                </div>
            </div>

            <nav aria-label="Wiki pagination">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>

            <div id="summernote"></div>

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
        <link href="summernote-master/dist/summernote-bs4.css" rel="stylesheet">
        <script src="summernote-master/dist/summernote-bs4.js"></script>
        <script>
            $('#summernote').summernote({
                height: 200
            });
        </script>

    </body>
</html>