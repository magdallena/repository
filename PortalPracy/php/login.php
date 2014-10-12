<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header">
            <?php
            include_once 'classPage.php';
            $page = new Page;
            ?>
            <h1><a href="index.php">Portal pracy dla studentów</a></h1>
        </div>
        <?php
        $page->domenu();
        ?>
    </div>
    <div id="main">
        <div id="content">
            <?php
            @session_start();
            if (isset($_SESSION['name'])) {
                echo "<h3>Już jesteś zalogowany <a href='logout.php'>(Wyloguj)</a></h3>";
                echo "<h3 ><a href='index.php'>Powrót do strony głównej</a></h3>";
            } else {
                ?>

                <form id="login" action='login_checking.php' method='POST'>
                    <table>
                        <tr>
                            <td><input type="radio" name="usertype" value="type_student" checked="checked"/>Student</td>
                            <td><input type="radio" name="usertype" value="type_teacher" />Nauczyciel</td>
                            <td><input type="radio" name="usertype" value="type_company" />Firma</td>
                        </tr>
                        <tr>
                            <td><label for="email">E-mail:</label></td>
                            <td><input type="text" id="email" name="email"></td>
                        </tr>


                        <tr>
                            <td><label for="password">Hasło:</label></td>

                            <td><input type="password" id="password" name="password"></td>
                        </tr>
                        <tr>
                            <td> <p><a href="#">Zapomniałeś hasła?</a></p></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name= 'log_submit' value="Zaloguj"></td>
                        </tr>
                    </table>
                </form>
                <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
            <?php } ?>
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
