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
};
function show_response(id) {
    var id = "row" + id;
    var message = "<td colspan=\"5\">Wpis zignorowano</td>";
    eval("document.getElementById('"+id+"').innerHTML = '"+message+"'");
};

function mark_as_read(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                show_read(id);

            } 
        }
    };
    var address = "ignore_message.php?mes_id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null); 
};

function show_read(id){
    var id1= 'icon'+id;
    eval("document.getElementById('"+id1+"').style.visibility = 'hidden'");
    
    var id2= 'read'+id; 
    eval("document.getElementById('"+id2+"').style.display = 'none'");
    
    var id3= 'message'+id;
    eval("document.getElementById('"+id3+"').removeAttribute('class')");
}