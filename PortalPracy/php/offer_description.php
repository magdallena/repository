<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='../js/tooltips.js'></script>
        <script src='../js/jquery-2.1.1.js' type='text/javascript'></script>
        <script src="../js/send_application.js" type='text/javascript'></script>
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
                    $all_offers = $db->get_offer_number();
                    if (!isset($_GET['id']) or $_GET['id'] > $all_offers) {
                        echo "<h3>Niepoprawny numer oferty.</h3>";
                    } else {
                        $offer_id = $_GET['id'];
                        if (($_SESSION['usertype'] == 'student') or ($_SESSION['usertype'] == 'nauczyciel'))
                            $ok = true;
                        if ($_SESSION['usertype'] == 'firma') {
                            if (!$db->check_offer_with_company($offer_id, $_SESSION['id'])) {
                                echo "<h3>Ta oferta nie należy do twojej firmy.</h3>";
                                $ok = false;
                            } else
                                $ok = true;
                        }
                        if ($ok) {
                            $obj = $db->get_offer_data($offer_id);
                            echo "<h3>Firma: <a href='profile_company.php?id=" . $obj->company_id . "'><span class='conspicuous'>" . $obj->name . "</span></a> stanowisko: <span class='conspicuous'>" . $obj->job . "</span></h3>";
                            $today = date('Y-m-d', time());
                            if ($today >= $obj->date_from && $today <= $obj->date_to) {
                                echo "<h3><span clas='conspicuous'>Oferta aktywna</span></h3>";
                                $active = TRUE;
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
                            echo "<li>Oferta ważna od <span class='bold'>" . $obj->date_from . " </span>do <span class='bold'>" . $obj->date_to . "</span></li>";
                            echo "</ul></p>";
                            echo "</div>";

                            if ($_SESSION['usertype'] == 'student') {
                                $applic = $db->get_application_data_for_student($_SESSION['id'], $obj->offer_id);
                                $obj2 = $applic->fetch_object();
                                if ($applic->num_rows == 1) {
                                    echo "<h3>Twoja aplikacja na tę ofertę została wysłana.</h3>";
                                    echo "<span class='conspicuous'><a href='../documents/" . $obj2->cv . "' download>cv</a></span>";
                                    echo "<br/>";
                                    echo "<span class='conspicuous'><a href='../documents/" . $obj2->motivation_letter . "' download>list motywacyjny</a></span>";
                                    $obj2 = $applic->fetch_object();
                                    if (!isset($obj2->response)) {
                                        echo "<h3 class='conspicuous'>Nie otrzymałeś jeszcze odpowiedzi</h3>";
                                    } else {
                                        echo "<p><span class='bold'>&rArr;&rArr;&rArr;Odpowiedź z dnia " . $obj2->response_date . ":</span><br/>";
                                        echo $obj2->response . "</p>";
                                    }
                                } else if ($active) {
                                    echo "<h3 >&rArr;&rArr;&rArr;APLIKUJ: </h3><div id = 'offer" . $obj->offer_id . "'>";
                                    ?>
                                    <form class='send_application'  action="javascript:;" method='POST' enctype="multipart/form-data">
                                        <table>
                                            <tr>
                                                <td>
                                                    <input type='hidden' name='offer_id' <?php echo" value='$obj->offer_id'" ?>/>
                                                    <input type='hidden' name='student_id' <?php echo" value='" . $_SESSION['id'] . "'" ?>/>
                                                    <label for="cv">CV </label> </td>
                                                <td><input type="file" name="cv" id='cv'/></td>  
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="motivation_letter">List motywacyjny </label> </td>
                                                <td><input type="file" name="motivation_letter" id='motivation_letter'/> </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="submit" name= 'send_application' value="Wyślij aplikację"></td>
                                            </tr>
                                        </table>
                                    </form>
                                    <span class='error'></span>
                                    <?php
                                    echo "</div>";
                                }
                            }

                            if ($_SESSION['usertype'] == 'firma') {
                                $number = $db->get_number_of_application($obj->offer_id);
                                if ($number == 0) {
                                    echo "Brak aplikacji dotyczących tej oferty.";
                                } else {
                                    echo "<span class='bold'><a href='list_application.php?id=" . $obj->offer_id . "'>Zobacz aplikacje ($number)</a></span>";
                                }
                            }
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


