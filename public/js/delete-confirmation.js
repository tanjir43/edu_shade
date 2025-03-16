$(document).ready(function() {

    // Delete confirmation

    $('.btn-action-delete').on('click', function(e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var record = $(this).data('record') || 'record';

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else {
            if (confirm('Are you sure you want to delete this ' + record + '?')) {
                form.submit();
            }
        }
    });

    // Force delete confirmation

    $('.btn-action-force-delete').on('click', function(e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var record = $(this).data('record') || 'record';

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action is irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else {
            if (confirm('Are you sure you want to delete this ' + record + '?')) {
                form.submit();
            }
        }
    });

    // Restore confirmation

    $('.btn-action-restore').on('click', function(e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var record = $(this).data('record') || 'record';

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to restore this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else {
            if (confirm('Are you sure you want to restore this ' + record + '?')) {
                form.submit();
            }
        }
    });
});
