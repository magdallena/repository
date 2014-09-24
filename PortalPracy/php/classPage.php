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
            echo "<h3 id='log_info'>Użytkownik zalogowany jako: <span>" . $_SESSION['name'] . " (".$_SESSION['usertype'].")</span> ";
            echo "<a href='php/logout.php' >(Wyloguj)</a></h3>";
        } else {
            echo "<h3 id='log_info'> <a href='php/login.php'>Zaloguj się</a>, a jeśli nie masz konta <a href='php/register.php'>zarejestruj się</a> </h3>";
        }
    }
    
    function domenu() {
        echo '<div id="menu">
            <ul>
                <li class="active"><a href="index.php">Strona główna</a></li>
                <li><a href="#">Student</a></li>
                <li><a href="#">Nauczyciel</a></li>
                <li><a href="#">Firma</a></li>
                
            </ul>
        </div>';
    }
    
}
