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
            <div id="content">

                <?php
                if (isset($_SESSION['name'])) {
                    include_once 'classDatabase.php';
                    $db = new Database();

                    $onpage = 2;
                    $all = $db->get_teacher_number();
                    $start = $page->dopaging($onpage, $all, "list_teacher.php?");

                    $result = $db->get_teacher_list($start, $onpage);
                    echo "<table><tbody>";
                    while ($obj = $result->fetch_object()) {
                        echo "<tr>";
                        echo "<td><a href='profile_teacher.php?id=" . $obj->teacher_id . "'><img src='../images/n_image.gif' class='mini_photo'/></a></td>";
                        echo "<td><a href='profile_teacher.php?id=" . $obj->teacher_id . "'><h3>" . $obj->name . " " . $obj->last_name . "</h3></a></td>";
//                            if (isset($_SESSION['status'])) {
//                                if ($_SESSION['status'] == 1) {
//                                    echo "<td><a href='edytuj.php?id=" . $obj->id . "' id='admin1'>Edytuj</a></td>";
//                                    echo "<td><a href='usun.php?id=" . $obj->id . "'id='admin2'>Usuń</a></td>";
//                                }
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    $page->dopaging($onpage, $all, "list_teacher.php?");
                } else {
                    echo "<h3>Aby zobaczyć listę nauczycieli, musisz się <a href='login.php'>zalogować</a></h3>";
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

