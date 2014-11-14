<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='../js/jquery-ui.js'></script>
        <script type='text/javascript'>
            $(':radio').change(
                    function() {
                        $('.choice').text(this.value + ' stars');
                    }
            );
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
                        echo "<div id='profile_description'>";
                        echo "<img src='../galery_company/" . $data['photoname'] . "' class='photo'/>";
                        echo "<h2 class='datas_list_name'>" . $data['name'] . "</h2>";
                        echo "<h3 class='datas_list'>" . $data['address'] . "</h2>";
                        echo "<h3 class='datas_list'>tel. " . $data['telephone'] . "</h2>";
                        echo "</div>";

                        //komentarze
                        echo "<div id='comments'>";
                        echo "<h2>Komentarze</h2>";
                        if ($_SESSION['usertype'] == 'student') {
                            ?>
                            <div>
                                <form id = 'add_comment' action ='add_comment.php' method='POST'>
                                    <input type='hidden' name='company_id' <?php echo" value='$id'" ?>/>
                                    <input type='hidden' name='student_id' <?php echo" value='" . $_SESSION['id'] . "'" ?>/>
                                    <textarea type="text" id='com_content' name="content" rows='5' cols='50'>Napisz komentarz...</textarea>
                                    <br/>  <div class='clear'></div> 
                                    <span>Oceń firmę</span>


                                    <fieldset class="rating">
                                        <legend>Please rate:</legend>
                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                                    </fieldset>








                                    <input type="submit" name= 'add_comment' value="Wyślij">
                                </form>
                            </div>
                            <span class='error'></span>
                            <div class='clear'></div>
                            <?php
                        }
                        $onpage = 2;
                        $all = $db->get_comments_number($id);
                        $start = $page->dopaging($onpage, $all, "profile_company.php?id=$id&amp;");
                        $result = $db->get_comments_list($start, $onpage, $id);
                        echo "<div id='shown_comments'>";
                        while ($obj = $result->fetch_object()) {
                            include_once 'classComment.php';
                            $com = Comment::make_new_to_display($obj->student_id, $obj->name, $obj->last_name, $obj->date, $obj->content, $obj->rate);
                            echo $com->display();
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
