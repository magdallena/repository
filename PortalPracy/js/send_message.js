$(document).ready(function() {
    $('#send_message').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'student_id': $('input[name=student_id]').val(),
            'teacher_id': $('input[name=teacher_id]').val(),
            'content': $('textarea[name=content]').val(),
            'recipient':$('select[name=recipient]').val()

        };

        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'send_message.php', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function(data) {
                    if (data[1]) { //nie wybrano adresata
                        $("#send_message .error").text(data[1]);
                    } else if (data[2]) { //brak oceny
                        $("#send_message .error").text(data[2]);
                    } else {
                        console.log(data);
                        $('#sent').prepend(data[0]);
//                        $('#add_comment').hide();
//                        $('#average').text(data[3]);
//                        $('#allvotes').text(data[4]);
                    }
//                        
                })
                .fail(function(data) {

                    console.log('nie udalo sie');
                    console.log(data);

                });
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});






