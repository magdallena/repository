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
                            $student = Student::make_new_with_email_password($login, $pass);
                            $student->login();
                        } else if ($_POST['usertype'] == 'type_teacher') {
                            $teacher = Teacher::make_new_with_email_password($login, $pass);
                            $teacher->login();
                        } else if ($_POST['usertype'] == 'type_company') {
                            $company = Company::make_new_with_email_password($login, $pass);
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
        <?php
        $page->dofooter();
        ?>

    </body>
</html>