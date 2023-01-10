$(document).ready(function() {
    // form validation
    jQuery.validator.addMethod("decimal_point", function(value, element) {
        return this.optional(element) || /^(?=.*[0-9])\d{0,2}(?:\.\d{0,2})?$/.test(value) || /^-(?=.*[0-9])\d{0,2}(?:\.\d{0,2})?$/.test(value);
    }, "The field must be between -99.99 and 99.99.");
    jQuery.validator.addClassRules("number_validation", {
        // number: true,
        // required: true,
        decimal_point: true,
    });
    jQuery.validator.addClassRules("check-required", {
        required: function(element) {
            if (jQuery(element).parent().parent().parent().parent().find('select.parent_input_option ').val() == '1') {
                return true;
            } else {
                return false;
            }
        },
    });
    jQuery.validator.addClassRules("text-required-box", {
        required: function(element) {
            if (jQuery(element).parent().parent().find('select.parent_input_option ').val() == '2' || jQuery(element).parent().parent().find('select.parent_input_option ').val() == '1') {
                return true;
            } else {
                return false;
            }
        },
    });

    $("#add_item_form").validate({
        // form rules
        rules: {
           
            scout_report_category_id: {
                required: true,
            },          
            'commodity_types[]': {
                required: true,
            },
        },
        // validation message
        messages: {
           
            scout_report_category_id: {
                required: "Select a scout report category.",
            },          
            position: {
                required: "Enter Position.",
            },
        },
        errorPlacement: function(error, element) {
            error.addClass("mt-2");
            error.appendTo(element.parent());
        },
        submitHandler: function(form) {
            return true;
        },
    });
    //edit form
    $("#edit_item_form").validate({
        // form rules
        rules: {
            name: {
                required: true,
            },
            inspection_location_id: {
                required: true,
            },
            inspection_type_id: {
                required: true,
            },
            position: {
                required: true,
            },
            // 'vehicle_types[]': {
            //     required: true,
            // },
        },
        // validation message
        messages: {
            type: {
                required: "Inspection Item Name",
            },
            inspection_location_id: {
                required: "Select Inspection Location.",
            },
            inspection_type_id: {
                required: "Select Inspection Type.",
            },
            position: {
                required: "Enter Position.",
            },
        },
        errorPlacement: function(error, element) {
            error.addClass("mt-2");
            error.appendTo(element.parent());
        },
        submitHandler: function(form) {
            return true;
        },
    });


    $('#kt_docs_repeater_advanced').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function() {
            $(this).slideDown();
            // Re-init select2
            $(this).find('[data-kt-repeater="select2"]').select2();

        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        },

        ready: function() {
            // Init select2
            $('[data-kt-repeater="select2"]').select2();

        }
    });

});