    jQuery(document).ready(function() {
        var base_url = config.data.base_url;

        item_list();

        function item_list() {

            if (jQuery(document).find('#dataTableList').length > 0) {
                $("#dataTableList").dataTable().fnDestroy();
                var Ot = jQuery(document).find('#dataTableList').DataTable({
                    processing: true,
                    serverSide: true,
                    filter: true,
                    "searching": true,
                    ajax: {
                        url: listIndex,
                        data: function(d) {
                            // d.name = $('#name').val();
                            // d.is_deleted_at = $('#is_deleted_at').val();
                        }
                    },
                    "lengthMenu": [
                        [25, 50, 100, 200],
                        [25, 50, 100, 200]
                    ],
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        { data: 'customer', name: 'customer' },
                        // { data: 'crop_commodity', name: 'crop_commodity' },
                        { data: 'crop_location', name: 'crop_location' },
                        { data: 'date', name: 'date' },
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
                $('.filter-apply-btn').click(function() {
                    Ot.draw();
                });
                $('.filter-clear-btn').click(function() {
                    $('#is_deleted_at').val('false').trigger('change');
                    $('#is_deleted_at').attr('value', 'false');
                    $('#is_deleted_at').attr('checked', false);
                    $("#is_deleted_at").prop('checked', false);
                    Ot.draw();
                });

            }
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
                                item_list();
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
        jQuery("form[name='add_frm']").validate({
            errorElement: 'span',
            ignore: [],
            errorClass: 'invalid-feedback',
            rules: {
                crop_commodity_type_id: { required: true, maxlength: 8 },
                name: { required: true, maxlength: 32 },
            },
            messages: {
                'crop_commodity_type_id': { required: "The crop commodity type field is required.", },
                'name': { required: "The name field is required.", },
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
                crop_commodity_type_id: { required: true, maxlength: 8 },
                name: { required: true, maxlength: 32 },
            },
            messages: {
                'crop_commodity_type_id': { required: "The crop commodity type field is required.", },
                'name': { required: "The name field is required.", },
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

        $("#is_deleted_at").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
            } else {
                $(this).attr('value', 'false');
            }
        });

        $(document).on('click', ".delete_request", function() {
            var id = $(this).data('id');
            Swal.fire({
                text: "Are you sure you want to revert selected Request?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, Revert!",
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
                        data: ({ submit_type: 'ajax', '_token': config.data.csrf, _method: 'POST' }),
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    text: "You have reverted selected Request!.",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                                item_list();
                            }
                        },
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


        jQuery('form.edit-question-form').each(function() {
            jQuery(this).validate({
                errorElement: 'span',
                ignore: [],
                errorClass: 'invalid-feedback',
                rules: {},
                messages: {

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
                    if ($(element).attr("type") == "radio") {
                        jQuery('input[name="' + $(element).attr("name") + '"]').each(function() {
                            $(this).removeClass('is-invalid');
                        });
                    } else if ($(element).attr("type") == "hidden") {
                        $(element).prev().removeClass('is-invalid');
                        $(element).removeClass('is-invalid');

                    } else {
                        $(element).removeClass('is-invalid');
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("type") == "radio") {
                        // error.addClass('ms-10');
                        error.insertAfter($(element).parent().parent().parent().parent().parent().append());
                    } else if (element.attr("type") == "hidden") {
                        error.insertAfter($(element).parent().parent().append());
                    } else if (element.attr("type") == "file") {
                        error.insertAfter($(element).parent().parent().append());
                    } else {
                        error.insertAfter($(element));
                    }
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    var textboxes = jQuery(form).find('input.frm-textbox');
                    var emptytextboxes = textboxes.filter(function() {
                        return this.value == "";
                    });
                    // if (jQuery(form).find('input.frm-checkbox:checked').length < 1 && textboxes.length == emptytextboxes.length) {
                    //     e.preventDefault();
                    //     jQuery(form).find('span#all-error').remove();
                    //     jQuery(form).find('.question-list-wrapper').after('<span id="all-error" class="invalid-feedback ms-10" style="display: block;">Any one option should be selected.</span>')
                    //     return false;
                    // } else {
                    jQuery(form).find('span#all-error').remove();
                    var formData = new FormData(form);
                    formData.append('_token', config.data.csrf);
                    formData.append('submit_type', 'ajax');
                    var action = base_url + '/scout-reports/update-answers';
                    jQuery.ajax({
                        url: action,
                        method: 'POST',
                        data: formData,
                        dataType: 'json',
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': config.data.csrf
                        },
                        processData: false,
                        contentType: false,
                        beforeSend: function(data) {},
                        success: function(data) {
                            if (data.status == 1) {

                                Swal.fire({
                                    text: data.message,
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
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
                        },
                        complete: function(data) {},
                        error: function(data, textStatus, xhr) {
                            if (textStatus == 'error') {
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
                        },
                    });
                    // }
                }
            });
        });

        jQuery(document).on('click', 'a.edit-btn', function() {
            jQuery(this).parent().parent().next().find('.edit-wrapper').removeClass('d-none');
            jQuery(this).parent().parent().next().find('input,textarea').each(function() {
                jQuery(this).prop("disabled", false);
            });
        });
        jQuery(document).on('click', '.edit-cancel', function() {
            jQuery(this).parent().addClass('d-none');
            jQuery(this).parent().parent().find('input,textarea').each(function() {
                jQuery(this).prop("disabled", true);
            });
        });
    });