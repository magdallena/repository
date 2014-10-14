<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script src='../js/jquery-2.1.1.js' type='text/javascript'></script>
        <script src='../js/jquery.validate.js' type='text/javascript'></script>
        <script src='../js/student_validate.js' type='text/javascript'></script>
        <script src='../js/teacher_validate.js' type='text/javascript'></script>
        <script src='../js/company_validate.js' type='text/javascript'></script>
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
                if ($_SESSION['usertype'] == 'student') {
                    if (isset($_POST['student_editdata_submit'])) {
                        include_once 'classStudent.php';
                        $student = Student::make_new_to_edit($_SESSION['name']);
                        $student->update_data();
                    } else {
                        include_once 'classDatabase.php';
                        $db = new Database();
                        $array = $db->get_student_data($_SESSION['id']);
                        ?>
                        <form id="student_edit_data" action='edit_data.php' method='POST'>
                            <table>
                                <tr>
                                    <td><label for="name">Imię:</label></td>
                                    <td><input type="text" id="name" name="name" size='50' <?php echo "value='" . $array['name'] . "'" ?>></td>
                                </tr>
                                <tr>
                                    <td><label for="last_name">Nazwisko:</label></td>
                                    <td><input type="text" id="last_name" name="last_name" size='50'<?php echo "value='" . $array['last_name'] . "'" ?>></td>
                                </tr>
                                <tr>
                                    <td><label for="address">Adres:</label></td>
                                    <td><textarea type="text" id="address" name="address" rows='2' cols='37'><?php echo $array['address'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="telephone">Telefon:</label></td>
                                    <td><input type="text" id="telephone" name="telephone" size='9' <?php echo "value='" . $array['telephone'] . "'" ?>></td>
                                </tr>
                                <tr>
                                    <td><label for="education">Edukacja:</label></td>
                                    <td><textarea id="education" name="education" rows='5' cols='37'><?php echo $array['education'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="languages">Znajomość języków obcych:</label></td>
                                    <td><textarea id="languages" name="languages" rows='5' cols='37'><?php echo $array['languages'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="experience">Doświadczenie zawodowe:</label></td>
                                    <td><textarea id="experience" name="experience" rows='5' cols='37'><?php echo $array['experience'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="skills">Umiejętności:</label></td>
                                    <td><textarea id="skills" name="skills" rows='5' cols='37'><?php echo $array['skills'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="interest">Zainteresowania:</label></td>
                                    <td><textarea id="interest" name="interest" rows='5' cols='37'><?php echo $array['interest'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="employment_form">Oczekiwana forma zatrudnienia:</label></td>
                                    <td><input type="text" id="employment_form" name="employment_form" size='50' <?php echo "value='" . $array['employment_form'] . "'" ?>></td>
                                </tr>
                                <tr>
                                    <td><label for="change_of_residence">Możliwość zmiany miejsca zamieszkania:</label></td>
                                    <td><input type="radio" name="change_of_residence" value="1" <?php if ($array['change_of_residence'] == 1) echo "checked" ?> />Tak</td>
                                    <td><input type="radio" name="change_of_residence" value="0" <?php if ($array['change_of_residence'] == 0) echo "checked" ?>/>Nie</td>
                                </tr>
                                <tr>
                                    <td><label for="salary">Preferowane wynagrodzenie (zł):</label></td>
                                    <td><input type="text" id="salary" name="salary" <?php echo "value='" . $array['salary'] . "'" ?>></td>
                                </tr>
                                <tr>
                                    <td><label for="status">Status zatrudnienia:</label></td>
                                    <td><input type="radio" name="status" value="employed" <?php if ($array['status'] == "employed") echo "checked" ?> />Zatrudniony</td>
                                    <td><input type="radio" name="status" value="unemployed" <?php if ($array['status'] == "unemployed") echo "checked" ?> />Niezatrudniony</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name= 'student_editdata_submit' class='submit_form_button' value="Zapisz zmiany"></td>
                                </tr>
                            </table>
                        </form> 
                    <?php
                    }
                }

                if ($_SESSION['usertype'] == 'nauczyciel') {
                    if (isset($_POST['teacher_editdata_submit'])) {
                        include_once 'classTeacher.php';
                        $teacher = Teacher::make_new_to_edit($_SESSION['name']);
                        $teacher->update_data();
                    } else {
                        include_once 'classDatabase.php';
                        $db = new Database();
                        $array = $db->get_teacher_data($_SESSION['id']);
                        ?>
                        <form id="teacher_edit_data" action='edit_data.php' method='POST'>
                            <table>
                                <tr>
                                    <td><label for="name">Imię:</label></td>
                                    <td><input type="text" id="name" name="name" size='50' <?php echo "value='" . $array['name'] . "'" ?>/></td>
                                </tr>
                                <tr>
                                    <td><label for="last_name">Nazwisko:</label></td>
                                    <td><input type="text" id="last_name" name="last_name" size='50' <?php echo "value='" . $array['last_name'] . "'" ?>/></td>
                                </tr>
                                <tr>
                                    <td><label for="degree">Stopień naukowy:</label></td>
                                    <td><input type="text" id="degree" name="degree" size='50' <?php echo "value='" . $array['degree'] . "'" ?>/></td>
                                </tr>
                                <tr>
                                    <td><label for="telephone">Telefon:</label></td>
                                    <td><input type="text" id="telephone" name="telephone" size='9' <?php echo "value='" . $array['telephone'] . "'" ?>/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name= 'teacher_editdata_submit' class="submit_form_button" value="Zapisz zmiany"/></td>
                                </tr>
                            </table>
                        </form>
                    <?php
                    }
                }

                if ($_SESSION['usertype'] == 'firma') {
                    if (isset($_POST['company_editdata_submit'])) {
                        include_once 'classCompany.php';
                        $company = Company::make_new_to_edit($_SESSION['name']);
                        $company->update_data();
                    } else {
                        include_once 'classDatabase.php';
                        $db = new Database();
                        $array = $db->get_company_data($_SESSION['id']);
                        ?>
                        <form id="company_edit_data" action='edit_data.php' method='POST'>
                            <table>
                                <tr>
                                    <td><label for="name">Nazwa:</label></td>
                                    <td><input type="text" id="name" name="name" size='50' <?php echo "value='" . $array['name'] . "'" ?>/></td>
                                </tr>
                                <tr>
                                    <td><label for="address">Adres:</label></td>
                                    <td><textarea type="text" id="address" name="address" rows='2' cols='37'><?php echo $array['address'] ?></textarea></td>
                                </tr>
                                <tr>
                                    <td><label for="telephone">Telefon:</label></td>
                                    <td><input type="text" id="telephone" name="telephone" size='9' <?php echo "value='" . $array['telephone'] . "'" ?>/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name= 'company_editdata_submit' class="submit_form_button" value="Zapisz zmiany"/></td>
                                </tr>
                            </table>
                        </form>
                    <?php
                    }
                }
                ?>
            </div><!-- content -->
            <div id="sidebar">
                <?php
                $page->dosidebar();
                ?>
            </div><!-- sidebar -->
            <div class="clearing">&nbsp;</div>
        </div><!-- main -->

                <?php
                $page->dofooter();
                ?>
    </body>
</html>
