<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='../js/jquery-2.1.1.js'></script>
        <script type='text/javascript' src='../js/tooltips.js'></script>
        <script type='text/javascript' src='../js/ajax.js'></script>
        <script>
            function confirm_delete(id) {
                if(confirm('Potwierdź decyzję o usunięciu'))
                    delete_student(id);
                return false;
            }
            
           

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
                    ?>
                    <div class="search">
                        <h4>Wyszukaj studenta (wpisz nazwisko):</h4>
                        <form>
                            <span class='tooltips'><input type="text" onkeyup="show_hint(this.value, 'hint_student.php?q=')">
                                <span id='txtHint'></span>   
                            </span>
                        </form>
                    </div>
                    <?php
                    include_once 'classDatabase.php';
                    $db = new Database();

                    $onpage = 10;
                    $all = $db->get_student_number();
                    $start = $page->dopaging($onpage, $all, "list_student.php?");

                    $result = $db->get_student_list($start, $onpage);
                    echo "<table><tbody>";
                    while ($obj = $result->fetch_object()) {
                        echo "<tr>";
                        echo "<td><a href='profile_student.php?id=" . $obj->student_id . "'><img src='../galery_student/$obj->photoname' class='mini_photo'/></a></td>";
                        echo "<td><a href='profile_student.php?id=" . $obj->student_id . "'><h3>" . $obj->name . " " . $obj->last_name . "</h3></a></td>";
                        if (isset($_SESSION['admin'])) {

                            echo "<td id='activate$obj->student_id'><a href='edit_data.php?user=student&id=" . $obj->student_id . "' class='edit'>Edytuj</a></td>";
                            echo "<td id='delete$obj->student_id'><a class='delete' onClick='confirm_delete($obj->student_id);'>Usuń</a></td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    $page->dopaging($onpage, $all, "list_student.php?");
                } else {
                    echo "<h3>Aby zobaczyć listę studentów, musisz się <a href='login.php'>zalogować</a></h3>";
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

