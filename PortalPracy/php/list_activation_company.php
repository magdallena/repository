<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
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
                if (isset($_SESSION['admin'])) {

                    include_once 'classDatabase.php';
                    $db = new Database();

                    echo "<h3>Lista firm do aktywacji</h3>";
                    $onpage = 6;
                    $all = $db->get_company_inactive_number();

                    $start = $page->dopaging($onpage, $all, "list_activation_company.php?");
                    $result = $db->get_company_inactive_list($start, $onpage);
                    if ($result->num_rows == 0) {
                        echo "<h4>Brak kont do aktywowania</h4>";
                    } else {
                        echo "<div class='information_table'><table >";
                        echo "<tr><td>Aktywuj</td><td>Usuń</td><td>Zdjęcie</td><td>Nazwa</td><td>Adres</td><td>Numer telefonu</td><td>e-mail</td><td>Data rejestracji</td></tr>";
                        $result = $db->get_company_inactive_list($start, $onpage);

                        while ($obj = $result->fetch_object()) {
                            echo "<tr>";
                            echo "<td id='activate" . $obj->company_id . "'><a onclick='activate_company(" . $obj->company_id . ")'>AKTYWUJ</a></td>";
                            echo "<td id='delete" . $obj->company_id . "'><a onclick='delete_company(" . $obj->company_id . ")'>USUŃ</a></td>";
                            echo "<td><img src='../galery_company/$obj->photoname' class='mini_photo'/></td>";
                            echo "<td>" . $obj->name . "</td>";
                            echo "<td>" . $obj->address . "</td>";
                            echo "<td>" . $obj->telephone . "</td>";
                            echo "<td>" . $obj->e_mail . "</td>";
                            echo "<td>" . $obj->account_creation_date . "</td>";
                            echo "</tr>";
                        }
                        echo "</table></div>";
                        $page->dopaging($onpage, $all, "list_activation_company.php?");
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

