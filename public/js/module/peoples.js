    jQuery(document).ready(function() {
        if (jQuery(document).find('#dataTableList').length > 0) {
            var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                "searching": true,
                // "responsive": true,
                ajax: {
                    url: listIndex,
                    data: function(d) {
                        d.name = $('#name').val();
                    }
                },
                "lengthMenu": [
                    [25, 50, 100, 200],
                    [25, 50, 100, 200]
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'nickname', name: 'nickname' },
                    { data: 'maiden_name', name: 'maiden_name' },
                    { data: 'date_of_birth', name: 'date_of_birth' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                }]
            });
            $('#name').keyup(function() {
                Ot.draw();
                jQuery(document).find('.row.clear_filter_row').show();
            });
            jQuery(document).find('input[name="data_tbl_search"]').on('keyup', function() {
                Ot.search(this.value).draw();
            });
            jQuery(document).on('click', '.clear_filter_btn', function(e) {
                $('#name').val('');
                $('#email').val('');
                $('#roles').val('');
                Ot.search('').draw();
                jQuery(document).find('.row.clear_filter_row').hide();
            });
        }
        $(document).on('click', ".delete_record", function() {
            var id = $(this).data('id');
            Swal.fire({
                text: "Are you sure you want to delete selected record?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then((function(isConfirm) {
                if (isConfirm.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: id,
                        data: ({ submit_type: 'ajax', '_token': config.data.csrf, _method: 'DELETE' }),
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    text: "You have deleted selected record.",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                                Ot.draw();
                            } else {
                                Swal.fire({
                                    text: "Failed...!!!",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            }
                        },
                        error: function(data) {
                            if (data.status == '403') {
                                Swal.fire({
                                    text: data.responseJSON.message,
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            }
                            if (data.status == '500') {
                                Swal.fire({
                                    text: 'Something went wrong!',
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        text: "Failed...!!!",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    });
                }
            }))
        });
        jQuery.validator.addMethod("validDate", function(value, element) {
            return this.optional(element) || moment(value, "DD-MM-YYYY").isValid();
        }, "Please enter a valid date in the format DD-MM-YYYY");
        jQuery("form[name='add_frm']").validate({
            errorElement: 'span',
            ignore: [],
            errorClass: 'invalid-feedback',
            rules: {
                prefix: { required: true, maxlength: 8 },
                first_name: { required: true, maxlength: 32 },
                middle_name: { required: true, maxlength: 32 },
                last_name: { required: true, maxlength: 64 },
                suffix: { maxlength: 8 },
                nickname: { maxlength: 32 },
                maiden_name: { maxlength: 32 },
                date_of_birth: { required: true, validDate: true },
            },
            messages: {
                'prefix': { required: "The prefix field is required.", },
                'first_name': { required: "The first name field is required.", },
                'middle_name': { required: "The middle name field is required.", },
                'last_name': { required: "The last name field is required.", },
                'date_of_birth': { required: "The date of birth field is required.", },
            },
            highlight: function(element, errorClass, validClass) {
                if ($(element).attr("type") == "radio") {
                    jQuery('input[name="' + $(element).attr("name") + '"]').each(function() {
                        $(this).addClass('is-invalid');
                    });
                } else if ($(element).attr("type") == "hidden") {
                    $(element).prev().addClass('is-invalid');
                    $(element).addClass('is-invalid');
                } else {
                    $(element).addClass('is-invalid');
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                error.insertAfter($(element));
            },
        });
        jQuery("form[name='edit_frm']").validate({
            errorElement: 'span',
            ignore: [],
            errorClass: 'invalid-feedback',
            rules: {
                prefix: { required: true, maxlength: 8 },
                first_name: { required: true, maxlength: 32 },
                middle_name: { required: true, maxlength: 32 },
                last_name: { required: true, maxlength: 64 },
                suffix: { maxlength: 8 },
                nickname: { maxlength: 32 },
                maiden_name: { maxlength: 32 },
                date_of_birth: { required: true, validDate: true },
            },
            messages: {
                'prefix': { required: "The prefix field is required.", },
                'first_name': { required: "The first name field is required.", },
                'middle_name': { required: "The middle name field is required.", },
                'last_name': { required: "The last name field is required.", },
                'date_of_birth': { required: "The date of birth field is required.", },
            },
            highlight: function(element, errorClass, validClass) {
                if ($(element).attr("type") == "radio") {
                    jQuery('input[name="' + $(element).attr("name") + '"]').each(function() {
                        $(this).addClass('is-invalid');
                    });
                } else if ($(element).attr("type") == "hidden") {
                    $(element).prev().addClass('is-invalid');
                    $(element).addClass('is-invalid');
                } else {
                    $(element).addClass('is-invalid');
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                error.insertAfter($(element));
            },
        });
        $("#date_of_birth").daterangepicker({
            format: 'DD-MM-YYYY',
            autoUpdateInput: false,
            singleDatePicker: true,
            showDropdowns: true,
            useCurrent: false,
            "autoApply": true,
            minYear: 1700,
            "maxDate": new Date(),
            maxYear: parseInt(moment().format("YYYY"), 10)
        });
        $('#date_of_birth').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
        });
    });