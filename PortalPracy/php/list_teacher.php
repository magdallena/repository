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
                include_once 'classDatabase.php';
                $db = new Database();

                $onpage = 2;
                $all = $db->get_teacher_number();
                $allpages = ceil($all / $onpage);
                if (!isset($_GET['page']) or $_GET['page'] > $allpages) {
                    $current_page = 1;
                } else {
                    $current_page = $_GET['page'];
                }
                $start = ($current_page - 1) * $onpage;
                $prev = $current_page - 1;
                $next = $current_page + 1;

                echo "<div id='pages'><ul>";
                if ($current_page > 1) {
                    echo "<li><a href='list_teacher.php?page=" . $prev . "'>Poprzednia</a></li>";
                }
                for ($i = 1; $i <= $allpages; $i++) {
                    if ($i == $current_page) {
                        echo "<li class='current'>";
                    } else {
                        echo "<li>";
                    }
                    echo "<a href='list_teacher.php?page=" . $i . "'>" . $i . "</a></li>";
                }
                if ($current_page < $allpages) {
                    echo "<li><a href='list_teacher.php?page=" . $next . "'>Następna</a></li>";
                }
                echo "</ul></div>";
                echo "<div class='clear'></div>";




                $result = $db->get_teacher_list($start, $onpage);
                echo "<table><tbody>";
                while ($obj = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<td><a href='opis.php?id=" . $obj->teacher_id . "'><img src='../images/n_image.gif' class='mini_photo'/></a></td>";
                    echo "<td><a href='opis.php?id=" . $obj->teacher_id . "'><h3>" . $obj->name . " " . $obj->last_name . "</h3></a></td>";
//                            if (isset($_SESSION['status'])) {
//                                if ($_SESSION['status'] == 1) {
//                                    echo "<td><a href='edytuj.php?id=" . $obj->id . "' id='admin1'>Edytuj</a></td>";
//                                    echo "<td><a href='usun.php?id=" . $obj->id . "'id='admin2'>Usuń</a></td>";
//                                }
                }
                echo "</tr>";
                echo "</tbody></table>";
                ?>


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

