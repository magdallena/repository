$(document).ready(function() {
    $('#teacher_register, #teacher_edit_data').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            degree: {
                required: true,
                minlength: 2
            },
            telephone: {
                required: true,
                minlength: 9,
                maxlength: 9,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            passwordt: {
                required: true,
                minlength: 8
            },
            password2: {
                required: true,
                equalTo: "#passwordt"
            }            
        },
        messages: {
            name: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Minimalna długość to 2 znaki."
            },
            last_name: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Minimalna długość to 2 znaki."
            },
            degree: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Minimalna długość to 2 znaki."
            },
            telephone: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Niewłaściwy numer telefonu.",
                maxlength: "<br/>Niewłaściwy numer telefonu.",
                number: "<br/>Niewłaściwy numer telefonu."
            },
            email: {
                required: "<br/>Pole wymagane.",
                email: "<br/>Niepoprawny adres email."
            },
            passwordt: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Minimalna długość to 8 znaków."
            },
            password2: {
                required: "<br/>Pole wymagane.",
                equalTo: "</br>Nie powtórzono hasła."
            }
        }
    });

});

