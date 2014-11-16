<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Portal pracy dla studentów</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='../js/tooltips.js'></script>

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
                    include_once 'classDatabase.php';
                    $db = new Database();
                    if (!isset($_GET["id"])) {
                        if ($_SESSION['usertype'] == 'firma') {
                            $id = $_SESSION['id'];
                        } else {
                            $id = -1;
                        }
                    } else {
                        $id = $_GET['id'];
                    }
                    $allcompanies = $db->get_company_number();
                    if ($id > $allcompanies or $id == -1) {
                        echo "<h3>niepoprawny numer firmy</h3>";
                    } else {
                        
                        $url = "'hint_offer_added.php?id=" . $id . "&amp;q='";
                        ?>
                        <div class="search">
                            <h4>Wyszukaj ofertę (wpisz stanowisko):</h4>
                            <form>
                                <span class='tooltips'><input type="text" onkeyup="show_hint(this.value, <?php echo $url; ?>)">
                                    <span id='txtHint'></span>   
                                </span>
                            </form>
                        </div>
                        <?php
                        $onpage = 5;
                        $all = $db->get_offer_added_number($id);
                        $company=$db->get_company_data($id);
                        echo "<h3>Firma: <a href='profile_company.php?".$id."'><span class='conspicuous'>".$company['name']."</span></a></h3>";
                        $start = $page->dopaging($onpage, $all, "list_offer_added.php?id=".$id."&amp;");

                        $result = $db->get_offer_added_list($id, $start, $onpage);
                        echo "<table><tbody>";
                        while ($obj = $result->fetch_object()) {
                            echo "<tr>";
                            echo "<td><a href='offer_description.php?id=" . $obj->offer_id . "'";
                            $today = date('Y-m-d', time());
                            if ($today >= $obj->date_from && $today <= $obj->date_to) {
                                echo "class=offer_active";
                            } else {
                                echo "class=offer_inactive";
                            }
                            echo ">STANOWISKO: " . $obj->job . "</a></td>";
                            echo "<td>(" . $obj->date_from . "   -   " . $obj->date_to . ")</td>";
//                            if (isset($_SESSION['status'])) {
//                                if ($_SESSION['status'] == 1) {
//                                    echo "<td><a href='edytuj.php?id=" . $obj->id . "' id='admin1'>Edytuj</a></td>";
//                                    echo "<td><a href='usun.php?id=" . $obj->id . "'id='admin2'>Usuń</a></td>";
//                                }
//                            }
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                        $page->dopaging($onpage, $all, "list_offer_added.php?".$id."&amp;");
                        
                        
                        
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
