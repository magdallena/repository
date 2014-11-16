$(document).ready(function() {
    $('.send_application').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = new FormData($(this)[0]);

        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'send_application.php', // the url where we want to POST
            data: formData, // our data object
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function(data) {
                    var id = "offer" + data[0];
                    if (data[1]) { //ponowne przesłanie aplikacji
                        $("#" + id + " .error").text(data[1]);

                    } else if (data[2]) { //niepoprawny plik
                        $("#" + id + " .error").text(data[2]);
                    } else { 
                        var message = "<h3>Twoja aplikacja na tę ofertę została wysłana.</h3>";
                        eval("document.getElementById('" + id + "').innerHTML = '" + message + "'");
                    }
                })

                .fail(function(data) {

                    console.log('nie udalo sie');
                    console.log(data);


                });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


