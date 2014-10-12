<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header">
            <h1><a href="index.php">Portal pracy dla studentów</a></h1>
        </div>
        <?php
        include_once 'classPage.php';
        $page= new Page();
        $page->domenu();
        ?>
        <div id="main">
            <div id="content">
                <?php
                session_start();
                if (isset($_SESSION['name'])) {
                    $old = $_SESSION['name'];
                    $_SESSION = array();
                    session_destroy();
                    echo "<h3>Wylogowano użytkownika: " . $old . "</h3>";
                } else {
                    echo "<h3>Użytkownik niezalogowany - brak wylogowania</h3>";
                }
                echo "<h3><a href='login.php'>Przejdź do formularza logowania</a></h3>";
                ?>
            </div><!-- content -->
            <div id="sidebar">

            </div><!-- sidebar -->
            <div class="clearing">&nbsp;</div>
        </div><!-- main -->
        <?php
        $page->dofooter();
        ?>

    </body>
</html>