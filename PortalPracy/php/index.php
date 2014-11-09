<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="../css/ui-tabs.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <script src='../js/jquery-2.1.1.js' type='text/javascript'></script>
        <script src="../js/jquery-ui.js" type='text/javascript'></script>
        <script src="../js/send_application.js" type='text/javascript'></script>
        <script src="../js/send_response_to_offer.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {

                var icons = {
                    header: "ui-icon-circle-arrow-e",
                    activeHeader: "ui-icon-circle-arrow-s"
                };
                $("#accordion1, #accordion2, #accordion3, #accordion4").accordion({
                    collapsible: true,
                    active: false,
                    icons: icons,
                    beforeActivate: function(event, ui) {
                        // The accordion believes a panel is being opened
                        if (ui.newHeader[0]) {
                            var currHeader = ui.newHeader;
                            var currContent = currHeader.next('.ui-accordion-content');
                            // The accordion believes a panel is being closed
                        } else {
                            var currHeader = ui.oldHeader;
                            var currContent = currHeader.next('.ui-accordion-content');
                        }
                        // Since we've changed the default behavior, this detects the actual status
                        var isPanelSelected = currHeader.attr('aria-selected') == 'true';

                        // Toggle the panel's header
                        currHeader.toggleClass('ui-corner-all', isPanelSelected).toggleClass('accordion-header-active ui-state-active ui-corner-top', !isPanelSelected).attr('aria-selected', ((!isPanelSelected).toString()));

                        // Toggle the panel's icon
                        currHeader.children('.ui-icon').toggleClass('ui-icon-triangle-1-e', isPanelSelected).toggleClass('ui-icon-triangle-1-s', !isPanelSelected);

                        // Toggle the panel's content
                        currContent.toggleClass('accordion-content-active', !isPanelSelected);
                        if (isPanelSelected) {
                            currContent.slideUp();
                        } else {
                            currContent.slideDown();
                        }

                        return false; // Cancels the default action
                    }
                });
                $("#tabs, #tabs2").tabs({active: 0});
            });
        </script>
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
                <!--                STUDENT-->
                <?php
                include_once 'classDatabase.php';
                $db = new Database();
                if (isset($_SESSION['name'])) {
                    if ($_SESSION['usertype'] == 'student') {
                        if (isset($_POST['send_response'])) {
                            include_once 'classOfferToStudent.php';
                            $soffer = OfferToStudent::make_new_to_response();
                            $soffer->send_response();
                        }
//                        else if (isset($_POST['send_application'])) {
//                            include_once 'classApplication.php';
//                            $app = Application::make_new_to_add();
//                            $app->add_application();
//                        } 
                        else {
                            ?>
                            <div id="tabs">
                                <ul>
                                    <li><a href="#accordion1">Oferty dla mnie</a></li>
                                    <li><a href="#accordion2">Oferty ogólne</a></li>
                                </ul>
                                <!--oferty dla studenta-->
                                <div id="accordion1">
                                    <?php
                                    $result = $db->get_offer_to_student($_SESSION['id']);
                                    if ($result->num_rows == 0) {
                                        echo "<h3>brak ofert</h3>";
                                    } else {
                                        while ($obj = $result->fetch_object()) {
                                            echo "<h3>Firma: <span class='conspicuous'>" . $obj->name . "</span> stanowisko: <span class='conspicuous'>" . $obj->job . "</span></h3>";
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
                                            echo "<li><span class='bold'><a href='profile_company.php?id=" . $obj->company_id . "'>Zobacz profil firmy</a></span></li>";
                                            echo "</ul></p>";
                                            echo "<hr/><div id = 'offers" . $obj->offer_to_id . "'>";
                                            if ($obj->response == NULL) {
                                                ?>
                                                <form class='send_response' action ='index.php' method='POST'>
                                                    <input type='hidden' name='offer_id' <?php echo" value='$obj->offer_to_id'" ?>/>
                                                    <textarea type="text" id="response" name="response" rows='5' cols='37'></textarea></td>
                                                    <br/>   
                                                    <input type="submit" name= 'send_response' value="Wyślij odpowiedź">
                                                </form>
                                                <span class='error'></span>
                                                <?php
                                            } else {
                                                echo "<h3>Twoja odpowiedź na tę ofertę została wysłana.</h3>";
                                            }
                                            echo "</div></div>";
                                        }
                                    }
                                    ?>
                                </div>
                                <!--oferty ogólne-->
                                <div id="accordion2">
                                    <?php
                                    $result = $db->get_offer();
                                    if ($result->num_rows == 0) {
                                        echo "<h3>brak ofert</h3>";
                                    } else {
                                        while ($obj = $result->fetch_object()) {
                                            $applic = $db->get_application_data_for_student($_SESSION['id'], $obj->offer_id);
                                            echo "<h3>";
                                            if ($applic->num_rows == 1) {
                                                $obj2 = $applic->fetch_object();
                                                if (!$obj2->response == NULL) {
                                                    echo "<img src='../images/message_icon.png'\ class='icon'>";
                                                }
                                            }
                                            echo " Firma: <span class='conspicuous'>" . $obj->name . "</span> stanowisko: <span class='conspicuous'>" . $obj->job . "</span></h3>";
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
                                            echo "<li><span class='bold'><a href='profile_company.php?id=" . $obj->company_id . "'>Zobacz profil firmy</a></span></li>";
                                            echo "</ul></p><hr/>";
                                            $applic = $db->get_application_data_for_student($_SESSION['id'], $obj->offer_id);
                                            if ($applic->num_rows == 1) {
                                                echo "<h3>Twoja aplikacja na tę ofertę została wysłana.</h3>";
                                                $obj2 = $applic->fetch_object();
                                                if ($obj2->response == NULL) {
                                                    echo "<h3>Nie otrzymałeś jeszcze odpowiedzi</h3>";
                                                } else {
                                                    echo "<p><span class='bold'>&rArr;&rArr;&rArr;Odpowiedź z dnia " . $obj2->response_date . ":</span><br/>";
                                                    echo $obj2->response . "</p>";
                                                }
                                            } else {
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
                                            echo "</div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
//                    <!--                NAUCZYCIEL-->
                    else if ($_SESSION['usertype'] == 'nauczyciel') {
                        $result = $db->get_asks_for_reference($_SESSION['id']);
                        if ($result->num_rows == 0) {
                            echo "<h3>Brak zapytań o referencje.</h3>";
                        } else {
                            echo "<div class='information_table'><table >";
                            echo "<tr><td>Student</td><td>Wiadomość</td><td>Data</td><td>Napisz referencje</td><td>Ignoruj</td></tr>";
                            while ($obj = $result->fetch_object()) {
                                echo "<tr id = 'row" . $obj->ask_id . "'>";
                                echo "<td><a href='profile_student.php?id=" . $obj->student_id . "'>" . $obj->name . " " . $obj->last_name . "</a></td>";
                                echo "<td>" . $obj->message . "</td>";
                                echo "<td>" . $obj->date . "</td>";
                                echo "<td><a href='profile_student.php?id=" . $obj->student_id . "'>napisz</a></td>";

                                echo "<td><a onclick='ignore(" . $obj->ask_id . ")'>ignoruj</a></td> ";
                                echo "</tr>";
                            }
                            echo "</table></div>";
                            echo "<div id='message'></div>";
                        }
                    }
//                    <!--                FIRMA-->
                    else if ($_SESSION['usertype'] == 'firma') {
                        ?>
                        <div id="tabs2">
                            <ul>
                                <li><a href="#accordion3">Oferty do studenta</a></li>
                                <li><a href="#accordion4">Oferty ogólne</a></li>
                            </ul>
                            <!--oferty do studenta-->
                            <div id="accordion3">
                                <?php
                                $result = $db->get_offer_to_student_for_company($_SESSION['id']);
                                if ($result->num_rows == 0) {
                                    echo "<h3>brak ofert</h3>";
                                } else {
                                    while ($obj = $result->fetch_object()) {
                                        echo "<h3>";
                                        if (!$obj->response == NULL) {
                                            echo "<img src='../images/message_icon.png'\ class='icon'>";
                                        }
                                        echo " Student: <span class='conspicuous'>" . $obj->name . " " . $obj->last_name . "</span> stanowisko: <span class='conspicuous'>" . $obj->job . "</span></h3>";
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
                                        echo "<li><span class='bold'><a href='profile_student.php?id=" . $obj->student_id . "'>Zobacz profil studenta</a></span></li>";
                                        echo "<hr/><li>";
                                        if ($obj->response == NULL) {
                                            echo "<span>Brak odpowiedzi.</span>";
                                        } else {
                                            echo "<span class='bold'>&rArr;&rArr;&rArr;Odpowiedź z dnia: " . $obj->response_date . "</span><br/> " . $obj->response;
                                        }
                                        echo "</li>";
                                        echo "</ul></p>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                            <!--oferty ogólne-->
                            <div id="accordion4">
                                <?php
                                $result = $db->get_offer_for_company($_SESSION['id']);
                                if ($result->num_rows == 0) {
                                    echo "<h3>brak ofert</h3>";
                                } else {
                                    while ($obj = $result->fetch_object()) {
                                        echo "<h3>";
                                        $number = $db->get_number_of_application($obj->offer_id);
                                        if ($number != 0) {
                                            echo "<img src='../images/message_icon.png' class='icon'\>($number)";
                                        }
                                        echo " Oferta na stanowisko: <span class='conspicuous'>" . $obj->job . "</span> (<span class='bold'>" . $obj->date_from . " </span> - <span class='bold'>" . $obj->date_to . ")</h3>";
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
                                        echo "<li><span class='bold'><a href='profile_company.php?id=" . $obj->company_id . "'>Zobacz profil firmy</a></span></li>";
                                        echo "<hr/><li>";
                                        if ($number == 0) {
                                            echo "Brak aplikacji dotyczących tej oferty.";
                                        } else
                                            echo "<span class='bold'><a href='list_application.php?id=" . $obj->offer_id . "'>Zobacz aplikacje ($number)</a></span>";
                                        echo "</li>";
                                        echo "</ul>";
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>



                <!--                <div class="post">
                                    <h2><a href="#">Terms of Use</a></h2>
                                    <p class="postmeta">Posted in <a href="#">Class apent</a> | Sep 20, 2019 | <a href="#">4 comments</a></p>
                                    <div class="entry">
                                        <img class="block" src="../images/image.jpg" width="720" height="300" alt="" />
                                        <p>The template is released under the <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution</a> license. This means it can be used for both private and commercial purposes, edited freely or redistributed as long as you keep the link back to Alpha Studio. The link, however, can be moved to any other place of the site. Do not use the template for websites with illegal or immoral content.</p>
                                        <p>The image comes from <a href="http://www.publicdomainpictures.net/">PublicDomainPictures.net</a> and is in public domain. Please be aware that public domain content may in some cases infringe trademark, property or any other rights of others, so you use it at your own risk.</p>
                                        <p class="readmore"><a href="#">read more</a></p>
                                    </div>
                                </div> post 
                                <div class="post">
                                    <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                                    <p class="postmeta">Posted in <a href="#">Lorem ipsum</a> | Sep 19, 2019 | <a href="#">2 comments</a></p>
                                    <div class="entry">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nec dui quis urna sollicitudin sodales. Fusce laoreet, ligula et rhoncus volutpat, felis magna varius tortor, ac molestie diam lorem in lectus. Aliquam venenatis mollis est, a porttitor ipsum interdum nec.</p>
                                        <p>Quisque congue lacus sed odio fermentum tincidunt. Proin vitae nulla velit. Cras consectetur commodo scelerisque. Curabitur leo nisl, blandit at tempus et, interdum at risus. Sed dui augue, pellentesque ac pulvinar id, malesuada eget diam. Integer elementum sem eget tortor faucibus id pellentesque lorem dignissim.</p>
                                        <p class="readmore"><a href="#">read more</a></p>
                                    </div>
                                </div> post 	-->
            </div><!-- content -->
            <div id="sidebar">
                <?php
                $page->dosidebar();
                ?>
                <h2>Integer rhoncus</h2>
                <div class="box">
                    <p>Mauris sollicitudin tincidunt magna vitae semper. Curabitur ut pharetra quam. Integer rhoncus convallis urna vitae mattis. Sed pharetra massa ac metus fermentum et iaculis enim accumsan.</p>
                </div>
                <h2>Mauris sagittis</h2>
                <ul>
                    <li><a href="#">Integer non enim nec tellus</a></li>
                    <li><a href="#">Lobortis tempus vel nec lorem</a></li>
                    <li><a href="#">Cum sociis natoque penatibus</a></li>
                    <li><a href="#">Etiam convallis enim tincidunt</a></li>
                    <li><a href="#">Aenean rutrum tortor a purus</a></li>
                    <li><a href="#">Quisque convallis nisl ac augue</a></li>
                </ul>
                <h2>Proin lobortis nisi</h2>
                <div class="box">
                    <p>Pellentesque nisi purus, varius vitae dignissim sed, faucibus nec nibh. In vestibulum tortor eu metus vulputate condimentum. Donec imperdiet nisi vel nisl fringilla a imperdiet tortor mollis. Nulla non enim felis.</p>
                </div>
            </div><!-- sidebar -->
            <div class="clearing">&nbsp;</div>
        </div><!-- main -->

        <?php
        $page->dofooter();
        ?>
    </body>
</html>
