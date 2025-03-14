<!-- resources/views/layouts/datatables_js.blade.php -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    // Add custom button styling
    $(document).ready(function() {
        // Add classes to specific button types
        $('button.dt-button.buttons-csv').addClass('csv');
        $('button.dt-button.buttons-excel').addClass('excel');
        $('button.dt-button.buttons-pdf').addClass('pdf');
        $('button.dt-button.buttons-print').addClass('print');

        // Add icons to action buttons
        $('.btn-group .btn-default .fa-eye').parent().addClass('text-primary');
        $('.btn-group .btn-default .fa-edit').parent().addClass('text-success');

        // Enhance table with responsive features
        $('.dataTable').addClass('table-hover');
    });
</script>
