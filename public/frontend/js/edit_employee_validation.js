$(document).on('click','#upadteEmployee',function () {

    jQuery.validator.addMethod("lettersonly", function(value, element) 
    {
        return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
    }, "The name format is invalid..");

    $('#editEmpForm').validate({ 
        rules: {
            name: {
                required: true,
                minlength: 3,
                lettersonly: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
                max: 2147483647,
            },
            designation: {
                required: true
            },
        },
        messages: {
            name: {
                required: "The name field is required..",
                minlength: "The name must be at least 3 characters.."
            },
            email: {
                required: "The email field is required..",
                email: "The email must be a valid email address..",
            },
            phone: {
                required: "The phone field is required..",
                digits: "The phone must be a number..",
                minlength: "The phone must be 10 digits..",
                maxlength: "The phone must be 10 digits..",
                max: "The phone must not exceed 2147483647",
            },
            designation: {
                required: "The designation field is required..",
            }
        },
        errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});