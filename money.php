<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .borderless td, .borderless th {
            border: none;
        }
        .table td:first-child {
            width: 75%;
            text-align: right;
        }
        .receipt {
            font-family: "monospace";
            text-transform: uppercase;
        }
        .minus { color: red; }
    </style>
  </head>
  <body>
    
    <!-- https://getbootstrap.com/docs/4.0/components/card/ -->

    <div class="row">
        <div class="col-sm-6">
            <div class="card receipt">
                <div class="card-body">
                    <h5 class="card-title text-center">Stefan</h5>
                    <table class="table table-sm borderless">
                        <tbody>
                            <tr class="plus">
                                <td>Coffee order 19/02/2018</td>
                                <td>€55</td>
                            </tr>
                            <tr>
                                <td>TOTAL</td>
                                <td>€55</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card receipt">
                <div class="card-body">
                    <h5 class="card-title text-center">Miriam</h5>
                    <table class="table table-sm borderless">
                        <tbody>
                            <tr class="plus">
                                <td>Coffee order 19/02/2018</td>
                                <td>€14</td>
                            </tr>
                            <tr>
                                <td>TOTAL</td>
                                <td>€14</td>
                            </tr>
                        </tbody>
                    </table>
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