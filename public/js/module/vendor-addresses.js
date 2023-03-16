    jQuery(document).ready(function() {
        item_list();

        function item_list() {
        if (jQuery(document).find('#dataTableList').length > 0) {
            $("#dataTableList").dataTable().fnDestroy();
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
                        d.is_deleted_at = $('#is_deleted_at').val();
                    }
                },
                "lengthMenu": [
                    [25, 50, 100, 200],
                    [25, 50, 100, 200]
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'address_type_name', name: 'address_type_name' },
                    { data: 'address_1', name: 'address_1' },
                    { data: 'address_2', name: 'address_2' },
                    { data: 'city', name: 'city' },
                    { data: 'state', name: 'state' },
                    { data: 'zip', name: 'zip' },
                    { data: 'zip_plus4', name: 'zip_plus4' },
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
                address_type_id: { required: true, maxlength: 8 },
                address_1: { required: true, maxlength: 32 },
                address_2: { maxlength: 32 },
                city: { required: true, maxlength: 32 },
                state: { required: true, maxlength: 8, maxlength: 32 },
                zip: { required: true, maxlength: 32, number: true, maxlength: 10 },
                zip_plus4: { required: true, maxlength: 32, number: true, maxlength: 10 },
            },
            messages: {
                'address_type_id': { required: "The address type field is required.", },
                'address_1': { required: "The address line 1 field is required.", },
                'city': { required: "The city field is required.", },
                'state': { required: "The state field is required.", },
                'zip': { required: "The zip field is required.", },
                'zip_plus4': { required: "The zip+4 field is required.", },
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
                address_type_id: { required: true, maxlength: 8 },
                address_1: { required: true, maxlength: 32 },
                address_2: { maxlength: 32 },
                city: { required: true, maxlength: 32 },
                state: { required: true, maxlength: 8, maxlength: 32 },
                zip: { required: true, maxlength: 32, number: true, maxlength: 10 },
                zip_plus4: { required: true, maxlength: 32, number: true, maxlength: 10 },
            },
            messages: {
                'address_type_id': { required: "The address type field is required.", },
                'address_1': { required: "The address line 1 field is required.", },
                'city': { required: "The city field is required.", },
                'state': { required: "The state field is required.", },
                'zip': { required: "The zip field is required.", },
                'zip_plus4': { required: "The zip+4 field is required.", },
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
        
    });