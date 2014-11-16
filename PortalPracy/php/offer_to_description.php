<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='../js/tooltips.js'></script>
        <script src='../js/jquery-2.1.1.js' type='text/javascript'></script>
        <script src="../js/send_response_to_offer.js" type="text/javascript"></script>
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
                    $all_offers = $db->get_offer_to_number();
                    if (!isset($_GET['id']) or $_GET['id'] > $all_offers) {
                        echo "<h3>Niepoprawny numer oferty.</h3>";
                    } else {
                        $offer_to_id = $_GET['id'];
                        if ($_SESSION['usertype'] == 'student') {
                            if (!$db->check_offer_to_with_student($offer_to_id, $_SESSION['id'])) {
                                echo "<h3>To nie jest Twoja oferta.</h3>";
                                $ok = false;
                            } else {
                                $ok = true;
                            }
                        }
                        if ($_SESSION['usertype'] == 'firma') {
                            if (!$db->check_offer_to_with_company($offer_to_id, $_SESSION['id'])) {
                                echo "<h3>Ta oferta nie należy do twojej firmy.</h3>";
                                $ok = false;
                            } else {
                                $ok = true;
                            }
                        }
                        if ($ok) {
                            $obj = $db->get_offer_to_data($offer_to_id);
                            $student = $db->get_student_data($obj->student_id);
                            echo "<h3>Firma: <a href='profile_company.php?id=" . $obj->company_id . "'><span class='conspicuous'>" . $obj->name . "</span></a> stanowisko: <span class='conspicuous'>" . $obj->job . "</span></h3>";
                            echo "<h3>Student: <a href='profile_student.php?id=" . $obj->student_id . "'><span class='conspicuous'>" . $student['name'] . " " . $student['last_name'] . "</span></a>";
                            $today = date('Y-m-d', time());
                            if ($today >= $obj->date_from && $today <= $obj->date_to) {
                                echo "<h3><span clas='conspicuous'>Oferta aktywna</span></h3>";
                                $active = TRUE;
                                echo $today;
                                echo $obj->date_from;
                                echo $obj->date_to;
                            } else {
                                echo "<h3><span clas='conspicuous'>Oferta nieaktywna</span></h3>";
                                $active = FALSE;
                            }
                            echo "<div>";
                            echo"<p><ul class='offer_description'>";
                            echo "<li><span class='bold'>Opis oferty:</span><br/> " . $obj->description . "</li>";
                            echo "<li><span class='bold'>Wymagania:</span><br/> " . $obj->requirements . "</li>";
                            echo "<li><span class='bold'>Miejsce pracy: </span>" . $obj->place_of_work . "</li>";
                            echo "<li><span class='bold'>Forma zatrudnienia: </span>" . $obj->employment_status . "</li>";
                            echo "<li><span class='bold'>Wymiar pracy (liczba godzin w tygodniu): </span>" . $obj->number_of_hours . "</li>";
                            echo "<li><span class='bold'>Długość umowy: </span>" . $obj->length_of_contract . "</li>";
                            echo "<li><span class='bold'>Wynagrodzenie: </span>" . $obj->salary . "</li>";
                            echo "<li>Data wysłania oferty: <span class='bold'>" . $obj->date_send . "</span></li>";
                            echo "<li>Oferta ważna od <span class='bold'>" . $obj->date_from . " </span>do <span class='bold'>" . $obj->date_to . "</span></li>";
                            echo "</ul></p>";
                            echo "</div>";

                            echo "<hr/><div id = 'offers" . $offer_to_id . "'>";
                            if ($obj->response == NULL) {
                                if ($_SESSION ['usertype'] == 'student' && $active) {
                                    ?>
                                    <form class='send_response' action ='javascript:;' method='POST'>
                                        <input type='hidden' name='offer_id' <?php echo" value='$obj->offer_to_id'" ?>/>
                                        <textarea type="text" id="response" name="response" rows='5' cols='37'></textarea></td>
                                        <br/>   
                                        <input type="submit" name= 'send_response' value="Wyślij odpowiedź">
                                    </form>
                                    <span class='error'></span>
                                    <?php
                                } else {
                                    echo "<h3>Brak odpowiedzi od studenta </h3>";
                                }
                            } else {
                                echo "<h3>Odpowiedź studenta z dnia: " . $obj->response_date . "</h3>";
                                echo "<p>" . $obj->response . "</p>";
                            }
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


