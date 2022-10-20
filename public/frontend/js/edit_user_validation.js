$(document).on('click','#updateUser',function () {
    console.log("test");
    jQuery.validator.addMethod("lettersonly", function(value, element) 
    {
        return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
    }, "The name format is invalid..");

    $('#editUserForm').validate({ 
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 191,
                lettersonly: true,
            },
            last_name: {
                required: true,
                minlength: 3,
                maxlength: 191,
                lettersonly: true,
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
                max: 2147483647,   
            },
            email: {
                required: true,
                email: true,
                maxlength: 255,
            },
            password: {
                required: true,
                minlength: 8,
            },
            role_as: {
                required: true,
                digits: true,
                minlength: 0,
                minlength: 1,
            },
        },
        messages: {
            name: {
                required: "The title field is required..",
                minlength: "The name must be at least 3 characters..",
                maxlength: "The name must not be greater than 191 characters.."
            },
            last_name: {
                required: "The last name field is required..",
                minlength: "The last name must be at least 3 characters..",
                maxlength: "The last name must not be greater than 191 characters.."
            },
            phone: {
                required: "The phone field is required..",
                digits: "The phone must be a number..",
                minlength: "The phone must be 10 digits..",
                maxlength: "The phone must be 10 digits..",
                max: "The phone must not exceed 2147483647",
            },
            email: {
                 required: "The email field is required..",
                email: "The email must be a valid email address..",
            },
            password: {
                required: "The password field is required..",
                minlength: "The last name must be at least 8 characters..",
            },
            role_as: {
                required: "The role field is required..",
                digits: "The phone must be a number..",
                minlength: "The phone must be 10 digits..",
                maxlength: "The phone must be 10 digits..",
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