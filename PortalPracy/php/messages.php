<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='../js/jquery-2.1.1.js'></script>
        <script type='text/javascript' src='../js/send_message.js'></script>
        <script src="../js/ajax.js" type="text/javascript"></script>
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
                    $students = $db->get_student_list(0, $db->get_student_number());
                    $teachers = $db->get_teacher_list(0, $db->get_teacher_number());
                    $companies = $db->get_company_list(0, $db->get_company_number());
                    echo "<div id='send_message'>";
                    echo "<form id='send_message' action='send_message.php' method='POST'>
                    <fieldset id='new_message'>
                    <legend>Nowa wiadomość</legend>
                    <table><tbody>
                    <tr>
                    <td> DO:
                    </td>
                    ";

                    echo "<td><select name='recipient' >";
                    echo "<option selected disabled value=''>wybierz adresata</option>";
                    echo "<optgroup label='STUDENCI' name='student'>";
                    while ($obj = $students->fetch_object()) {
                        if ($_SESSION['usertype'] == 'student') {
                            if ($_SESSION['id'] == $obj->student_id) {
                                continue;
                            }
                        }
                        echo"<option value='student;$obj->student_id'>" . $obj->name . " " . $obj->last_name . "</option>";
                    }
                    echo "</optgroup>";

                    echo "<optgroup label='NAUCZYCIELE' name='teacher'>";
                    while ($obj = $teachers->fetch_object()) {
                        if ($_SESSION['usertype'] == 'nauczyciel') {
                            if ($_SESSION['id'] == $obj->teacher_id) {
                                continue;
                            }
                        }
                        echo"<option value='teacher;$obj->teacher_id'>" . $obj->name . " " . $obj->last_name . "</option>";
                    }
                    echo "</optgroup>";

                    echo "<optgroup label='FIRMY' name='company'>";
                    while ($obj = $companies->fetch_object()) {
                        if ($_SESSION['usertype'] == 'firma') {
                            if ($_SESSION['id'] == $obj->company_id) {
                                continue;
                            }
                        }
                        echo"<option value='company;$obj->company_id'>" . $obj->name . "</option>";
                    }
                    echo "</optgroup>";
                    echo "</select></td></tr>";

                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td><textarea rows='8' cols='60' name='content'></textarea>";
                    echo "</td>";
                    if ($_SESSION['usertype'] == 'student') {
                        echo "<input name='student_id' value='" . $_SESSION["id"] . "' type='hidden'/>";
                    } else if ($_SESSION['usertype'] == 'nauczyciel') {
                        echo "<input name='teacher_id' value='" . $_SESSION["id"] . "' type='hidden'/>";
                    } else {
                        echo "<input name='company_id' value='" . $_SESSION["id"] . "' type='hidden'/>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td><input type='submit' value='Wyślij'/>";
                    echo "</td>";
                    echo "</tr>";

                    echo '
                    </tbody></table>
                    <span class="error"></span>
                    </fieldset>
                    </form>';


                    echo "</div>";

                    echo "<h3 class='conspicuous'>Wiadomości odebrane</h3>";
                    echo "<div id='received'>";
                    if ($_SESSION['usertype'] == 'student') {
                        $result = $db->get_message_to_student($_SESSION['id']);
                    } else if ($_SESSION['usertype'] == 'nauczyciel') {
                        $result = $db->get_message_to_teacher($_SESSION['id']);
                    } else {
                        $result = $db->get_message_to_company($_SESSION['id']);
                    }
                    include_once 'classMessage.php';
                    while ($obj = $result->fetch_object()) {
                        $m = Message::make_new_to_display_received($obj->message_id, $obj->student_from, $obj->teacher_from, $obj->company_from, $obj->content, $obj->date, $obj->read);
                        echo $m->display_received();
                    }

                    echo "</div>";
                    echo "<h3 class='conspicuous'>Wiadomości wysłane</h3>";
                    echo "<div id='sent'>";
                    if ($_SESSION['usertype'] == 'student') {
                        $result = $db->get_message_from_student($_SESSION['id']);
                    } else if ($_SESSION['usertype'] == 'nauczyciel') {
                        $result = $db->get_message_from_teacher($_SESSION['id']);
                    } else {
                        $result = $db->get_message_from_company($_SESSION['id']);
                    }
                    while ($obj = $result->fetch_object()) {
                        $m = Message::make_new_to_display_sent($obj->student_to, $obj->teacher_to, $obj->company_to, $obj->content, $obj->date);
                        echo $m->display_sent();
                    }

                    echo "</div>";
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




