$(document).ready(function() {
    var dataTable = $('#scl-classes-table').DataTable();

    $('#btn-filter').on('click', function() {
        dataTable.draw();
    });

    $('#btn-reset').on('click', function() {
        $('#filter-name').val('');
        $('#filter-status').val('');
        dataTable.search('').draw();
    });

    $(window).resize(function() {
        if ($(window).width() < 768) {
            $('.table-responsive').addClass('table-responsive-sm');
        } else {
            $('.table-responsive').removeClass('table-responsive-sm');
        }
    }).resize();

    $('.dataTables_filter input').unbind();
    $('.dataTables_filter input').bind('keyup', function(e) {
        if(e.keyCode == 13) {
            dataTable.search(this.value).draw();
        }
    });
});
