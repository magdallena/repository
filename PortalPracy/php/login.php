<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header">
            <h1><a href="../index.php">Portal pracy dla studentów</a></h1>
        </div>
        <div id="menu">
            <ul>
                <li><a href="../index.php">Strona główna</a></li>
                <li><a href="#">Student</a></li>
                <li><a href="#">Nauczyciel</a></li>
                <li><a href="#">Firma</a></li>

            </ul>
        </div>
        <div id="main">
            <div id="content">
                <?php
                if (isset($_SESSION['email'])) {
                    echo "<h3>Już jesteś zalogowany</h3>";
                    echo "<h3 ><a href='../index.php'>Powrót do strony głównej</a></h3>";
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
                <?php } ?>
            </div><!-- content -->
            <div id="sidebar">

            </div><!-- sidebar -->
            <div class="clearing">&nbsp;</div>
        </div><!-- main -->
        <div id="footer">
            <p>Copyright &copy; 2013, designed by <a href="http://www.alphastudio.pl/">Alpha Studio</a> | <a href="#">Privacy Policy</a></p>
        </div>

    </body>
</html>
