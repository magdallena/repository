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
            $page->dologinfo();
            ?>
            <h1><a href="index.php">Portal pracy dla studentów</a></h1>
        </div>
        <?php
        $page->domenu();
        ?>
        <div id="main">
            <div id="content">
                <div class="post">
                    <h2><a href="#">Terms of Use</a></h2>
                    <p class="postmeta">Posted in <a href="#">Class apent</a> | Sep 20, 2019 | <a href="#">4 comments</a></p>
                    <div class="entry">
                        <img class="block" src="../images/image.jpg" width="720" height="300" alt="" />
                        <p>The template is released under the <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution</a> license. This means it can be used for both private and commercial purposes, edited freely or redistributed as long as you keep the link back to Alpha Studio. The link, however, can be moved to any other place of the site. Do not use the template for websites with illegal or immoral content.</p>
                        <p>The image comes from <a href="http://www.publicdomainpictures.net/">PublicDomainPictures.net</a> and is in public domain. Please be aware that public domain content may in some cases infringe trademark, property or any other rights of others, so you use it at your own risk.</p>
                        <p class="readmore"><a href="#">read more</a></p>
                    </div>
                </div><!-- post -->
                <div class="post">
                    <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                    <p class="postmeta">Posted in <a href="#">Lorem ipsum</a> | Sep 19, 2019 | <a href="#">2 comments</a></p>
                    <div class="entry">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nec dui quis urna sollicitudin sodales. Fusce laoreet, ligula et rhoncus volutpat, felis magna varius tortor, ac molestie diam lorem in lectus. Aliquam venenatis mollis est, a porttitor ipsum interdum nec.</p>
                        <p>Quisque congue lacus sed odio fermentum tincidunt. Proin vitae nulla velit. Cras consectetur commodo scelerisque. Curabitur leo nisl, blandit at tempus et, interdum at risus. Sed dui augue, pellentesque ac pulvinar id, malesuada eget diam. Integer elementum sem eget tortor faucibus id pellentesque lorem dignissim.</p>
                        <p class="readmore"><a href="#">read more</a></p>
                    </div>
                </div><!-- post -->	
            </div><!-- content -->
            <div id="sidebar">
                <?php $page->dosidebar();
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
