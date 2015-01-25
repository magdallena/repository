$(document).ready(function() {
    
    jQuery.validator.addMethod("emailordomain", function(value, element) {
  return this.optional(element) || /[a-zA-Z0-9\.]*@[a-zA-Z0-9\.]*edu.pl$/.test(value); 
}, "Please specify the correct url/email");
    
    $('#student_register, #student_edit_data').validate({
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
                email: true,
                emailordomain: true
                //matches: '.+edu.pl'
            },
            password: {
                required: true,
                minlength: 8
            },
            password2: {
                required: true,
                equalTo: "#password"
            },
            education: {
                required: true,
                minlength: 1
            },
            languages: {
                required: true,
                minlength: 1
            },
            experience: {
                required: true,
                minlength: 1
            },
            skills: {
                required: true,
                minlength: 1
            },
            interest: {
                required: true,
                minlength: 1
            },
            employment_form: {
                required: true,
                minlength: 1
            },
            salary: {
                required: true,
                minlength: 1,
                number: true
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
                email: "<br/>Niepoprawny adres email.",
                emailordomain: "<br/>E-mail musi być w domenie edu.pl"
                //matches: "<br/>E-mail musi być w domenie edu.pl"
            },
            password: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Minimalna długość to 8 znaków."
            },
            password2: {
                required: "<br/>Pole wymagane.",
                equalTo: "</br>Nie powtórzono hasła."
            },
            education: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Pole wymagane."
            },
            languages: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Pole wymagane."
            },
            experience: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Pole wymagane."
            },
            skills: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Pole wymagane."
            },
            interest: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Pole wymagane."
            },
            employment_form: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Pole wymagane."
            },
            salary: {
                required: "<br/>Pole wymagane.",
                minlength: "<br/>Pole wymagane.",
                number: "<br/>Nie podano wartości liczbowej."
            }, 
            photo: {
                required: "<br/>Zdjęcie wymagane."
            }
        }
    });

});

