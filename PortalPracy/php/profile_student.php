<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js/jquery-2.1.1.js"></script>
        <script type="text/javascript" src="../js/send_reference.js"></script>
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
//                    
                    $data = $db->get_student_data($id);
                    if ($data == false) {
                        echo "<h3>Niepoprawny numer studenta (konto może być usunięte)</h3>";
                    } else {
                        echo "<div id='profile_description'>";
                        echo "<img src='../galery_student/" . $data['photoname'] . "' class='photo'/>";
                        echo "<h2 class='datas_list_name'>" . $data['name'] . " " . $data['last_name'] . "</h2>";
                        echo "<h3 class='datas_list'>" . $data['address'] . "</h3>";
                        echo "<h3 class='datas_list'>tel. " . $data['telephone'] . "</h3>";

                        echo "<h3><a href=#references>Opinie nauczycieli o studencie</a></h3>";
                        if($_SESSION['usertype'] != 'student' || $id = $_SESSION['id']) {
                            echo "<h3 class='datas_list2'>wykształcenie</h3>";
                            echo "<h3 class='datas_list'>" . $data['education'] . "</h3>";
                            echo "<h3 class='datas_list2'>języki</h3>";
                            echo "<h3 class='datas_list'>" . $data['languages'] . "</h3>";
                            echo "<h3 class='datas_list2'>doświadczenie</h3>";
                            echo "<h3 class='datas_list'>" . $data['experience'] . "</h3>";
                            echo "<h3 class='datas_list2'>umiejętności</h3>";
                            echo "<h3 class='datas_list'>" . $data['skills'] . "</h3>";
                            echo "<h3 class='datas_list2'>zainteresowania</h3>";
                            echo "<h3 class='datas_list'>" . $data['interest'] . "</h3>";
                            echo "<h3 class='datas_list2'>preferowana forma zatrudnienia</h3>";
                            echo "<h3 class='datas_list'>" . $data['employment_form'] . "</h3>";
                            echo "<h3 class='datas_list2'>zmiana miejsca zamieszkania</h3>";
                            if ($data['change_of_residence'] == 1) {
                                echo "<h3 class='datas_list'>Tak</h3>";
                            } else {
                                echo "<h3 class='datas_list'>Nie</h3>";
                            }
                            echo "<h3 class='datas_list2'>preferowane wynagrodzenie</h3>";
                            echo "<h3 class='datas_list'>" . $data['salary'] . "</h3>";
                            echo "<h3 class='datas_list2'>status zatrudnienia</h3>";
                            echo "<h3 class='datas_list'>" . $data['status'] . "</h3>";
                        }
                        echo "</div>";

                        //referencje

                        echo "<div id='references'>";
                        echo "<h2>Referencje</h2>";
                        if ($_SESSION['usertype'] == 'nauczyciel') {
                            ?>
                            <div>
                                <form id = 'add_reference' action ='add_reference.php' method='POST'>
                                    <input type='hidden' name='student_id' <?php echo" value='$id'" ?>/>
                                    <input type='hidden' name='teacher_id' <?php echo" value='" . $_SESSION['id'] . "'" ?>/>
                                    <textarea type="text" id='ref_content' name="content" rows='5' cols='50'>Napisz referencje...</textarea>
                                    <br/>   
                                    <input type="submit" name= 'add_reference' value="Wyślij">
                                </form>
                            </div>
                            <span class='error'></span>
                            <div class='clear'></div>
                            <?php
                        }
                        $onpage = 2;
                        $all = $db->get_references_number($id);
                        $start = $page->dopaging($onpage, $all, "profile_student.php?id=$id&amp;");
                        $result = $db->get_references_list($start, $onpage, $id);
                        echo "<div id='shown_references'>";
                        while ($obj = $result->fetch_object()) {
                            include_once 'classReference.php';
                            $ref = Reference::make_new_to_display($obj->references_id, $obj->teacher_id, $obj->name, $obj->last_name, $obj->academic_degree, $obj->date, $obj->content);
                            echo $ref->display();
                        }
                        $page->dopaging($onpage, $all, "profile_student.php?id=$id&amp;");
                        echo "</div>";
                        echo "</div>";
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
