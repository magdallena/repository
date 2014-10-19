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
                        if ($_SESSION['usertype'] == 'firma') {
                            $id = $_SESSION['id'];
                        } else {
                            $id = -1;
                        }
                    } else {
                        $id = $_GET['id'];
                    }
                    $allstudents = $db->get_company_number();
                    if ($id > $allstudents or $id == -1) {
                        echo "<h3>niepoprawny numer firmy</h3>";
                    } else {
                        $data = $db->get_company_data($id);
//                        echo "firma nr " . $id;
                        echo "<img src='../galery_company/".$data['photoname'] ."' class='photo'/>";
                        echo "<h2 class='datas_list_name'>".$data['name']."</h2>";
                        echo "<h3 class='datas_list'>".$data['address']."</h2>";
                        echo "<h3 class='datas_list'>tel. ".$data['telephone']."</h2>";
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
