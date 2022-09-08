    jQuery(document).ready(function() {
        if (jQuery(document).find('#dataTableList').length > 0) {
            var Ot = jQuery(document).find('#dataTableList').DataTable({
                processing: true,
                serverSide: true,
                filter: true,
                "searching": true,
                "responsive": true,
                ajax: {
                    url: userListIndex,
                    data: function(d) {
                        d.name = $('#name').val();
                        d.email = $('#email').val();
                    }
                },
                "lengthMenu": [
                    [25, 50, 100, 200],
                    [25, 50, 100, 200]
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
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
            $('#email').keyup(function() {
                Ot.draw();
                jQuery(document).find('.row.clear_filter_row').show();
            });
            $('#roles').change(function() {
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
        $("#role").trigger("change");
        jQuery(document).on('click', '.delete-data', function() {
            var action = jQuery(this).attr('data-href');
            jQuery(document).find('form[name="delete-confirm-frm"]').attr('action', action);
            jQuery(document).find('input[name="delete_url"]').val(action);
        });
    });