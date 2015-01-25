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
                if (isset($_SESSION['name'])) {
                    include_once 'classDatabase.php';
                    $db = new Database();
                    if (isset($_SESSION['admin']) && isset($_GET['user']) && isset($_GET['id'])) {
                        if (isset($_GET['user'])) {
                            $user = $_GET['user'];
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                            }
                            if ($user == 'student') {
                                $email = $db->get_student_data($id)['email'];
                            } else if ($user == 'nauczyciel') {
                                $email = $db->get_teacher_data($id)['email'];
                            } else if ($user == 'firma') {
                                $email = $db->get_company_data($id)['email'];
                            }
                        }
                    } else
                    if ($_SESSION['usertype'] == 'student') {
                        $user = 'student';
                        $id = $_SESSION['id'];
                        $email = $_SESSION['name'];
                    } else if ($_SESSION['usertype'] == 'nauczyciel') {
                        $user = 'nauczyciel';
                        $id = $_SESSION['id'];
                        $email = $_SESSION['name'];
                    } else if ($_SESSION['usertype'] == 'firma') {
                        $user = 'firma';
                        $id = $_SESSION['id'];
                        $email = $_SESSION['name'];
                    }

                    if ($user == 'student') {
                        if (isset($_POST['student_editdata_submit'])) {
                            include_once 'classStudent.php';

                            $student = Student::make_new_to_edit($email);
                            $student->update_data();
                        } else {
                            include_once 'classDatabase.php';
                            $db = new Database();
                            $array = $db->get_student_data($id);
                            if ($array != false) {
                                if (isset($_GET['user']) && isset($_GET['id'])) {
                                    echo "<form id='student_edit_data' action='edit_data.php?user=" . $_GET['user'] . "&id=" . $_GET['id'] . "' method='POST'>";
                                } else {
                                    echo "<form id='student_edit_data' action='edit_data.php' method='POST'>";
                                }
                                ?>

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
                                        <td><select name="status">
                                                <option value='poszukuję pracy'>poszukuję pracy</option>
                                                <option value='poszukuję stażu' <?php if ($array['status'] == "poszukuję stażu") echo "selected" ?>>poszukuję stażu</option>
                                                <option value='poszukuję praktyk' <?php if ($array['status'] == "poszukuję praktyk") echo "selected" ?>>poszukuję praktyk</option>
                                                <option value='zatrudniony' <?php if ($array['status'] == "zatrudniony") echo "selected" ?>>zatrudniony</option>
                                                <option value='poszukuję innego zatrudnienia' <?php if ($array['status'] == "poszukuję innego zatrudnienia") echo "selected" ?>>poszukuję innego zatrudnienia</option>
                                                <option value='niezatrudniony' <?php if ($array['status'] == "niezatrudniony") echo "selected" ?>>niezatrudniony</option>
                                                <option value='nie poszukuję zatrudnienia' <?php if ($array['status'] == "nie poszukuję zatrudnienia") echo "selected" ?>>nie poszukuję zatrudnienia</option>
                                            </select></td>
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
    } else if ($user == 'nauczyciel') {
        if (isset($_POST['teacher_editdata_submit'])) {
            include_once 'classTeacher.php';

            $teacher = Teacher::make_new_to_edit($email);
            $teacher->update_data();
        } else {
            include_once 'classDatabase.php';
            $db = new Database();
            $array = $db->get_teacher_data($id);
            if ($array != false) {
                if (isset($_GET['user']) && isset($_GET['id'])) {
                    echo "<form id='teacher_edit_data' action='edit_data.php?user=" . $_GET['user'] . "&id=" . $_GET['id'] . "' method='POST'>";
                } else {
                    echo "<form id='teacher_edit_data' action='edit_data.php' method='POST'>";
                }
                ?>

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
    } else if ($user == 'firma') {
        if (isset($_POST['company_editdata_submit'])) {
            include_once 'classCompany.php';

            $company = Company::make_new_to_edit($email);
            $company->update_data();
        } else {
            include_once 'classDatabase.php';
            $db = new Database();
            $array = $db->get_company_data($id);
            if ($array != false) {
                if (isset($_GET['user']) && isset($_GET['id'])) {
                    echo "<form id='company_edit_data' action='edit_data.php?user=" . $_GET['user'] . "&id=" . $_GET['id'] . "' method='POST'>";
                } else {
                    echo "<form id='company_edit_data' action='edit_data.php' method='POST'>";
                }
                ?>

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
