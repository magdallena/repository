<?php

class Page {

    private $title;

    function dohead() {
        
    }

    function dofooter() {
        echo '<div id="footer">
            <p>Copyright &copy; 2013, designed by <a href="http://www.alphastudio.pl/">Alpha Studio</a> | <a href="#">Privacy Policy</a></p>
        </div>';
    }

    function dologinfo() {
        @session_start();
        if (isset($_SESSION["name"])) {
            echo "<h3 id='log_info'>Użytkownik zalogowany jako: <span>" . $_SESSION['name'] . " (" . $_SESSION['usertype'] . ")</span> ";
            echo "<a href='logout.php' >(Wyloguj)</a></h3>";
        } else {
            echo "<h3 id='log_info'> <a href='login.php'>Zaloguj się</a>, a jeśli nie masz konta <a href='register.php'>zarejestruj się</a> </h3>";
        }
    }

    function domenu() {
        echo '<div id="menu">
            <ul>
                <li class="active"><a href="index.php">Strona główna</a></li>
                <li><a href="list_student.php">Studenci</a></li>
                <li><a href="list_teacher.php">Nauczyciele</a></li>
                <li><a href="list_company.php">Firmy</a></li>
                <li><a href="messages.php">Wiadomości';
        include_once 'classDatabase.php';
        $db = new Database();
        if ($_SESSION['usertype'] == 'student') {
            $num_mes = $db->get_message_to_student_number($_SESSION['id']);
            echo " ($num_mes)";
        } else if ($_SESSION['usertype'] == 'nauczyciel') {
            $num_mes = $db->get_message_to_teacher_number($_SESSION['id']);
            echo " ($num_mes)";
        } else if ($_SESSION['usertype'] == 'firma') {
            $num_mes = $db->get_message_to_company_number($_SESSION['id']);
            echo " ($num_mes)";
        }
        echo '</a></li>
            </ul>
        </div>';
    }

    function dosidebar() {
        if (isset($_SESSION['name']) and !strcmp($_SESSION['usertype'], "student")) {
            ?> 
            <h2>Funkcje studenta</h2>
            <ul>
                <li><a href="profile_student.php">Moje konto</a></li>
                <li><a href="edit_data.php">Edytuj dane</a></li>
                <li><a href="change_photo.php">Zmień zdjęcie</a></li>
                <li><a href="change_password.php">Zmień hasło</a></li>
                <li><a href="send_request.php">Wyślij prośbę o referencje</a></li>
                <li><a href="list_offer_all.php">Oferty</a></li>
                <li><a href="list_offer_to_all.php">Oferty do mnie</a></li>
                <li><a href="list_offer_applied_all.php">Oferty, na które aplikowałem </a></li>
            </ul>
            <?php
        }

        if (isset($_SESSION['name']) and !strcmp($_SESSION['usertype'], "nauczyciel")) {
            ?> 
            <h2>Funkcje nauczyciela</h2>
            <ul>
                <li><a href="profile_teacher.php">Moje konto</a></li>
                <li><a href="edit_data.php">Edytuj dane</a></li>
                <li><a href="change_password.php">Zmień hasło</a></li>
                <li><a href="index.php">Prośby o referencje 
                        <?php
                        include_once 'classDatabase.php';
                        $db = new Database();
                        $result = $db->get_asks_for_reference($_SESSION['id']);
                        echo '(' . $result->num_rows . ')';
                        ?>
                    </a></li>
                <li><a href="list_offer_all.php">Wszystkie oferty</a></li>
                <li><a href="#"></a></li>
            </ul>
            <?php
        }

        if (isset($_SESSION['name']) and !strcmp($_SESSION['usertype'], "firma")) {
            ?> 
            <h2>Funkcje firmy</h2>
            <ul>
                <li><a href="profile_company.php">Moje konto</a></li>
                <li><a href="edit_data.php">Edytuj dane</a></li>
                <li><a href="change_photo.php">Zmień logo</a></li>
                <li><a href="change_password.php">Zmień hasło</a></li>
                <li><a href="add_offer.php">Umieść ofertę</a></li>
                <li><a href="add_offer.php?student=true">Wyślij ofertę do studenta</a></li>
                <li><a href="list_offer_added.php">Oferty ogólne</a></li>
                <li><a href="list_offer_to_added.php">Oferty do studenta</a></li>
            </ul>
            <?php
        }
    }

    function dopaging($onpage, $all, $filename) {
        $allpages = ceil($all / $onpage);
        if (!isset($_GET['page']) or $_GET['page'] > $allpages) {
            $current_page = 1;
        } else {
            $current_page = $_GET['page'];
        }
        $start = ($current_page - 1) * $onpage;
        $prev = $current_page - 1;
        $next = $current_page + 1;
        echo "<div id='pages'><ul>";
        if ($current_page > 1) {
            echo "<li><a href='" . $filename . "page=" . $prev . "'>Poprzednia</a></li>";
        }
        for ($i = 1; $i <= $allpages; $i++) {
            if ($i == $current_page) {
                echo "<li class='current'>";
            } else {
                echo "<li>";
            }
            echo "<a href='" . $filename . "page=" . $i . "'>" . $i . "</a></li>";
        }
        if ($current_page < $allpages) {
            echo "<li><a href='" . $filename . "page=" . $next . "'>Następna</a></li>";
        }
        echo "</ul></div>";
        echo "<div class='clear'></div>";
        return $start;
    }

}
