$(document).ready(function() {
    $('#add_comment').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)

        
        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'add_comment.php', // the url where we want to POST
            data: $('#add_comment').serialize(), // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
                // using the done promise callback
                .done(function(data) { 
                    if (data[1]) { //pusty komentarz
                        $("#comments .error").text(data[1]);
                    } else if (data[2]){ //brak oceny
                        $("#comments .error").text(data[2]);
                    } else { console.log(data);
                        $('#shown_comments').prepend(data[0]);
                        $('#add_comment').hide();
                        $('#average').text(data[3]);
                        $('#allvotes').text(data[4]);
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






