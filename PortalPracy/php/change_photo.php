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
                $('#change_photo').validate({
                    rules: {
                        photo: {
                            required: true
                        }
                    },
                    messages: {
                        photo: {
                            required: "<br/>Pole wymagane."
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
                    if (isset($_POST['photo_change_submit'])) {
                        if ($_SESSION['usertype'] == 'student') {
                            include_once 'classStudent.php';
                            $student = Student::make_new_with_id($_SESSION['id']);
                            $student->change_photo();
                        } else if ($_SESSION['usertype'] == 'firma') {
                            include_once 'classCompany.php';
                            $company = Company::make_new_with_id($_SESSION['id']);
                            $company->change_photo();
                        }
                    } else {
                        ?>
                        <h3>Aktualne zdjęcie: </h3>
                        <?php
                        include_once 'classDatabase.php';
                        $db = new Database();
                        if ($_SESSION['usertype'] == 'student') {
                            echo "<img src='../galery_student/" . $db->get_student_photo($_SESSION["id"]) . "' />";
                        } else if ($_SESSION['usertype'] == 'firma') {
                            echo "<img src='../galery_company/" . $db->get_company_photo($_SESSION["id"]) . "' />";
                        }
                        ?>
                        <form id="change_photo" action='change_photo.php' method='POST' enctype='multipart/form-data' >
                            <p> Nowe zdjęcie: 
                                <input type="file" name="photo" id='photo'/>
                            </p>
                            <p>
                                <input type="submit" name= 'photo_change_submit' class='submit_form_button' value="Zmień zdjęcie">
                            </p>

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
