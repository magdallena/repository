<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='../js/jquery-2.1.1.js'></script>
        <script type='text/javascript' src='../js/send_comment.js'></script>
        <script src="../js/ajax.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $('label').click(function() {
                    labelID = $(this).attr('for');
                    $('#' + labelID).trigger('click');
                });
            });
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
                        if($data == false) {
                            echo "<h3>Niepoprawny numer firmy (konto może być usunięte)</h3>";
                        } else {
                            echo "<div id='profile_description'>";
                            echo "<img src='../galery_company/" . $data['photoname'] . "' class='photo'/>";
                            echo "<h2 class='datas_list_name'>" . $data['name'] . "</h2>";
                            echo "<h3 class='datas_list'>" . $data['address'] . "</h3>";
                            echo "<h3 class='datas_list'>tel. " . $data['telephone'] . "</h3>";
                            include_once 'classComment.php';
                            $com = Comment::make_new_to_count_average($id);
                            echo "<h3 class='datas_list'>średnia ocen <span id='average'>".$com->count_average()."</span> (<span id='allvotes'>".$com->count_number_of_votes()."</span> głosów)</h3>";
                            echo "<a href='list_offer_added.php?id=".$data['company_id']."'>Zobacz oferty umieszczone przez tę firmę</a>";
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

                                        <fieldset class="rating">
                                            <legend>Oceń firmę</legend>
                                            <input type='radio' name='rating' value='0' checked="checked">
                                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5" class='label'>5 stars</label>
                                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4" class='label'>4 stars</label>
                                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3" class='label'>3 stars</label>
                                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2" class='label'>2 stars</label>
                                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1" class='label'>1 star</label>
                                            <input type='radio' name='rating' value='0' checked="checked">
                                        </fieldset>
                                        <input type="submit" name= 'add_comment' value="Wyślij">
                                        <span class='error'></span>
                                    </form>
                                </div>
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
                                $com = Comment::make_new_to_display($obj->comment_id,$obj->student_id, $obj->name, $obj->last_name, $obj->date, $obj->content, $obj->rate);
                                echo $com->display();
                            }
                            $page->dopaging($onpage, $all, "profile_student.php?id=$id&amp;");
                            echo "</div>";
                            echo "</div>";
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
