<!-- resources/views/layouts/datatables_css.blade.php -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<style>
    /* Custom DataTables Styling */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.375rem 0.75rem;
        margin-left: 0.25rem;
        border-radius: 0.25rem;
        border: 1px solid #dee2e6;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #6366f1 !important;
        color: white !important;
        border-color: #6366f1 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #ebeeff !important;
        color: #6366f1 !important;
        border-color: #6366f1 !important;
    }

    .table.dataTable {
        border-collapse: collapse !important;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .table.dataTable thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        padding: 0.75rem;
    }

    .table.dataTable tbody tr:hover {
        background-color: #f8f9fa;
    }

    .dt-buttons .btn {
        margin-right: 0.25rem;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .dt-buttons .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .dt-buttons .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .dt-buttons .btn-secondary.csv {
        background-color: #28a745;
        border-color: #28a745;
    }

    .dt-buttons .btn-secondary.csv:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .dt-buttons .btn-secondary.excel {
        background-color: #007bff;
        border-color: #007bff;
    }

    .dt-buttons .btn-secondary.excel:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .dt-buttons .btn-secondary.pdf {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .dt-buttons .btn-secondary.pdf:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .dt-buttons .btn-secondary.print {
        background-color: #6610f2;
        border-color: #6610f2;
    }

    .dt-buttons .btn-secondary.print:hover {
        background-color: #520dc2;
        border-color: #4d0cb6;
    }

    /* Status badges */
    .badge-success {
        background-color: #28a745;
        color: white;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
        border-radius: 0.25rem;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
        border-radius: 0.25rem;
    }

    /* Action buttons */
    .btn-group .btn {
        margin-right: 0.25rem;
    }

    .btn-group .btn-default {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .btn-group .btn-default:hover {
        background-color: #e2e6ea;
        border-color: #dae0e5;
    }

    .btn-group .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-group .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* Search box */
    .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        margin-left: 0.5rem;
    }

    /* Filter buttons styling */
    .filter-form .form-control {
        border-radius: 0.25rem;
    }

    .filter-form .btn-primary {
        background-color: #6366f1;
        border-color: #6366f1;
    }

    .filter-form .btn-primary:hover {
        background-color: #4f46e5;
        border-color: #4338ca;
    }

    /* Improve spacing */
    .dataTables_wrapper {
        padding: 1rem;
    }

    /* Responsive behavior */
    @media (max-width: 767.98px) {
        .dt-buttons {
            margin-bottom: 1rem;
            display: flex;
            flex-wrap: wrap;
        }

        .dt-buttons .btn {
            margin-bottom: 0.5rem;
        }
    }
</style>
