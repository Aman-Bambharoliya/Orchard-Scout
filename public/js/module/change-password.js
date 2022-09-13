jQuery(document).ready(function() {

    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "The password and current password must be different.");
    jQuery("form[name='add_frm']").validate({
        errorElement: 'span',
        errorClass: 'invalid-feedback',
        rules: {
            current_password: "required",
            password: { required: true, notEqual: "#current_password" },
            confirm_password: { required: true, equalTo: "#password" },
        },
        messages: {
            'current_password': { required: 'The current password field is required.' },
            'password': { required: 'The password field is required.' },
            'confirm_password': { required: 'The confirm password field is required.' },
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function(error, element) {
            error.insertAfter($(element));
        },
    });
});