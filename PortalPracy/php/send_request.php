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
            $page->dologinfo();
            ?>
            <h1><a href="index.php">Portal pracy dla studentów</a></h1>
        </div>
        <?php
        $page->domenu();
        ?>
        <div id="main">
            <div id="content"> <?php
                if (isset($_SESSION['name'])) {
                    if ($_SESSION['usertype'] == 'student') {
                        
                        if (isset($_POST['send_request'])) {
                            include_once 'classAskForReference.php';
                            $ask=  AskForReference::make_new_to_send($_SESSION['id'], $_POST['teacher_id']);
                            $ask->send();
                        
                        }
                        ?>
                        <form action="send_request.php" method="POST" id="add_offer">
                            <table>
                                <?php
                                if (!isset($_GET['teacher_id'])) {
                                    echo "<tr><td>Wybierz nauczyciela</td>";
                                    echo "<td><select name='teacher_id'>";
                                    include_once 'classDatabase.php';
                                    $db = new Database();
                                    $all = $db->get_teacher_number();
                                    $result = $db->get_teacher_list(0, $all);
                                    while ($obj = $result->fetch_object()) {
                                        echo"<option value='$obj->teacher_id'>" . $obj->name . " " . $obj->last_name . "</option>";
                                    }
                                    echo "</select></td></tr>";
                                }
                                ?>

                                <tr>
                                    <td></td>
                                    <td><input type="submit" name= 'send_request' value="Wyślij prośbę"></td>
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
