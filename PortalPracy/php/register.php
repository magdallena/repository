<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../css/ui-tabs.css">
        <script src='../js/jquery-2.1.1.js' type='text/javascript'></script>
        <script src='../js/jquery.validate.js' type='text/javascript'></script>
        <script src='../js/student_validate.js' type='text/javascript'></script>
        <script src='../js/teacher_validate.js' type='text/javascript'></script>
        <script src='../js/company_validate.js' type='text/javascript'></script>
        <script src="../js/jquery-ui.js" type='text/javascript'></script>
        <script>
            $(function() {
                $("#tabs").tabs();
            });
        </script>
    </head>
    <body>
        <div id="header">
            <?php
            include_once 'classPage.php';
            $page = new Page;
            $page->dologinfo();
            ?>
            <h1><a href="index.php">Portal pracy dla studentów</a></h1>

        </div>
        <?php
        $page->domenu();
        ?>
        <div id="main">
            <div id="content">
                <?php
                if (isset($_SESSION['name'])) {
                    echo "<h3>Już jesteś zalogowany, nie możesz rejestrować się</h3>";
                    echo "<h3 ><a href='index.php'>Powrót do strony głównej</a></h3>";
                } else if (isset($_POST['student_reg_submit'])) {
                    include_once 'classStudent.php';
                    $student = Student::make_new_to_register();
                    $student->create_student();
                } else

                if (isset($_POST['teacher_reg_submit'])) {
                    include_once 'classTeacher.php';
                    include_once 'classDatabase.php';
                    $teacher = Teacher::make_new_to_register();
                    $teacher->create_teacher();
//                TO DO: wyslac maila do admina
                    $db = new Database();
                    $to = $db->get_admin_email();
                    echo $to;
                    $subject = "Portal pracy: założono nowe konto";
                    $message = "";
                    if (mail($to, $subject, $message)) {
                        echo "email zostal wyslany ";
                    }
                } else if (isset($_POST['company_reg_submit'])) {
                    include_once 'classCompany.php';
                    $company = Company::make_new_to_register();
                    $company->create_company();
//                TO DO: wyslac maila do admina
                } else {
                    ?>
                    <!--FORMULARZ REJESTRACJI-->

                    <div id="tabs">
                        <ul>
                            <li><a href="#student_reg_block">Student</a></li>
                            <li><a href="#teacher_reg_block">Nauczyciel</a></li>
                            <li><a href="#company_reg_block">Firma</a></li>
                        </ul>

                        <!--Rejestracja studenta-->
                        <div id='student_reg_block'>
                            <form id="student_register" action='register.php' method='POST' enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <td><label for="name">Imię:</label></td>
                                        <td><input type="text" id="name" name="name" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="last_name">Nazwisko:</label></td>
                                        <td><input type="text" id="last_name" name="last_name" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="address">Adres:</label></td>
                                        <td><textarea type="text" id="address" name="address" rows='2' cols='37'></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="telephone">Telefon:</label></td>
                                        <td><input type="text" id="telephone" name="telephone" size='9'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="email">E-mail:</label></td>
                                        <td><input type="text" id="email" name="email" size='50' ></td>
                                    </tr>
                                    <tr>
                                        <td><label for="password">Hasło:</label></td>
                                        <td><input type="password" id="password" name="password" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="password2">Powtórz hasło:</label></td>
                                        <td><input type="password" id="password2" name="password2" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="education">Edukacja:</label></td>
                                        <td><textarea id="education" name="education" rows='5' cols='37'></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="languages">Znajomość języków obcych:</label></td>
                                        <td><textarea id="languages" name="languages" rows='5' cols='37'></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="experience">Doświadczenie zawodowe:</label></td>
                                        <td><textarea id="experience" name="experience" rows='5' cols='37'></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="skills">Umiejętności:</label></td>
                                        <td><textarea id="skills" name="skills" rows='5' cols='37'></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="interest">Zainteresowania:</label></td>
                                        <td><textarea id="interest" name="interest" rows='5' cols='37'></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="employment_form">Oczekiwana forma zatrudnienia:</label></td>
                                        <td><input type="text" id="employment_form" name="employment_form" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="change_of_residence">Możliwość zmiany miejsca zamieszkania:</label></td>
                                        <td><input type="radio" name="change_of_residence" value="1"/>Tak</td>
                                        <td><input type="radio" name="change_of_residence" value="0" checked="checked"/>Nie</td>
                                    </tr>
                                    <tr>
                                        <td><label for="salary">Preferowane wynagrodzenie (zł):</label></td>
                                        <td><input type="text" id="salary" name="salary"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="status">Status zatrudnienia:</label></td>
                                        <td><input type="radio" name="status" value="employed"/>Zatrudniony</td>
                                        <td><input type="radio" name="status" value="unemployed" checked="checked"/>Niezatrudniony</td>
                                    </tr>
                                    <tr>
                                        <td><label for="photo">Zdjęcie:</label></td>
                                        <td><input type="file" name="photo" id='photo'/></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name= 'student_reg_submit' class='submit_form_button' value="Załóż konto"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!--Rejestracja nauczyciela-->
                        <div id='teacher_reg_block'>
                            <form id="teacher_register" action='register.php' method='POST'>
                                <table>
                                    <tr>
                                        <td><label for="name">Imię:</label></td>
                                        <td><input type="text" id="name" name="name" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="last_name">Nazwisko:</label></td>
                                        <td><input type="text" id="last_name" name="last_name" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="degree">Stopień naukowy:</label></td>
                                        <td><input type="text" id="degree" name="degree" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="telephone">Telefon:</label></td>
                                        <td><input type="text" id="telephone" name="telephone" size='9'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="email">E-mail:</label></td>
                                        <td><input type="text" id="email" name="email"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="passwordt">Hasło:</label></td>
                                        <td><input type="password" id="passwordt" name="passwordt" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="password2">Powtórz hasło:</label></td>
                                        <td><input type="password" id="password2" name="password2" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name= 'teacher_reg_submit' class="submit_form_button" value="Załóż konto"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!--Rejestracja firmy-->
                        <div id='company_reg_block'>
                            <form id="company_register" action='register.php' method='POST' enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <td><label for="name">Nazwa firmy:</label></td>
                                        <td><input type="text" id="name" name="name" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="address">Adres:</label></td>
                                        <td><textarea type="text" id="address" name="address" rows='2' cols='37'></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="telephone">Telefon:</label></td>
                                        <td><input type="text" id="telephone" name="telephone" size="9"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="email">E-mail:</label></td>
                                        <td><input type="text" id="email" name="email" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="passwordc">Hasło:</label></td>
                                        <td><input type="password" id="passwordc" name="passwordc" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="password2">Powtórz hasło:</label></td>
                                        <td><input type="password" id="password2" name="password2" size='50'></td>
                                    </tr>
                                    <tr>
                                        <td><label for="photo">Logo firmy:</label></td>
                                        <td><input type="file" name="photo" id='photo'/></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name= 'company_reg_submit' class="submit_form_button" value="Załóż konto"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
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
