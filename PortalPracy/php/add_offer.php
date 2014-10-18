<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../css/ui-datapicker.css">
        <script src='../js/jquery-2.1.1.js' type='text/javascript'></script>
        <script src="../js/jquery-ui.js" type='text/javascript'></script>
        <script src='../js/jquery.validate.js' type='text/javascript'></script>
        <script src='../js/offer_validate.js' type='text/javascript'></script>
        <script>
            $(function() {
                $("#date_from").datepicker({
                    defaultDate: "+1w",
                    minDate: 0,
                    changeMonth: true,
                    numberOfMonths: 2,
                    dateFormat: 'yy-mm-dd',
                    onClose: function(selectedDate) {
                        $("#date_to").datepicker("option", "minDate", selectedDate);
                    }
                });
                $("#date_to").datepicker({
                    defaultDate: "+1w",
                    minDate: +30,
                    changeMonth: true,
                    numberOfMonths: 2,
                    dateFormat: 'yy-mm-dd',
                    onClose: function(selectedDate) {
                        $("#date_from").datepicker("option", "maxDate", selectedDate);
                    }
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
                    if ($_SESSION['usertype'] == 'firma') {
                        if (isset($_POST['add_offer'])) {
                            if (isset($_POST['student_id'])) {
                                include_once 'classOfferToStudent.php';
                                $soffer = OfferToStudent::make_new_to_add($_SESSION['id']);
                                $soffer->add_offer_to_student();
                            } else {
                                include_once 'classOffer.php';
                                $offer = Offer::make_new_to_add($_SESSION['id']);
                                $offer->add_offer($_SESSION['id']);
                            }
                        } else {
                            ?>
                            <form action="add_offer.php" method="POST" id="add_offer">
                                <table>
                                    <?php
                                    if (isset($_GET['student'])) {
                                        if ($_GET['student'] == 'true') {
                                            echo "<tr><td>Wybierz studenta</td>";
                                            echo "<td><select name='student_id'>";
                                            include_once 'classDatabase.php';
                                            $db = new Database();
                                            $all = $db->get_student_number();
                                            $result = $db->get_student_list(0, $all);
                                            var_dump($result);
                                            while ($obj = $result->fetch_object()) {
                                                echo"<option value='$obj->student_id'>" . $obj->name . " " . $obj->last_name . "</option>";
                                            }
                                            echo "</select></td></tr>";
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td>Stanowisko: </td>
                                        <td><input type="text" id="job" name="job" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td>Opis oferty: </td>
                                        <td><textarea rows='5' cols='37' id="description" name="description"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Wymagania: </td>
                                        <td><textarea rows='5' cols='37' id="requirements" name="requirements"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="place_of_work">Miejsce pracy:</label></td>
                                        <td><input type="text" id="place_of_work" name="place_of_work" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="employment_status">Forma zatrudnienia:</label></td>
                                        <td> <select name="employment_status">
                                                <option value="umowa o pracę">umowa o pracę</option>
                                                <option value="umowa zlecenie">umowa zlecenie</option>
                                                <option value="umowa o dzieło">umowa o dzieło</option>
                                                <option value="staż">staż</option>
                                                <option value="praktyki">praktyki</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><label for="number_of_hours">Wymiar pracy (liczba godzin w tygodniu):</label></td>
                                        <td><input type="text" id="number_of_hours" name="number_of_hours" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="length_of_contract">Długość umowy:</label></td>
                                        <td><input type="text" id="length_of_contract" name="length_of_contract" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="salary">Wynagrodzenie:</label></td>
                                        <td><input type="text" id="salary" name="salary" size="50"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="date_from">Oferta ważna od:</label></td>
                                        <td><input type="text" id="date_from" name="date_from" size="20"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="date_to">Oferta ważna do:</label></td>
                                        <td><input type="text" id="date_to" name="date_to" size="20"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name= 'add_offer' value="Dodaj ofertę"></td>
                                    </tr>
                                </table>








                            </form>
                            <?php
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

