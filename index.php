<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="open-iconic-master/font/css/open-iconic-bootstrap.css">
        <title>To-do</title>
        <style>
            #reminders .alert { border-radius: 0; }
        </style>
    </head>
    <body>
        <?php include('header.php'); ?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                     ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Remind me later</button>
                        <button type="button" class="btn btn-primary">Mark as done</button>
                    </div>
                </div>
            </div>
        </div>


        <pre>
            To-do:
                * General
                    -> Make new landing page
                    -> Decide what to put there
                    -> Login system
                    -> Activity tracking
                    -> Make menu change color
                * Books
                    -> Convert to Bootstrap styling
                    -> Add read start and end
                    -> Fix bol.com api
                    -> Add books reads overview
                * Notes
                    -> Convert to Bootstrap styling
                * Money
                    -> Create database tables
                    -> Add new payment list option
                    -> Add add payment
                    -> Mark as settled button
                * Lists
                    -> Split from notes
                    -> Convert to Bootstrap styling
                * Reminders
                    -> Create database
                    -> Add periodic notifications (via browser)
                    -> Remind me later
                    -> Mark as done
        </pre>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>