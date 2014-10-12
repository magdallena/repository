$(document).ready(function() {
    $('#company_register, #company_edit_data').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            address: {
                required: true,
                minlength: 1
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
            passwordc: {
                required: true,
                minlength: 8
            },
            password2: {
                required: true,
                equalTo: "#passwordc"
            },
            photo: {
                required: true
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
            address: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Pole wymagane."
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
            passwordc: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Minimalna długość to 8 znaków."
            },
            password2: {
                required: "<br/>Pole wymagane.",
                equalTo: "</br>Nie powtórzono hasła."
            },
            photo: {
                required: "<br/>Zdjęcie wymagane."
            }
        }
    });

});

