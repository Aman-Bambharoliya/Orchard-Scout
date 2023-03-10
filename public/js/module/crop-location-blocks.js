jQuery(document).ready(function () {
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
                    data: function (d) {
                        d.name = $('#name').val();
                        d.is_deleted_at = $('#is_deleted_at').val();
                    }
                },
                "lengthMenu": [
                    [25, 50, 100, 200],
                    [25, 50, 100, 200]
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'crop_location_name', name: 'crop_location_name' },
                    { data: 'crop_commodity_name', name: 'crop_commodity_name' },
                    { data: 'name', name: 'name' },
                    { data: 'acres', name: 'acres' },
                    { data: 'year_planted', name: 'year_planted' },
                    { data: 'plant_feet_spacing_in_rows', name: 'plant_feet_spacing_in_rows' },
                    { data: 'plant_feet_between_rows', name: 'plant_feet_between_rows' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                }]
            });
            $('#name').keyup(function () {
                Ot.draw();
                jQuery(document).find('.row.clear_filter_row').show();
            });
            jQuery(document).find('input[name="data_tbl_search"]').on('keyup', function () {
                Ot.search(this.value).draw();
            });
            jQuery(document).on('click', '.clear_filter_btn', function (e) {
                $('#name').val('');
                $('#email').val('');
                $('#roles').val('');
                Ot.search('').draw();
                jQuery(document).find('.row.clear_filter_row').hide();
            });
            $('.filter-apply-btn').click(function () {
                Ot.draw();
            });
            $('.filter-clear-btn').click(function () {
                $('#is_deleted_at').val('false').trigger('change');
                $('#is_deleted_at').attr('value', 'false');
                $('#is_deleted_at').attr('checked', false);
                $("#is_deleted_at").prop('checked', false);
                Ot.draw();
            });

        }
    }

    $(document).on('click', ".delete_record", function () {
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
        }).then((function (isConfirm) {
            if (isConfirm.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: id,
                    data: ({ submit_type: 'ajax', '_token': config.data.csrf, _method: 'DELETE' }),
                    success: function (data) {
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
                    error: function (data) {
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
    jQuery.validator.addMethod("decimal_point", function (value, element) {
        return this.optional(element) || /^\d{0,3}(.\d+)?$/i.test(value);
    }, "The field must be between 0 and 999.98.");
    jQuery("form[name='add_frm']").validate({
        errorElement: 'span',
        ignore: [],
        errorClass: 'invalid-feedback',
        rules: {
            crop_location_id: { required: true, maxlength: 8 },
            crop_commodity_id: { required: true, maxlength: 8 },
            crop_commodities_verity_id: { required: true },
            name: { required: true, maxlength: 64 },
            acres: { decimal_point: true },
            year_planted: { number: true, maxlength: 10 },
            plant_feet_spacing_in_rows: { number: true, decimal_point: true },
            plant_feet_between_rows: { decimal_point: true },
            description: { maxlength: 255 },
        },
        messages: {
            'crop_location_id': { required: "The crop location field is required.", },
            'crop_commodity_id': { required: "The crop commodity field is required.", },
            'crop_commodities_verity_id': { required: "The crop commodity varities filed is required." },
            'acres': { required: "The acres field is required.", },
            'name': { required: "The name field is required.", },
            'plant_feet_spacing_in_rows': { required: "The plant feet spacing in rows field is required.", },
            'plant_feet_between_rows': { required: "The plant feet between rows field is required.", },
        },
        highlight: function (element, errorClass, validClass) {
            if ($(element).attr("type") == "radio") {
                jQuery('input[name="' + $(element).attr("name") + '"]').each(function () {
                    $(this).addClass('is-invalid');
                });
            } else if ($(element).attr("type") == "hidden") {
                $(element).prev().addClass('is-invalid');
                $(element).addClass('is-invalid');
            } else {
                $(element).addClass('is-invalid');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
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
            crop_location_id: { required: true, maxlength: 8 },
            crop_commodity_id: { required: true, maxlength: 8 },
            crop_commodities_verity_id: { required: true },
            name: { required: true, maxlength: 64 },
            acres: { decimal_point: true },
            year_planted: { number: true, maxlength: 10 },
            plant_feet_spacing_in_rows: { number: true, decimal_point: true },
            plant_feet_between_rows: { decimal_point: true },
            description: { maxlength: 255 },
        },
        messages: {
            'crop_location_id': { required: "The crop location field is required.", },
            'crop_commodity_id': { required: "The crop commoditiy field is required.", },
            'crop_commodities_verity_id': { required: "The crop commoditiy varities filed is required." },
            'acres': { required: "The acres field is required.", },
            'name': { required: "The name field is required.", },
            'plant_feet_spacing_in_rows': { required: "The plant feet spacing in rows field is required.", },
            'plant_feet_between_rows': { required: "The plant feet between rows field is required.", },
        },
        highlight: function (element, errorClass, validClass) {
            if ($(element).attr("type") == "radio") {
                jQuery('input[name="' + $(element).attr("name") + '"]').each(function () {
                    $(this).addClass('is-invalid');
                });
            } else if ($(element).attr("type") == "hidden") {
                $(element).prev().addClass('is-invalid');
                $(element).addClass('is-invalid');
            } else {
                $(element).addClass('is-invalid');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
            if (element.data('control') == 'select2') {
                $(element).parent().append(error);
            } else {
                error.insertAfter($(element));
            }
        },
    });
    $(document).on('change', '#customer_id', function () {
        var id = $(this).val();
        if (id != '' && id != null && id != undefined) {
            $.ajax({
                url: base_url + '/get-customer-addresses/' + id,
                processData: false,
                async: true,
                contentType: false,
                success: function (json) {
                    datas = JSON.parse(json);
                    $('#address_id').html(datas.data);
                },
            });
        } else {
            $('#address_id').html('<option value="">Select address</option>');
        }

    });
    $("#add_frm #customer_id").trigger("change");

    $("#is_deleted_at").on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
        } else {
            $(this).attr('value', 'false');
        }
    });

    $(document).on('click', ".delete_request", function () {
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
        }).then((function (isConfirm) {
            if (isConfirm.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: id,
                    data: ({ submit_type: 'ajax', '_token': config.data.csrf, _method: 'POST' }),
                    success: function (data) {
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

    jQuery('#crop_commodity_id').change(function () {
        $('#crop_commodities_verity_id').html('');
        var id = $(this).val();
        if (id != '' && id != null && id != undefined) {
            $.ajax({
                type: "get",
                url: base_url + '/crop-commodities-blocks/' + id,
                processData: false,
                async: true,
                contentType: false,
                success: function (data) {
                    datas = JSON.parse(data);
                    console.log(datas.data)
                    $('#crop_commodities_verity_id').html(datas.data);
                }
            });
        }
    })
});