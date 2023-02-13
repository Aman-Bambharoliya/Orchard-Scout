item_list();

function item_list() {
    if (jQuery(document).find('#item_table').length > 0) {
        $("#item_table").dataTable().fnDestroy();
        var Ot = jQuery(document).find('#item_table').DataTable({
            processing: true,
            serverSide: true,
            filter: true,
            "searching": true,
            "responsive": true,
            ajax: {
                url: questionsIndex,
                data: function(d) {
                    d.scout_report_category_id = $('#scout_report_category_id').val();
                    d.status = $('#status').val();
                    d.is_deleted_at = $('#is_deleted_at').val();
                    d.commodity_types = $('#commodity_types').val();
                }
            },
            columns: [
                { data: 'position', name: 'position' },
                { data: 'scout_report_category_id', name: 'scout_report_category_id' },
                { data: 'commodity_types', name: 'commodity_types', orderable: false },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            columnDefs: [{
                    targets: -1,
                    orderable: false,
                },
                {
                    targets: 0,
                    orderable: true,
                }
            ]
        });

        jQuery(document).find('input[name="data_tbl_search"]').on('keyup', function() {
            Ot.search(this.value).draw();
        });
        $('.filter-apply-btn').click(function() {
            Ot.draw();
        });
        $('.filter-clear-btn').click(function() {

            $('#commodity_types').val(null).trigger('change');
            $('#scout_report_category_id').val(null).trigger('change');
            $('#status').val(null).trigger('change');
            $('#is_deleted_at').val('false').trigger('change');
            $('#is_deleted_at').attr('value', 'false');
            $('#is_deleted_at').attr('checked', false);
            $("#is_deleted_at").prop('checked', false);
            Ot.draw();
        });
    }
}

$(document).on('click', ".delete_item", function() {
    var id = $(this).data('id');
    Swal.fire({
        text: "Are you sure you want to delete selected question?",
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
                    console.log(data);
                    // data = JSON.parse(data);

                    if (data.status == 1) {
                        Swal.fire({
                            text: "You have deleted all selected Item!.",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        });
                        // toastr.error("Oops ! Error: Deleted Successfully.!!!");
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