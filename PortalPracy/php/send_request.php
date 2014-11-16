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
                                include_once 'classDatabase.php';
                                    $db = new Database();
                                    $all = $db->get_teacher_number();
                                
                                if (!isset($_GET["teacher_id"]) || $_GET["teacher_id"] > $all) {
                                    echo "<tr><td>Wybierz nauczyciela</td>";
                                    echo "<td><select name='teacher_id'>";
                                    
                                    $result = $db->get_teacher_list(0, $all);
                                    while ($obj = $result->fetch_object()) {
                                        echo"<option value='$obj->teacher_id'>" . $obj->name . " " . $obj->last_name . "</option>";
                                    }
                                    echo "</select></td></tr>";
                                } else {
                                    $id=$_GET["teacher_id"];
                                    $teacher=$db->get_teacher_data($id);
                                    echo "<input type='hidden' name='teacher_id' value='$id'/>";
                                    echo "<h3>Referencje do: ".$teacher['degree']." ".$teacher['name']." ".$teacher['last_name']."</h3>";
                                }
                                ?>
                                <tr>
                                    <td>Napisz wiadomość:</td>
                                    <td><textarea type="text" id="message" name="message" rows='5' cols='37'></textarea></td>
                                </tr>
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
