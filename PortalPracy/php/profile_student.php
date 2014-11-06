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
                        if ($_SESSION['usertype'] == 'student') {
                            $id = $_SESSION['id'];
                        } else {
                            $id = -1;
                        }
                    } else {
                        $id = $_GET['id'];
                    }
                    $allstudents = $db->get_student_number();
                    if ($id > $allstudents or $id == -1) {
                        echo "<h3>niepoprawny numer studenta</h3>";
                    } else {
                        $data = $db->get_student_data($id);
                        echo "<img src='../galery_student/".$data['photoname'] ."' class='photo'/>";
                        echo "<h2 class='datas_list_name'>".$data['name']." ".$data['last_name']."</h2>";
                        echo "<h3 class='datas_list'>".$data['address']."</h2>";                                              
                        echo "<h3 class='datas_list'>tel. ".$data['telephone']."</h2>";
                        
                        echo "<h3><a href=references.php>Opinie nauczycieli o studencie</a></h3>";
                        
                        echo "<h3 class='datas_list2'>wykształcenie</h2>";
                        echo "<h3 class='datas_list'>".$data['education']."</h2>";
                        echo "<h3 class='datas_list2'>języki</h2>";
                        echo "<h3 class='datas_list'>".$data['languages']."</h2>";
                        echo "<h3 class='datas_list2'>doświadczenie</h2>";
                        echo "<h3 class='datas_list'>".$data['experience']."</h2>";
                        echo "<h3 class='datas_list2'>umiejętności</h2>";
                        echo "<h3 class='datas_list'>".$data['skills']."</h2>";
                        echo "<h3 class='datas_list2'>zainteresowania</h2>";
                        echo "<h3 class='datas_list'>".$data['interest']."</h2>";
                        echo "<h3 class='datas_list2'>preferowana forma zatrudnienia</h2>";
                        echo "<h3 class='datas_list'>".$data['employment_form']."</h2>";
                        echo "<h3 class='datas_list2'>zmiana miejsca zamieszkania</h2>";
                        echo "<h3 class='datas_list'>".$data['change_of_residence']."</h2>";
                        echo "<h3 class='datas_list2'>preferowane wynagrodzenie</h2>";
                        echo "<h3 class='datas_list'>".$data['salary']."</h2>";
                        echo "<h3 class='datas_list2'>status zatrudnienia</h2>";
                        echo "<h3 class='datas_list'>".$data['status']."</h2>";
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
