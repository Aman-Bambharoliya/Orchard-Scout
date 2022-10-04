jQuery(document).ready(function() {
    var base_url = config.data.base_url;
    if (jQuery(document).find('#dataTableList').length > 0) {
        var Ot = jQuery(document).find('#dataTableList').DataTable({
            processing: true,
            serverSide: true,
            filter: true,
            "searching": true,
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
                { data: 'customer_name', name: 'customer_name' },
                { data: 'address', name: 'address' },
                { data: 'name', name: 'name' },
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
    jQuery("form[name='add_frm']").validate({
        errorElement: 'span',
        ignore: [],
        errorClass: 'invalid-feedback',
        rules: {
            customer_id: { required: true, maxlength: 8 },
            address_id: { required: true, maxlength: 8 },
            name: { required: true, maxlength: 64 },
            description: { maxlength: 255 },
        },
        messages: {
            'customer_id': { required: "The customer field is required.", },
            'address_id': { required: "The address field is required.", },
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
            if (element.data('control') == 'select2') {
                $(element).parent().append(error);
            } else {
                error.insertAfter($(element));
            }

        },
    });
    jQuery("form[name='edit_frm']").validate({
        errorElement: 'span',
        ignore: [],
        errorClass: 'invalid-feedback',
        rules: {
            customer_id: { required: true, maxlength: 8 },
            address_id: { required: true, maxlength: 8 },
            name: { required: true, maxlength: 64 },
            description: { maxlength: 255 },
        },
        messages: {
            'customer_id': { required: "The customer field is required.", },
            'address_id': { required: "The address field is required.", },
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
            if (element.data('control') == 'select2') {
                $(element).parent().append(error);
            } else {
                error.insertAfter($(element));
            }
        },
    });
    $(document).on('change', '#customer_id', function() {
        var id = $(this).val();
        if (id != '' && id != null && id != undefined) {
            $.ajax({
                url: base_url + '/get-customer-addresses/' + id,
                processData: false,
                async: true,
                contentType: false,
                success: function(json) {
                    datas = JSON.parse(json);
                    $('#address_id').html(datas.data);
                },
            });
        } else {
            $('#address_id').html('<option value="">Select address</option>');
        }

    });
    $("#add_frm #customer_id").trigger("change");
});