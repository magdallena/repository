<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header">
            <h1><a href="../index.php">Portal pracy dla studentów</a></h1>
        </div>
        <div id="menu">
            <ul>
                <li><a href="../index.php">Strona główna</a></li>
                <li><a href="#">Student</a></li>
                <li><a href="#">Nauczyciel</a></li>
                <li><a href="#">Firma</a></li>

            </ul>
        </div>
        <div id="main">
            <div id="content">
                <?php
                include_once 'classStudent.php';
                include_once 'classTeacher.php';
                include_once 'classCompany.php';

                if (isset($_POST['log_submit'])) {
                    if (empty($_POST['email']) or empty($_POST['password'])) {
                        echo "<h3>Nie wprowadzono nazwy użytkownika i/lub hasła</h3>";
                        echo "<p><a href='login.php'>Przejdź do formularza logowania</a></p>";
                    } else {
                        $login = htmlspecialchars($_POST['email']);
                        $pass = md5(htmlspecialchars($_POST['password']));
                        if ($_POST['usertype'] == 'type_student') {
                            $student = new Student($login, $pass);
                            $student->login();
                        } else if ($_POST['usertype'] == 'type_teacher') {
                            $teacher = new Teacher($login, $pass);
                            $teacher->login();
                        } else if ($_POST['usertype'] == 'type_company') {
                            $company = new Company($login, $pass);
                            $company->login();
                        }
                        
                    }
                }
                ?>
            </div><!-- content -->
            <div id="sidebar">

            </div><!-- sidebar -->
            <div class="clearing">&nbsp;</div>
        </div><!-- main -->
        <div id="footer">
            <p>Copyright &copy; 2013, designed by <a href="http://www.alphastudio.pl/">Alpha Studio</a> | <a href="#">Privacy Policy</a></p>
        </div>

    </body>
</html>