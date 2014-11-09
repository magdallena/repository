$(document).ready(function() {
    $('.send_response').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'offer_id': $('input[name=offer_id]').val(),
            'response': $('textarea[name=response]').val()
        };

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'send_response.php', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function(data) {
                    
                    var id = "offers" + data[0];
                    if (data[1]) { //pusta odpowiedz
                        $("#" + id + " .error").text(data[1]);

                    } else if (data[2]) { //ponowne przeslanie odpowiedzi
                        $("#" + id + " .error").text(data[2]);
                    } else {
                        var message = "<h3>Twoja odpowiedź na tę ofertę została wysłana.</h3>";
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





