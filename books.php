<!doctype html>
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
        <title>Boeken</title>
        <style>
            .card h6 { font-weight: bold; }
            .card-body { padding: 0.5rem; }

            .col-lg-8r {
                position: relative;
                min-height: 1px;
                padding-right: 15px;
                padding-left: 15px;
            }

            @media (min-width: 992px) {
                .col-lg-8r {
                    flex: 0 0 12.5%;
                    max-width: 12.5%;
                }
            }

            @media (min-width: 1200px) {
                .col-xl-1 {
                    -webkit-box-flex: 0;
                    flex: 0 0 8.333333%;
                    max-width: 8.333333%;
                }
            }


        </style>
    </head>
    <body>
        <?php include('header.php'); ?>

        <div class="container-fluid">

            <div class="row">

                <div class="col-xl-1 col-lg-8r col-md-2 col-sm-4 col-6">
                    <div class="card">
                        <img class="card-img-top" src="the_complete_robot.jpg" alt="">
                        <div class="card-body">
                            <h6>The Complete Robot</h6>
                            <a href="#" class="card-link">Isaac Asimov</a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-1 col-lg-8r col-md-2 col-sm-4 col-6">
                    <div class="card">
                        <img class="card-img-top" src="foundation.jpg" alt="">
                        <div class="card-body">
                            <h6>Foundation</h6>
                            <a href="#" class="card-link">Isaac Asimov</a>
                            <br>
                            <a href="#" class="card-link">Original Foundation (#1)</a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-1 col-lg-8r col-md-2 col-sm-4 col-6">
                    <div class="card">
                        <img class="card-img-top" src="foundation_and_empire.jpg" alt="">
                        <div class="card-body">
                            <h6>Foundation and Empire</h6>
                            <a href="#" class="card-link">Isaac Asimov</a>
                            <br>
                            <a href="#" class="card-link">Original Foundation (#2)</a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-1 col-lg-8r col-md-2 col-sm-4 col-6">
                    <div class="card">
                        <img class="card-img-top" src="second_foundation.jpg" alt="">
                        <div class="card-body">
                            <h6>Second Foundation</h6>
                            <a href="#" class="card-link">Isaac Asimov</a>
                            <br>
                            <a href="#" class="card-link">Original Foundation (#3)</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>