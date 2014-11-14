<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <!--<script src="../js/ajax.js" type="text/javascript"></script>-->
        <script src="../js/jquery-2.1.1.js" type="text/javascript"></script>
        <script src="../js/send_response_to_application.js" type="text/javascript"></script>
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
                    if ($_SESSION['usertype'] = 'firma') {
                        include_once 'classDatabase.php';
                        $db = new Database();
                        $all_offers = $db->get_number_of_offers($_SESSION['id']);
                        if (!isset($_GET['id']) or $_GET['id'] > $all_offers) {
                            echo "<h3>Niepoprawny numer oferty.</h3>";
                        } else {
                            $offer_id = $_GET['id'];

                            if (!$db->check_offer_with_company($offer_id, $_SESSION['id'])) {
                                echo "<h3>Ta oferta nie należy do twojej firmy.</h3>";
                            } else {
                                $onpage = 2;
                                $all = $db->get_number_of_application($offer_id);
                                $start = $page->dopaging($onpage, $all, "list_application.php?");
                                $result = $db->get_application_data($offer_id, $start, $onpage);

                                if ($result->num_rows == 0) {
                                    echo "<h3>Brak aplikacji na tę ofertę.</h3>";
                                } else {
                                    $obj = $result->fetch_object();
                                    echo"<p><ul class='offer_description'>";
                                    echo "<h3>Dane oferty: </h3>";
                                    echo "<li><span class='bold'>Stanowisko: </span>" . $obj->job . "</li>";
                                    echo "<li><span class='bold'>Opis oferty:</span><br/> " . $obj->description . "</li>";
                                    echo "<li><span class='bold'>Wymagania:</span><br/> " . $obj->requirements . "</li>";
                                    echo "<li><span class='bold'>Miejsce pracy: </span>" . $obj->place_of_work . "</li>";
                                    echo "<li><span class='bold'>Forma zatrudnienia: </span>" . $obj->employment_status . "</li>";
                                    echo "<li><span class='bold'>Wymiar pracy (liczba godzin w tygodniu): </span>" . $obj->number_of_hours . "</li>";
                                    echo "<li><span class='bold'>Długość umowy: </span>" . $obj->length_of_contract . "</li>";
                                    echo "<li><span class='bold'>Wynagrodzenie: </span>" . $obj->salary . "</li>";
                                    echo "<li>Oferta ważna od <span class='bold'>" . $obj->date_from . " </span>do <span class='bold'>" . $obj->date_to . "</span></li>";
                                    echo "</ul></p>";
                                    echo "<h3>Lista aplikacji</h3>";
                                    echo "<div class='information_table'><table >";
                                    echo "<tr><td>Lp.</td><td>Student</td><td>Data</td><td>CV</td><td>List Motywacyjny</td><td>Odpowiedź</td></tr>";
                                    $result = $db->get_application_data($offer_id, $start, $onpage);
                                    while ($obj = $result->fetch_object()) {
                                        echo "<tr>";
                                        $start++;
                                        echo "<td>$start</td>";
                                        echo "<td><a href='profile_student.php?id=" . $obj->student_id . "'>" . $obj->name . " " . $obj->last_name . "</a></td>";
                                        echo "<td>" . $obj->date . "</td>";
                                        echo "<td> <a href='../documents/" . $obj->cv . "' target='_blank'>Otwórz </a><br/>"
                                        . "<a href='../documents/" . $obj->cv . "' download>Pobierz </a></td>";
                                        echo "<td> <a href='../documents/" . $obj->motivation_letter . "' target='_blank'>Otwórz </a><br/>"
                                        . "<a href='../documents/" . $obj->motivation_letter . "' download>Pobierz </a></td>";

                                        echo "<td id = 'row" . $obj->application_id . "'>";
                                        if (!$obj->response == NULL) {
                                            echo "Odpowiedż z dnia " . $obj->response_date . " została wysłana:<br/>" . $obj->response;
                                        } else {
                                            echo "<form method='POST' class='response_to_application'> ";
                                            echo "<input type='hidden' name='application_id' value='$obj->application_id' /> ";
                                            echo "<textarea type='text' id='response' name='response' rows='5' cols='37'></textarea>";
                                            echo "<br/>";
                                            echo "<input type='submit' name= 'send_response' value='Wyślij odpowiedź'>";
                                            echo "</form>";
                                            echo "<span class='error'></span>";
                                        }
                                        echo "</td> ";
                                        echo "</tr>";
                                    }
                                    echo "</table></div>";
                                }
                                $page->dopaging($onpage, $all, "list_application.php?");
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

