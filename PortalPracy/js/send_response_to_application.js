$(document).ready(function() {
    $('.response_to_application').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'application_id': $('input[name=application_id]').val(),
            'response': $('textarea[name=response]').val()

        };

        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'send_response_to_application.php', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function(data) {
                    var id = "row" + data[0];
                    if (data[3]) { //pusta odpowiedź
                        $("#" + id + " .error").text(data[3]);
                    } else {
                        var message = "Odpowiedż z dnia " + data[2] + " została wysłana:<br/>" + data[1];
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

