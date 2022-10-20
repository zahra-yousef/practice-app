$(document).ready(function () {
    $('#addPostForm').validate({ 
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
                required: "The title field is required2.",
                minlength: "The title must be at least 3 characters2."
            },
            description: {
                required: "The description field is required2.",
            },
            image: {
                required: "The image field is required2.",
                accept: "The image must be a file of type: jpeg, jpg, png, gif2.",
                maxlength: "The image size must be less than 10000",
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