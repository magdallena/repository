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

function activate_company(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                activate_feedback(id);

            } 
        }
    };
    var address = "activate_company.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}

function activate_feedback(id) {
    var id1='activate'+id;
    var message = "Aktywowano";
    eval("document.getElementById('"+id1+"').innerHTML = '"+message+"'");
    var id2='delete'+id;
    eval("document.getElementById('"+id2+"').innerHTML = ''");
}

function activate_teacher(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                activate_feedback(id);

            } 
        }
    };
    var address = "activate_teacher.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}

function delete_teacher(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                delete_feedback(id);

            } 
        }
    };
    var address = "delete_teacher.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}

function delete_student(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                delete_feedback(id);

            } 
        }
    };
    var address = "delete_student.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}

function delete_feedback(id) {
    var id1='delete'+id;
    var message = "Usunięto";
    eval("document.getElementById('"+id1+"').innerHTML = '"+message+"'");
    var id2='activate'+id;
    eval("document.getElementById('"+id2+"').innerHTML = ''");
    console.log('usuniecie');
}

function delete_company(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                delete_feedback(id);

            } 
        }
    };
    var address = "delete_company.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}

function delete_reference(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                hide_commentbox(id);

            } 
        }
    };
    var address = "delete_reference.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}

function hide_commentbox(id){
    var id1='delete'+id;
    eval("document.getElementById('"+id1+"').innerHTML = ''");
    var id2='commentbox'+id;
    eval("document.getElementById('"+id2+"').innerHTML = 'WPIS USUNIĘTY'");
    eval("document.getElementById('"+id2+"').style.color = 'red'");
}

function delete_comment(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                hide_commentbox(id);

            } 
        }
    };
    var address = "delete_comment.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}

function end_offer(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                end_offer_feedback();

            } 
        }
    };
    var address = "end_offer.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}

function end_offer_feedback() {
    eval("document.getElementById('end_offer').innerHTML = 'oferta zakończy się dzisiaj'");
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd='0'+dd
    } 

    if(mm<10) {
        mm='0'+mm
    } 

    today = yyyy+'-'+mm+'-'+dd;
    eval("document.getElementById('date_to').innerHTML = '"+today+"'");
}

function end_offer_to(id) {
    AjaxInit();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            a = xmlHttp.responseText;
            if (a != "false") {
                //odpowiedz 
                end_offer_feedback();

            } 
        }
    };
    var address = "end_offer_to.php?id=" + id;
    xmlHttp.open("GET", address, true);
    xmlHttp.send(null);
}