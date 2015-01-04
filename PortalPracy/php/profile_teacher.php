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
                    if (!isset($_GET["id"])) {
                        if ($_SESSION['usertype'] == 'nauczyciel') {
                            $id = $_SESSION['id'];
                        } else {
                            $id = -1;
                        }
                    } else {
                        $id = $_GET['id'];
                    }
                    $allteachers = $db->get_teacher_number();
                    if ($id > $allteachers or $id == -1) {
                        echo "<h3>niepoprawny numer nauczyciela</h3>";
                    } else {
                        $data = $db->get_teacher_data($id);
//                        echo "nauczyciel nr " . $id;
                        if($data == false) {
                            echo "<h3>Niepoprawny numer nauczyciela (konto może być usunięte)</h3>";
                        } else {
                            echo "<h2 class='datas_list_name'>".$data['name']." ".$data['last_name']."</h2>";
                            echo "<h3 class='datas_list'>".$data['degree']."</h3>";
                            echo "<h3 class='datas_list'>tel. ".$data['telephone']."</h3>";
                            echo "<a href='send_request.php?teacher_id=".$data['teacher_id']."'>Wyślij zapytanie o referencje</a>";
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
