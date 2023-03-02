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
                            d.is_deleted_at = $('#is_deleted_at').val();
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
        jQuery('form.edit-question-form').each(function() {

            var cform = jQuery(this);
            jQuery(this).validate({
                errorElement: 'span',
                ignore: [],
                errorClass: 'invalid-feedback',
                rules: {},
                messages: {},
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
                    var form_type = jQuery(form).data('form_type');
                    e.preventDefault();
                    jQuery(form).find('span#all-error').remove();
                    var formData = new FormData(form);
                    formData.append('_token', config.data.csrf);
                    formData.append('submit_type', 'ajax');
                    formData.append('form_type', form_type);
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
                                if (data.form_type == 'notes') {
                                    cform.find('.action-btn-wrapper').addClass('d-none');
                                    cform.find('.edit-icon-wrapper').removeClass('d-none');
                                    cform.find('.form-group').find('input[type="checkbox"],textarea').each(function() {
                                        jQuery(this).prop("disabled", true);
                                        jQuery(this).addClass('text-muted');

                                    });
                                    cform.find('.form-group').find('textarea').each(function() {
                                        jQuery(this).attr('data-old_val', jQuery(this).val());

                                    });

                                } else if (data.form_type == 'questions') {
                                    cform.find('.action-btn-wrapper').addClass('d-none');
                                    cform.find('.edit-icon-wrapper').removeClass('d-none');
                                    cform.find('.form-group').find('input[type="checkbox"],textarea').not('input[type="hidden"]').each(function() {
                                        jQuery(this).prop("disabled", true);
                                        jQuery(this).addClass('text-muted');
                                        if (jQuery(this).attr('type') == 'checkbox') {
                                            if (jQuery(this).is(':checked')) {
                                                jQuery(this).addClass('checked selected-check');
                                                jQuery(this).removeClass('not-selected-check');
                                                jQuery(this).parent().parent().parent().removeClass('d-none');

                                            } else {
                                                jQuery(this).removeClass('checked selected-check');
                                                jQuery(this).addClass('not-selected-check');
                                                jQuery(this).parent().parent().parent().addClass('d-none');
                                            }
                                        } else {
                                            jQuery(this).attr('data-old_val', jQuery(this).val());
                                            if (jQuery(this).val() == '') {
                                                jQuery(this).parent().parent().addClass('d-none');
                                            } else {
                                                jQuery(this).parent().parent().removeClass('d-none');
                                            }
                                        }
                                    });
                                    var checkCount = cform.find('input[type="checkbox"]:checked').length;
                                    var commentBox = cform.find('textarea').val();

                                    if (checkCount < 1 && commentBox == '') {
                                        cform.find('.question_item_wrapper').addClass('d-none');
                                        cform.find('.empty_answer_wrapper').removeClass('d-none');
                                    }
                                }
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
            jQuery(this).parent().addClass('d-none');
            jQuery(this).parent().next().removeClass('d-none');
            jQuery(this).parent().parent().parent().parent().find('input,textarea').not('input[type="hidden"]').each(function() {
                jQuery(this).prop("disabled", false);
                jQuery(this).removeClass('text-muted');
            });
            if (jQuery(this).data('edit_type') == 'questions') {
                jQuery(this).parent().parent().parent().parent().find('.checkbox-wrapper').removeClass('d-none');
                jQuery(this).parent().parent().parent().parent().find('.question_item_wrapper').removeClass('d-none');
                jQuery(this).parent().parent().parent().parent().find('.empty_answer_wrapper').addClass('d-none');
                jQuery(this).parent().parent().parent().parent().find('.comment-box-wrapper').removeClass('d-none');
            }
        });
        jQuery(document).on('click', '.edit-cancel', function() {
            jQuery(this).parent().addClass('d-none');
            jQuery(this).parent().prev().removeClass('d-none');
            jQuery(this).parent().parent().parent().parent().find('input,textarea').not('input[type="hidden"]').each(function() {
                jQuery(this).prop("disabled", true);
                jQuery(this).addClass('text-muted');
            });
            if (jQuery(this).data('cancel_type') == 'questions') {
                jQuery(this).parent().parent().parent().parent().find('input[type="checkbox"],textarea').each(function() {
                    if (jQuery(this).attr('type') == 'checkbox') {
                        if (!jQuery(this).hasClass('checked selected-check')) {
                            jQuery(this).prop('checked', false);
                            jQuery(this).parent().parent().parent().addClass('d-none');
                        } else {
                            jQuery(this).prop('checked', true);
                            jQuery(this).parent().parent().parent().removeClass('d-none');
                        }
                    } else {
                        jQuery(this).val(jQuery(this).attr('data-old_val'));
                        if (jQuery(this).val() == '') {
                            jQuery(this).parent().parent().addClass('d-none');
                        } else {
                            jQuery(this).parent().parent().removeClass('d-none');
                        }
                    }
                });
                var checkCount = jQuery(this).parent().parent().parent().parent().find('input[type="checkbox"]:checked').length;
                var commentBox = jQuery(this).parent().parent().parent().parent().find('textarea').val();
                if (checkCount < 1 && commentBox == '') {
                    jQuery(this).parent().parent().parent().parent().find('.question_item_wrapper ').addClass('d-none');
                    jQuery(this).parent().parent().parent().parent().find('.empty_answer_wrapper  ').removeClass('d-none');
                }
            } else {
                var old = jQuery(this).parent().parent().parent().find('textarea[name="notes"]').attr('data-old_val');
                jQuery(this).parent().parent().parent().find('textarea[name="notes"]').val(old);
            }
        });
    });