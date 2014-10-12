<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script src='../js/jquery-2.1.1.js' type='text/javascript'></script>
        <script src='../js/jquery.validate.js' type='text/javascript'></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#password_changing').validate({
                    rules: {
                        old_password: {
                            required: true,
                            minlength: 8
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password2: {
                            required: true,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        old_password: {
                            required: "<br/>Pole wymagane.",
                            minlength: "<br/>Minimalna długość to 8 znaków."
                        },
                        passwordt: {
                            required: "<br/>Pole wymagane.",
                            minlength: "<br/>Minimalna długość to 8 znaków."
                        },
                        password2: {
                            required: "<br/>Pole wymagane.",
                            equalTo: "</br>Nie powtórzono hasła."
                        }
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
                    if (isset($_POST['password_change_submit'])) {
                        $pass = md5(htmlspecialchars($_POST['old_password']));
                        if ($_SESSION['usertype'] == 'student') {
                            include_once 'classStudent.php';
                            $pass = md5(htmlspecialchars($_POST['old_password']));
                            $student = Student::make_new_with_email_password($_SESSION['name'], $pass);
                            $student->change_password();
                        }
                        if ($_SESSION['usertype'] == 'nauczyciel') {
                            include_once 'classTeacher.php';
                            $teacher = Teacher::make_new_with_email_password($_SESSION['name'], $pass);
                            $teacher->change_password();
                        }
                        if ($_SESSION['usertype'] == 'firma') {
                            include_once 'classCompany.php';
                            $company = Company::make_new_with_email_password($_SESSION['name'], $pass);
                            $company->change_password();
                        }
                    } else {
                        ?>   
                        <form id="password_changing" action='change_password.php' method='POST'>
                            <table>
                                <tr>
                                    <td><label for="old_password">Stare hasło:</label></td>
                                    <td><input type="password" id="old_password" name="old_password" size='50'></td>
                                </tr>
                                <tr>
                                    <td><label for="password">Nowe hasło:</label></td>
                                    <td><input type="password" id="password" name="password" size='50'></td>
                                </tr>
                                <tr>
                                    <td><label for="password2">Powtórz nowe hasło:</label></td>
                                    <td><input type="password" id="password2" name="password2" size='50'></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" name= 'password_change_submit' class="submit_form_button" value="Zmień hasło"></td>
                                </tr>
                            </table>
                        </form> 





        <?php
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

