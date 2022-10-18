<script>
    $(document).on('click','#saveEmployee',function (e) {
        e.preventDefault();
        $('#addEmpForm').validate({ 
            rules: {
                name: {
                    required: true,
                    regexp: '/^[a-zA-Z\s]*$/',
                    minlength: 3
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
                },
                designation: {
                    required: true
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