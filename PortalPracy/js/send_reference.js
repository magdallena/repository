$(document).ready(function() {
    $('#add_reference').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'student_id': $('input[name=student_id]').val(),
            'teacher_id': $('input[name=teacher_id]').val(),
            'content': $('textarea[name=content]').val()

        };
        
        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'add_reference.php', // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function(data) {
                    if (data[1]) { //puste referencje
                        $("#references .error").text(data[1]);
                    } else {
                        $('#shown_references').prepend(data[0]);
                        $('#ref_content').val('Napisz referencje...');
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



