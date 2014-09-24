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
                    <!--FORMULARZ REJESTRACJI-->

                    <h3>Wybierz rodzaj konta jakie chcesz utworzyć</h3>
                    <button type="button">Student</button>
                    <button type="button">Nauczyciel</button>
                    <button type="button">Firma</button>

                    <div id='student_register'>
                        <form id="student_register" action='login_checking.php' method='POST'>
                            <table>
                                <tr>
                                    <td><label for="name">Imię:</label></td>
                                    <td><input type="text" id="name" name="name"></td>
                                </tr>
                                <tr>
                                    <td><label for="last_name">Nazwisko:</label></td>
                                    <td><input type="text" id="last_name" name="last_name"></td>
                                </tr>
                                <tr>
                                    <td><label for="address">Adres:</label></td>
                                    <td><input type="text" id="Address" name="Address"></td>
                                </tr>
                                <tr>
                                    <td><label for="telephone">Telefon:</label></td>
                                    <td><input type="text" id="telephone" name="telephone"></td>
                                </tr>
                                <tr>
                                    <td><label for="email">E-mail:</label></td>
                                    <td><input type="text" id="email" name="email"></td>
                                </tr>
                                <tr>
                                    <td><label for="password">Hasło:</label></td>
                                    <td><input type="text" id="password" name="password"></td>
                                </tr>
                                <tr>
                                    <td><label for="password">Powtórz hasło:</label></td>
                                    <td><input type="text" id="password" name="password"></td>
                                </tr>
                                <tr>
                                    <td><label for="education">Edukacja:</label></td>
                                    <td><input type="text" id="education" name="education"></td>
                                </tr>
                                <tr>
                                    <td><label for="languages">Znajomość języków obcych:</label></td>
                                    <td><input type="text" id="languages" name="languages"></td>
                                </tr>
                                <tr>
                                    <td><label for="experience">Doświadczenie zawodowe:</label></td>
                                    <td><input type="text" id="experience" name="experience"></td>
                                </tr>
                                <tr>
                                    <td><label for="skills">Umiejętności:</label></td>
                                    <td><input type="text" id="skills" name="skills"></td>
                                </tr>
                                <tr>
                                    <td><label for="interest">Zainteresowania:</label></td>
                                    <td><input type="text" id="interest" name="interest"></td>
                                </tr>
                                <tr>
                                    <td><label for="employment_form">Oczekiwana forma zatrudnienia:</label></td>
                                    <td><input type="text" id="employment_form" name="empoyment_form"></td>
                                </tr>
                                <tr>
                                    <td><label for="change_of_residence">Możliwość zmiany miejsca zamieszkania:</label></td>
                                    <td><input type="radio" name="change_of_residence" value="yes"/>Tak</td>
                                    <td><input type="radio" name="change_of_residence" value="no" checked="checked"/>Nie</td>
                                </tr>
                                <tr>
                                    <td><label for="salary">Preferowane wynagrodzenie:</label></td>
                                    <td><input type="text" id="salary" name="salary"></td>
                                </tr>
                                <tr>
                                    <td><label for="status">Status zatrudnienia:</label></td>
                                    <td><input type="radio" name="status" value="employed"/>Zatrudniony</td>
                                    <td><input type="radio" name="status" value="unemployed" checked="checked"/>Niezatrudniony</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name= 'student_reg_submit' value="Załóż konto"></td>
                                </tr>
                            </table>
                        </form>
                    </div>


                    <div id='teacher_register'>
                        <form id="teacher_register" action='#' method='POST'>
                            <table>
                                <tr>
                                    <td><label for="name">Imię:</label></td>
                                    <td><input type="text" id="name" name="name"></td>
                                </tr>
                                <tr>
                                    <td><label for="last_name">Nazwisko:</label></td>
                                    <td><input type="text" id="last_name" name="last_name"></td>
                                </tr>
                                <tr>
                                    <td><label for="degree">Stopień naukowy:</label></td>
                                    <td><input type="text" id="degree" name="degree"></td>
                                </tr>
                                <tr>
                                    <td><label for="telephone">Telefon:</label></td>
                                    <td><input type="text" id="telephone" name="telephone"></td>
                                </tr>
                                <tr>
                                    <td><label for="email">E-mail:</label></td>
                                    <td><input type="text" id="email" name="email"></td>
                                </tr>
                                <tr>
                                    <td><label for="password">Hasło:</label></td>
                                    <td><input type="text" id="password" name="password"></td>
                                </tr>
                                <tr>
                                    <td><label for="password">Powtórz hasło:</label></td>
                                    <td><input type="text" id="password" name="password"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name= 'teacher_reg_submit' value="Załóż konto"></td>
                                </tr>
                            </table>
                        </form>
                    </div>


                    <div id='company_register'>
                        <form id="company_register" action='login_checking.php' method='POST'>
                            <table>
                                <tr>
                                    <td><label for="name">Nazwa firmy:</label></td>
                                    <td><input type="text" id="name" name="name"></td>
                                </tr>
                                <tr>
                                    <td><label for="address">Adres:</label></td>
                                    <td><input type="text" id="Address" name="Address"></td>
                                </tr>
                                <tr>
                                    <td><label for="telephone">Telefon:</label></td>
                                    <td><input type="text" id="telephone" name="telephone"></td>
                                </tr>
                                <tr>
                                    <td><label for="email">E-mail:</label></td>
                                    <td><input type="text" id="email" name="email"></td>
                                </tr>
                                <tr>
                                    <td><label for="password">Hasło:</label></td>
                                    <td><input type="text" id="password" name="password"></td>
                                </tr>
                                <tr>
                                    <td><label for="password">Powtórz hasło:</label></td>
                                    <td><input type="text" id="password" name="password"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name= 'company_reg_submit' value="Załóż konto"></td>
                                </tr>
                            </table>
                        </form>
                    </div>


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
