
function show_hint(str, url) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("txtHint").style.visibility = "hidden";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            document.getElementById("txtHint").style.visibility = "visible";
        }
    } ;
    xmlhttp.open("GET", url + str, true);
    xmlhttp.send();
}