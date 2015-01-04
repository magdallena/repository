<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header">
            <?php
            include_once 'classPage.php';
            $page = new Page;
            ?>
            <h1><a href="index.php">Portal pracy dla studentów</a></h1>
        </div>
        <?php
        $page->domenu();
        ?>
    </div>
    <div id="main">
        <div id="content">
            <?php
            include_once 'classDatabase.php';
            include_once 'classStudent.php';
            include_once 'classTeacher.php';
            include_once 'classCompany.php';
            @session_start();
            if (isset($_SESSION['name'])) {
                echo "<h3>Już jesteś zalogowany <a href='logout.php'>(Wyloguj)</a></h3>";
                echo "<h3 ><a href='index.php'>Powrót do strony głównej</a></h3>";
            } else if (isset($_POST['remind_password'])) { 
                $email = htmlspecialchars($_POST['email']); 
                $name = htmlspecialchars($_POST['name']);   
                $bytes = openssl_random_pseudo_bytes(5,$cstrong);               
                $password = bin2hex($bytes);
                var_dump($password);
                $db = new Database();
                if ($_POST['usertype'] == 'type_student') {
                    if (!$db->check_student_email_name($email, $name)) {
                        echo "<h3>Niepoprawne dane studenta(email, nazwisko)<h3>";
                        echo "<a href='remind_password.php'>Powrót</a>";
                    } else {
                        $student = Student::make_new_with_email_password($email, $password);
                        $student->reset_password();
                        echo "<h3>Nowe hasło zostało wysłane na podany adres e-mail</h3>";
                        echo "<a href='login.php'>Zaloguj się</a>";
                    }
                } else if ($_POST['usertype'] == 'type_teacher') {
                    if (!$db->check_teacher_email_name($email, $name)) {
                        echo "<h3>Niepoprawne dane nauczyciela(email, nazwisko)<h3>";
                        echo "<a href='remind_password.php'>Powrót</a>";
                    } else {
                        $teacher = Teacher::make_new_with_email_password($email, $password);
                        $teacher->reset_password();
                        echo "<h3>Nowe hasło zostało wysłane na podany adres e-mail</h3>";
                        echo "<a href='login.php'>Zaloguj się</a>";
                    }
                } else if ($_POST['usertype'] == 'type_company') {
                   if (!$db->check_company_email_name($email, $name)) {
                        echo "<h3>Niepoprawne dane (email, nazwa)<h3>";
                        echo "<a href='remind_password.php'>Powrót</a>";
                    } else {
                        $company = Company::make_new_with_email_password($email, $password);
                        $company->reset_password();
                        echo "<h3>Nowe hasło zostało wysłane na podany adres e-mail</h3>";
                        echo "<a href='login.php'>Zaloguj się</a>";
                    }
                }
            } else {
                ?>
                <h3>Odzyskiwanie hasła</h3>
                <form id="login" action='remind_password.php' method='POST'>
                    <table>
                        <tr>
                            <td><input type="radio" name="usertype" value="type_student" checked="checked"/>Student</td>
                            <td><input type="radio" name="usertype" value="type_teacher" />Nauczyciel</td>
                            <td><input type="radio" name="usertype" value="type_company" />Firma</td>
                        </tr>
                        <tr>
                            <td><label for="email">E-mail:</label></td>
                            <td><input type="text" id="email" name="email" required></td>
                        </tr>


                        <tr>
                            <td><label for="password">Nazwisko lub nazwa firmy</label></td>

                            <td><input type="text" id="name" name="name" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name= 'remind_password' value="Potwierdź"></td>
                        </tr>
                    </table>
                </form>

            <?php } ?>
        </div><!-- content -->
        <div id="sidebar">

        </div><!-- sidebar -->
        <div class="clearing">&nbsp;</div>
    </div><!-- main -->
    <?php
    $page->dofooter();
    ?>

</body>
</html>
