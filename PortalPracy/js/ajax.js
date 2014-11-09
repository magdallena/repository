var xmlHttp;
function AjaxInit() {
    xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    catch (e) {
        // Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {
                alert("Twoja przeglądarka nie obsługuje Ajaksa!");
                return false;
            }
        }
    }
};
function ignore(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                show_response(id);

            }
        }
    };
    var address = "ignore_ask.php?ask_id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}
;
function show_response(id) {
    var id = "row" + id;
    var message = "<td colspan=\"5\">Wpis zignorowano</td>";
    eval("document.getElementById('"+id+"').innerHTML = '"+message+"'");
};

