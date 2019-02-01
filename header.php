<?php require_once('functions.php'); ?>

        <!--<nav class="navbar navbar-expand-sm navbar-light" style="background-color: <?php echo $colors[array_rand($colors)]; ?>;">-->
        <nav class="navbar navbar-expand-sm navbar-light" id="main-navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav text-center">
                        <a class="nav-item nav-link" href="index.php"><span class="oi oi-home" title="home" aria-hidden="true"></span> Home</a>
                        <a class="nav-item nav-link" href="books.php"><span class="oi oi-book" title="book" aria-hidden="true"></span> Books</a>
                        <a class="nav-item nav-link" href="notes.php"><span class="oi oi-layers" title="notes" aria-hidden="true"></span> Notes</a>
                        <a class="nav-item nav-link" href="todo.php"><span class="oi oi-task" title="task" aria-hidden="true"></span> To-do</a>
                        <a class="nav-item nav-link" href="money.php"><span class="oi oi-euro" title="euro" aria-hidden="true"></span> Money</a>
                        <a class="nav-item nav-link" href="#"><span class="oi oi-bell" title="bell" aria-hidden="true"></span> Reminders</a>
                        <!--<a class="nav-item nav-link" href="learn.php"><span class="oi oi-info" title="info" aria-hidden="true"></span> Learn</a>-->
                    </div>
                </div>
            </div>
        </nav>

        <div id="reminders">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="container">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>