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
                
            </ul>
        </div>';
    }

    function dosidebar() {
        if (isset($_SESSION['name']) and !strcmp($_SESSION['usertype'], "student")) {
            ?> 
            <h2>Funkcje studenta</h2>
            <ul>
                <li><a href="#">Moje konto</a></li>
                <li><a href="edit_data.php">Edytuj dane</a></li>
                <li><a href="change_photo.php">Zmień zdjęcie</a></li>
                <li><a href="change_password.php">Zmień hasło</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
            <?php
        }
        
        if (isset($_SESSION['name']) and !strcmp($_SESSION['usertype'], "nauczyciel")) {
            ?> 
            <h2>Funkcje nauczyciela</h2>
            <ul>
                <li><a href="#">Moje konto</a></li>
                <li><a href="edit_data.php">Edytuj dane</a></li>
                <li><a href="#"></a></li>
                <li><a href="change_password.php">Zmień hasło</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
            <?php
        }
        
        if (isset($_SESSION['name']) and !strcmp($_SESSION['usertype'], "firma")) {
            ?> 
            <h2>Funkcje firmy</h2>
            <ul>
                <li><a href="#">Moje konto</a></li>
                <li><a href="edit_data.php">Edytuj dane</a></li>
                <li><a href="change_photo.php">Zmień logo</a></li>
                <li><a href="change_password.php">Zmień hasło</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
            <?php
        }
        
        
        
        
        
    }

}
