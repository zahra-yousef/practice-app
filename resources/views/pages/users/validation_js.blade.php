<script>
    $(document).ready(function () {
        e.preventDefault();
        $('#addUserForm').validate({ 
            rules: {
                name: {
                    required: true,
                    regexp: '/^[a-zA-Z\s]*$/',
                    minlength: 3,
                    maxlength: 191,
                },
                last_name: {
                    required: true,
                    regexp: '/^[a-zA-Z\s]*$/',
                    minlength: 3,
                    maxlength: 191,
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10,   
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
</script>