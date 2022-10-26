$(document).ready(function () {
    $('#editPostForm').validate({ 
        rules: {
            title: {
                required: true,
                minlength: 3,
            },
            description: {
                required: true,
            },
            image: {
                required: true, 
                accept: "jpeg|jpg|png|gif",
                maxlength: 10000,
            },
        },
        messages: {
            title: {
                required: "The title field is required..",
                minlength: "The title must be at least 3 characters.."
            },
            description: {
                required: "The description field is required..",
            },
            image: {
                required: "The image field is required..",
                accept: "The image must be a file of type: jpeg, jpg, png, gif..",
                maxlength: "The image size must be less than 10000..",
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