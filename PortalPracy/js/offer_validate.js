$(document).ready(function() {
    $('#add_offer').validate({
        rules: {
            job: {
                required: true
            },
            description: {
                required: true
            },
            requirements: {
                required: true
            },
            place_of_work: {
                required: true
            },
            number_of_hours: {
                required: true,
                number: true
            },
            length_of_contract: {
                required: true
            },
            salary: {
                required: true,
                number: true
            },
            date_from: {
                required: true
            },
            date_to: {
                required: true
            }
        },
        messages: {
            job: {
                required: "<br/>Pole wymagane."
            },
            description: {
                required: "<br/>Pole wymagane."
            },
            requirements: {
                required: "<br/>Pole wymagane."
            },
            place_of_work: {
                required: "<br/>Pole wymagane."
            },
            number_of_hours: {
                required: "<br/>Pole wymagane.",
                number: "<br/>Wprowadź liczbę."
            },
            length_of_contract: {
                required: "<br/>Pole wymagane."
            },
            salary: {
                required: "<br/>Pole wymagane.",
                number: "<br/>Wprowadź liczbę."
            },
            date_from: {
                required: "<br/>Pole wymagane."
            },
            date_to: {
                required: "<br/>Pole wymagane."
            }
        }
    });

});


